<?php

namespace App\Http\Controllers\Api;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Http\Controllers\Controller;
use App\Models\PasswordForgotRequest;
use GuzzleHttp\Client;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Passport\Client as OClient;
use Storage;

class ApiAuthController extends Controller
{
    protected $userService;

    /**
     * RegisterController constructor.
     *
     * @param  UserService  $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $rules = [
            'first_name' => 'bail|required|max:50',
            'last_name' => 'bail|required|max:50',
            'email' => 'bail|required|email|max:50|unique:users',
            'password' => 'bail|required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|confirmed',
            'mobile' => 'bail|nullable|digits:10',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $userData = Arr::only($request->all(), array_keys($rules));
        $userData['email_verified_at'] = now();
        $userData['active'] = 1;

        $user = $this->userService->registerUser($userData);

        //Sync Roles
        $user->syncRoles(['customer']);

        $oClient = OClient::where('password_client', 1)->first();
        $tokens = $this->getTokenAndRefreshToken($oClient, $user->email, request('password'));

        unset($user['roles']);

        return returnApiResponse(true, 'Successfully user has been created', ['user' => collect($user)->only(['id', 'first_name', 'last_name', 'email', 'image']),
            'token' => $tokens['access_token'], 'refresh_token' => $tokens['refresh_token']]);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $user = User::where('email', $request->email)->first();
        //If user is not found
        if (!$user) {
            return returnApiResponse(false, 'User does not exist');
        }

        //If user password is not match
        if (!Hash::check($request->password, $user->password)) {
            return returnApiResponse(false, 'Password mismatch');
        }

        //If user login is not work
        if (!auth()->attempt($request->all())) {
            return returnApiResponse(false, 'Incorrect Details. Please try again');
        }

        $oClient = OClient::where('password_client', 1)->first();
        $tokens = $this->getTokenAndRefreshToken($oClient, request('email'), request('password'));

        // $token = auth()->user()->createToken('API Token')->accessToken;
        return returnApiResponse(true, 'Successfully logged in.', [
            'user' => collect($user)->only(['id', 'first_name', 'last_name', 'email', 'image']),
            'token' => $tokens['access_token'], 'refresh_token' => $tokens['refresh_token'],
        ]);
    }

    public function getTokenAndRefreshToken(OClient $oClient, $email, $password)
    {
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;
        $response = $http->request('POST', url('oauth/token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
    }

    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'bail|required',
            'last_name' => 'bail|required',
            'password' => 'nullable|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'image' => 'sometimes|file',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $message = 'Successfully profile has been updated.';

        $createD = [
            'first_name' => trim($request->first_name),
            'last_name' => trim($request->last_name),
        ];

        $passwordChanged = 0;
        if (!empty($request->password)) {
            $passwordChanged = 1;
            $createD['password'] = Hash::make(trim($request->password));
            $message .= 'You are changed your password, so you are going to logged off. Login again';
        }

        if ($request->hasFile('image')) {
            $createD['image'] = Storage::put('images', $request->image);
        }

        User::where('id', auth()->id())->update($createD);

        $userData = collect(User::find(auth()->id()))->only(['id', 'first_name', 'last_name', 'image']);

        if ($passwordChanged) {
            $token = $request->user()->token();
            $token->revoke();
        }

        return returnApiResponse(true, $message, !$passwordChanged ? [
            'logout' => 0,
            'user' => $userData,
        ] : [
            'logout' => 1,
        ]);
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return returnApiResponse(true, 'You have been successfully logged out!');
    }

    public function forgotPasswordRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return returnApiResponse(false, $validator->errors('email')->first());
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->statue != '2') {

                $emailAddress = $user->email;
                $isExists = 0;
                PasswordForgotRequest::where([['user_id', '=', $user->id], ['status', '=', '1']])->update(['status' => '0']);
                do {
                    $randomNumber = random_int(100000, 999999);
                    $isExists = PasswordForgotRequest::where([['user_id', '=', $user->id], ['otp', '=', $randomNumber]])->count();
                } while ($isExists == 1);

                PasswordForgotRequest::create([
                    'user_id' => $user->id,
                    'otp' => $randomNumber,
                ]);

                // Mail::send([], [], function ($message) use($emailAddress){
                //     $message->to($emailAddress)
                //         ->subject('Forgot Password Link')
                //         ->setBody('<h1>Hi, welcome user!</h1>', 'text/html'); // for HTML rich messages
                // });

                return returnApiResponse(true, 'Your request has been processing, please check your inbox.', [
                    'waitingTime' => 180,
                ]);

            } else {
                return returnApiResponse(false, 'Invalid email address');
            }
        } else {
            return returnApiResponse(false, 'User does not exist');
        }
    }

    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::exists('users')->where(function ($query) {
                    $query->where('active', 1);
                }),
            ],
            'otp' => 'required|integer|digits:6',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        $user = User::where('email', $request->email)->first();

        $isExists = PasswordForgotRequest::where([
            'user_id' => $user->id,
            'otp' => $request->otp,
            'status' => '1',
        ])->latest()->first();

        if ($isExists) {
            $nos = \Carbon\Carbon::now();
            $tt = \Carbon\Carbon::parse($isExists->created_at);

            if ($nos->diffInSeconds($tt) > 180) {

                PasswordForgotRequest::where([['id', '=', $isExists->id], ['status', '=', '1']])->update(['status' => '0']);
                return returnApiResponse(false, 'OTP is expired');
            }

            return returnApiResponse(true, 'OTP is valid');

        } else {
            return returnApiResponse(false, 'OTP is invalid');
        }

    }

    public function forgotPasswordUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|confirmed',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        User::where('id', $isValid->user_id)->update([
            'password' => Hash::make(trim($request->password)),
        ]);
        $isValid->status = '2';
        $isValid->save();

        return returnApiResponse(true, 'Successfully password has been reseted');
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'password' => 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|confirmed',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return returnApiResponse(false, 'validation_error');
        }

        User::where('id', auth()->id())->update([
            'password' => Hash::make(trim($request->password)),
        ]);

        return returnApiResponse(true, 'Successfully password has been updated');
    }
}
