<?php

namespace App\Services;
use App\Models\Cart;
use App\Models\CartCoupon;
use App\Models\Coupon;
use App\Models\CommonDatas;

class CartServices
{
    public function clearUserCart()
    {
        CartCoupon::where('user_id', auth()->id())->delete();
        Cart::where('user_id', auth()->id())->delete();
    }

    public function listItems()
    {
        $cartTotal = 0;
        $cartItems = Cart::select(['id as cart_id', 'product_id', 'variant_id', 'quantity'])->where('user_id', auth()->id())
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

            unset($row->variant);
            return $row;
        });

        $cartTotal = $cartItems->sum('price');
        $discountAmount = $this->coupounCalculations(['cartTotal' => $cartTotal]);
        $deliveryAmount = $this->shippingCalculations([
            'cartTotal' => ($cartTotal - $discountAmount['discountAmount']),
        ]);
        $totalAmount = (($cartTotal + $deliveryAmount) - $discountAmount['discountAmount']);

        return [
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
            if ($data['cartTotal'] > $isFreeShipping->value_1) {
                return $shippingAmount;
            }
        }

        //Calculate shipping price based on KM

        return $shippingAmount;
    }
}
