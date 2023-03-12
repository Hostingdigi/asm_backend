<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartAddress;
use App\Models\CartCoupon;
use App\Models\CommonDatas;
use App\Models\Coupon;
use App\Models\ShippingDistAmounts;

class CartServices
{

    public function clearUserCart()
    {
        $userCartCoupon = CartCoupon::where('user_id', auth()->id())->first();
        if ($userCartCoupon) {
            CartCoupon::where('user_id', auth()->id())->delete();
            if ($userCartCoupon->coupon->nature == 'referral') {
                if ($userCartCoupon->coupon->referral && $userCartCoupon->coupon->referral->child_user == auth()->id()) {
                    Coupon::where([['user_id', '=', $userCartCoupon->coupon->referral->parent_user],
                        ['referral_id', '=', $userCartCoupon->coupon->referral->id]])->update([
                        'status' => '1',
                    ]);
                }
            }
            Coupon::where([['user_id', '=', auth()->id()], ['id', '=', $userCartCoupon->coupon_id]])->delete();
        }
        Cart::where('user_id', auth()->id())->delete();
    }

    public function getGoogleDistance($latLong)
    {
        $distanceValue = 0;
        $googleDistanceApiKey = CommonDatas::select(['id', 'value_1 as url', 'value_2 as apikey'])->where([['key', '=', 'google_distance_api_key'], ['value_1', '!=', ''], ['value_2', '!=', ''], ['status', '=', '1']])->first();
        $headQLatLang = CommonDatas::select(['id', 'value_1 as lat', 'value_2 as lang'])->where([['key', '=', 'head-quarters-lat-lang'], ['value_1', '!=', ''], ['value_2', '!=', ''], ['status', '=', '1']])->first();
        if ($headQLatLang && $googleDistanceApiKey && (!empty($latLong['latitude']) && !empty($latLong['longitude']))) {
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->request('GET', $googleDistanceApiKey->url, ['query' => [
                    'origins' => ($headQLatLang->lat . ',' . $headQLatLang->lang),
                    'destinations' => ($latLong['latitude'] . ',' . $latLong['longitude']),
                    'key' => $googleDistanceApiKey->apikey,
                ]]);
                $distanceResults = json_decode($response->getBody(), true);
                if (!empty($distanceResults)) {
                    if (!empty($distanceResults['status']) && $distanceResults['status'] == 'OK' && !empty($distanceResults['rows'][0]['elements'][0]['distance']['value'])) {
                        $distanceValue = $distanceResults['rows'][0]['elements'][0]['distance']['value'];
                        $distanceValue = $distanceValue > 0 ? $distanceValue / 1000 : 0;
                    }
                }
            } catch (\Exception $e) {
                $distanceValue = 0;
            }
        }
        return $distanceValue;
    }

    public function listItems($addtionalData = null)
    {
        $cartTotal = 0;
        $cartItems = Cart::select(['id as cart_id', 'product_id', 'variant_id', 'quantity', 'cut_options'])->where('user_id', auth()->id())
            ->with(['product' => function ($query) {
                $query->select(['id', 'name', 'cover_image'])->with(['variants' => function ($query) {
                    $query->select(['id', 'product_id', 'name', 'unit_id', 'price'])
                        ->where('status', '1')->with(['unit:id,name']);
                }]);
            }])->latest()->get();

        $cartItems->map(function ($row) {

            $row->product->cover_image = str_replace(asset('storage') . '/' . asset('storage') . '/', asset('storage/') . '/', $row->product->formatedcoverimageurl);
            $row->price = $row->variant->price * $row->quantity;
            $row->formatted_price = number_format($row->variant->price * $row->quantity, 2);
            $row->unit_id = $row->variant->unit_id;
            $row->unit_name = $row->variant->name . $row->variant->unit->name;
            $row->cut_options = !empty($row->cut_options) ? unserialize($row->cut_options) : null;

            unset($row->variant);
            return $row;
        });

        $cartTotal = $cartItems->sum('price');
        $discountAmount = $this->coupounCalculations(['cartTotal' => $cartTotal]);
        $deliveryAmount = $this->shippingCalculations([
            'addressId' => $addtionalData['addressId'] ?? null,
            'cartTotal' => ($cartTotal - $discountAmount['discountAmount']),
        ]);
        $totalAmount = (($cartTotal + $deliveryAmount) - $discountAmount['discountAmount']);

        $thresholdAmountResults = CommonDatas::select(['id', 'value_1 as amount'])->where([['key', '=', 'cart_threshold_amount'], ['value_1', '!=', ''], ['status', '=', '1']])->first();

        return [
            'threshold_amount' => (float) ($thresholdAmountResults ? $thresholdAmountResults->amount : 0),
            'sub_total' => number_format($cartTotal, 2),
            'delivery_amount' => number_format($deliveryAmount, 2),
            'discount_amount' => number_format($discountAmount['discountAmount'], 2),
            'total_amount' => number_format($totalAmount, 2),
            'unformatted_total_amount' => $totalAmount,
            'unformatted_discount_amount' => (float) $discountAmount['discountAmount'],
            'unformatted_delivery_amount' => (float) $deliveryAmount,
            'coupon_details' => $discountAmount['couponDetails'],
            'cart_items' => $cartItems,
        ];

    }

    public function coupounCalculations($data = null)
    {
        $discountAmount = 0;
        $couponDetails = null;
        if ($data['cartTotal'] > 0) {
            $currentCoupon = CartCoupon::select(['id', 'coupon_id'])->where([
                ['user_id', '=', auth()->id()],
                ['status', '=', '1'],
            ])->first();
            if ($currentCoupon) {
                $couponDetails = Coupon::select(['id', 'title', 'code', 'offer_value', 'coupon_type', 'image', 'description'])->find($currentCoupon->coupon_id);

                if ($couponDetails) {
                    $couponDetails->image = $couponDetails->formatedimageurl;
                    $discountAmount = ($couponDetails->coupon_type == 'percentage') ? (($data['cartTotal'] * $couponDetails->offer_value) / 100) :
                    $couponDetails->offer_value;
                }
            }
        }
        return [
            'couponDetails' => $couponDetails,
            'discountAmount' => $discountAmount,
        ];
    }

    public function shippingCalculations($data = null)
    {
        $shippingAmount = 0;
        //Check if free shipping available
        $isFreeShipping = CommonDatas::select(['id', 'value_1'])->where([['key', '=', 'free-shipping-config'], ['status', '=', '1']])->first();

        if ($isFreeShipping) {
            if ($data['cartTotal'] < $isFreeShipping->value_1) {
                //Calculate shipping price based on KM
                if (!empty($data['addressId'])) {
                    $cartAddress = CartAddress::where([
                        ['user_id', '=', auth()->id()],
                        ['id', '=', $data['addressId']],
                    ])->first();

                    if ($cartAddress) {
                        $distance = 0;
                        if ($cartAddress->distance != 0) {
                            $distance = $cartAddress->distance;
                        } else { //Find distance

                            CartAddress::where('id', $cartAddress->id)->update([
                                'distance' => $this->getGoogleDistance([
                                    'latitude' => !empty($cartAddress->latitude) ? $cartAddress->latitude : null,
                                    'longitude' => !empty($cartAddress->longitude) ? $cartAddress->longitude : null,
                                ]),
                                'warehouse_updated_at' => CommonDatas::select(['id', 'updated_at'])->where([['key', '=', 'head-quarters-lat-lang'], ['value_1', '!=', ''], ['value_2', '!=', ''], ['status', '=', '1']])->first()->updated_at ?? null,
                            ]);

                            $distance = CartAddress::find($cartAddress->id)->distance ?? 0;

                        }

                        if ($distance != 0) {

                            $distanceAmount = ShippingDistAmounts::whereRaw("'" . $distance . "' >= from_distance and '" . $distance . "' <= to_distance")
                                ->where('status', '1')->first();

                            // Above Limit
                            $distanceAmountAbove = ShippingDistAmounts::whereRaw("'" . $distance . "' >= from_distance and (to_distance=0 || to_distance is null)")
                                ->where('status', '1')->first();

                            if ($distanceAmount) {
                                $shippingAmount = $distanceAmount->amount;
                            } else if ($distanceAmountAbove) {
                                $shippingAmount = $distanceAmountAbove->amount;
                            }
                        }
                    }
                }

            }
        }

        return $shippingAmount;
    }
}
