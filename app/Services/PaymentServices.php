<?php

namespace App\Services;

use App\Domains\Auth\Models\User;
use App\Models\CommonDatas;
use App\Models\Payment;
use App\Services\CartServices;

class PaymentServices
{
    protected $cartServices = null;

    public function __construct(CartServices $cartServices)
    {
        $this->cartServices = $cartServices;
    }

    public function createSripeCustomer($userId)
    {
        $stripeConfig = CommonDatas::select(['id', 'value_2 as pkey', 'value_3 as skey'])->where([['key', '=', 'stripe-config'], ['value_1', '=', 'test'], ['status', '=', '1']])->first();

        if (!$stripeConfig) {
            return [false, 'Stripe configuation is not available'];
        }

        $stripe = new \Stripe\StripeClient($stripeConfig->skey);
        $striptCustomerId = $customerFound = null;
        $user = User::find($userId);

        if (empty($user->stripe_cust_id)) {

            $createCustomer = $stripe->customers->create([
                'name' => trim($user->first_name . ' ' . $user->last_name),
                'email' => $user->email,
                'phone' => $user->mobile,
                'metadata' => [
                    'user_id' => $user->id,
                ],
            ]);

            if (!empty($createCustomer->id)) {
                User::where('id', $user->id)->update(['stripe_cust_id' => $createCustomer->id]);
                $striptCustomerId = $createCustomer->id;
            }

            if (empty($striptCustomerId)) {
                return [false, 'Stripe issue.'];
            }
        }

        return [true, 'success'];
    }

    public function createStripePaymentIntend($orderId, $paymentId)
    {
        $stripeConfig = CommonDatas::select(['id', 'value_2 as pkey', 'value_3 as skey'])->where([['key', '=', 'stripe-config'], ['value_1', '=', 'test'], ['status', '=', '1']])->first();

        if (!$stripeConfig) {
            return [false, 'Stripe configuation is not available'];
        }

        $stripe = new \Stripe\StripeClient($stripeConfig->skey);
        $striptCustomerId = $customerFound = null;

        if (!empty(auth()->user()->stripe_cust_id)) {
            $striptCustomerId = auth()->user()->stripe_cust_id;
        } else { //Create new customer

            $createCustomer = $stripe->customers->create([
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->mobile,
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
            return [false, 'Stripe issue.'];
        }

        $ephemeralKey = $stripe->ephemeralKeys->create([
            'customer' => $striptCustomerId,
        ], [
            'stripe_version' => '2022-08-01',
        ]);

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
            'id' => $paymentId,
            'order_id' => $orderId,
        ])->update(['sent_response' => serialize($sentResponse)]);

        return [true, '', [
            'paymentIntent' => $paymentIntent->client_secret,
            'ephemeralKey' => $ephemeralKey->secret,
            'customer' => $striptCustomerId,
            'publishableKey' => $stripeConfig->pkey,
        ]];

    }

    public function createEphemeralKey($data)
    {
        $stripeConfig = CommonDatas::select(['id', 'value_2 as pkey', 'value_3 as skey'])->where([['key', '=', 'stripe-config'], ['value_1', '=', 'test'], ['status', '=', '1']])->first();

        if (!$stripeConfig) {
            return [false, 'Stripe configuation is not available'];
        }
        $stripe = new \Stripe\StripeClient($stripeConfig->skey);
        
        return $stripe->ephemeralKeys->create([
            'customer' => auth()->user()->stripe_cust_id,
        ], [
            'stripe_version' => $data['api_version'],
        ]);

    }
}
