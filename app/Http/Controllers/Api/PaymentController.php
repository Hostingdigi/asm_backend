<?php

namespace App\Http\Controllers\Api;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Models\CartAddress;
use App\Models\CommonDatas;
use App\Models\Payment;
use App\Services\CartServices;
use App\Services\OrderServices;
use App\Services\PaymentServices;
use Illuminate\Http\Request;
use Validator;

class PaymentController extends Controller
{
    protected $cartServices = null;
    protected $orderServices = null;
    protected $paymentServices = null;

    public function __construct(CartServices $cartServices, OrderServices $orderServices, PaymentServices $paymentServices)
    {
        $this->cartServices = $cartServices;
        $this->orderServices = $orderServices;
        $this->orderServices = $orderServices;
        $this->paymentServices = $paymentServices;
    }

    public function createStripePaymentIntend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'bail|required|integer',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        if ($this->cartServices->listItems()['unformatted_total_amount'] == 0) {
            return returnApiResponse(false, 'Cart is empty.');
        }

        $addressDetails = CartAddress::where([['user_id', '=', auth()->id()], ['id', '=', $request->address_id]])->first();

        if (empty($addressDetails)) {
            return returnApiResponse(false, 'Address is invalid.');
        }

        $stripeConfig = CommonDatas::select(['id', 'value_2 as pkey', 'value_3 as skey'])->where([['key', '=', 'stripe-config'], ['value_1', '=', 'test'], ['status', '=', '1']])->first();

        if (!$stripeConfig) {
            return returnApiResponse(false, 'Stripe configuation is not available');
        }

        $stripe = new \Stripe\StripeClient($stripeConfig->skey);
        $striptCustomerId = $customerFound = null;

        if (!empty(auth()->user()->stripe_cust_id)) {
            $striptCustomerId = auth()->user()->stripe_cust_id;
        } else { //Create new customer

            $createCustomer = $stripe->customers->create([
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->mobile ?? null,
                'metadata' => [
                    'user_id' => auth()->id(),
                ],
            ]);

            if (!empty($createCustomer->id)) {
                User::where('id', auth()->id())->update(['stripe_cust_id' => $createCustomer->id]);
                $striptCustomerId = $createCustomer->id;
            }
        }

        if (empty($striptCustomerId)) {
            return returnApiResponse(false, 'Stripe issue.');
        }

        //Update customer address
        $stripe->customers->update(
            $striptCustomerId,
            [
                'address' => [
                    'line1' => $addressDetails->address,
                    'city' => $addressDetails->city,
                    'state' => $addressDetails->state,
                    'country' => (countryName($addressDetails->country_id)->sortname ?? ''),
                    'postal_code' => $addressDetails->zipcode,

                ],
            ]
        );

        $ephemeralKey = $stripe->ephemeralKeys->create([
            'customer' => $striptCustomerId,
        ], [
            'stripe_version' => '2022-08-01',
        ]);

        //Create dummy order
        $orderData = $this->orderServices->createDummyOrder(['address_id' => $request->address_id, 'sent_response' => []]);
        $orderId = $orderData['data']['order_id'] ?? null;

        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => ($this->cartServices->listItems()['unformatted_total_amount'] * 100),
            'currency' => 'sgd',
            'customer' => $striptCustomerId,
            'payment_method_types' => [
                'card',
            ],
            'description' => 'Pasor order id is ' . $orderId . '.',
            'metadata' => [
                'order_id' => $orderId,
                'customer_id' => auth()->id(),
            ],
        ]);

        $sentResponse = [
            'paymentIntent' => $paymentIntent,
            'ephemeralKey' => $ephemeralKey,
        ];

        Payment::where([
            'order_id' => $orderId,
        ])->update(['sent_response' => serialize($sentResponse)]);

        return returnApiResponse(true, '', [
            'paymentIntent' => $paymentIntent->client_secret,
            'ephemeralKey' => $ephemeralKey->secret,
            'customer' => $striptCustomerId,
            'publishableKey' => $stripeConfig->pkey,
        ]);

// $customerFound = $stripe->customers->delete(
        //     'cus_MqKmECRZFeMixs',
        //     []
        // );

    }

    public function createEKey(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_version' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return returnApiResponse(false, $errors->all()[0] ?? '');
        }

        return response()->json($this->paymentServices->createEphemeralKey(['api_version' => $request->api_version]));
    }
}
