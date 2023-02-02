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
        CartCoupon::where('user_id', auth()->id())->delete();
        Cart::where('user_id', auth()->id())->delete();
    }

    public function listItems($addtionalData = null)
    {
        $cartTotal = 0;
        $cartItems = Cart::select(['id as cart_id', 'product_id', 'variant_id', 'quantity', 'cut_options'])->where('user_id', auth()->id())
            ->with(['product' => function ($query) {
                $query->select(['id', 'name', 'cover_image'])->with(['variants' => function ($query) {
                    $query->select(['id', 'product_id', 'name', 'unit_id', 'price'])->with(['unit:id,name']);
                }]);
            }])->latest()->get();

        $cartItems->map(function ($row) {

            $row->product->cover_image = $row->product->formatedcoverimageurl;
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
            'threshold_amount' => $thresholdAmountResults ? $thresholdAmountResults->amount : 0,
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
                            $distance = 0;
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
