<?php

namespace App\Http\Controllers\Api;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/|confirmed',
            'mobile' => 'nullable|digits:10',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            $formatedErrors = [];

            foreach ($rules as $rk => $rule) {
                if ($errors->has($rk)) {
                    array_push($formatedErrors, [$rk => $errors->first($rk)]);
                }
            }

            return response([
                'status' => false,
                'message' => $formatedErrors,
                'data' => null,
            ], 200);
        }

        $userData = Arr::only($request->all(), array_keys($rules));
        $userData['email_verified_at'] = now();
        $userData['active'] = 1;

        $user = $this->userService->registerUser($userData);

        $user->syncRoles(['customer']);

        $token = $user->createToken('API Token')->accessToken;

        // $data['password'] = bcrypt($request->password);
        // $user = User::create($data);
        // $token = $user->createToken('API Token')->accessToken;

        // return response([ 'user' => $user, 'token' => $token]);
        unset($user['roles']);

        return response()->json(['status' => true, 'message' => 'Successfully user has been created',
            'data' => ['token' => $token, 'user' => collect($user)->only(['id', 'name', 'email', 'avatar'])],
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['status' => false, 'message' => $validator->errors()->all(), 'data' => null], 200);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                if (!auth()->attempt($request->all())) {
                    return response(['status' => false, 'message' => ['Incorrect Details.
                            Please try again', ]]);
                }

                $token = auth()->user()->createToken('API Token')->accessToken;
                // $token = 1;// $user->createToken('API Token')->accessToken;
                $response = ['status' => true, 'message' => 'Successfully logged in.', 'data' => [
                    'token' => $token, 'user' => collect($user)->only(['id', 'name', 'email', 'avatar'])],
                ];
                return response($response, 200);
            } else {
                $response = ['status' => false, "message" => ["Password mismatch"], 'data' => null];
                return response($response, 200);
            }
        } else {
            $response = ['status' => false, "message" => ['User does not exist'], 'data' => null];
            return response($response, 200);
        }

        return response()->json($request->all());
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response(['status' => true, 'message' => 'You have been successfully logged out!', 'data' => null], 200);
    }
}
