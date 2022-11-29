<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Services\CartServices;

class OrderServices
{

    protected $cartServices = null;
    protected $cartAddress = null;

    public function __construct(CartServices $cartServices, CartAddress $cartAddress)
    {
        $this->cartServices = $cartServices;
        $this->cartAddress = $cartAddress;
    }

    public function createDummyOrder($orderData)
    {

        $cartAmount = $taxAmount = $totalAmount = $shippingAmount = $couponAmount = $orderNo = 0;
        list($couponCode, $billingDetails, $shippingDetails, $orderItems) = [[], [], [], []];
        $shippingDetails = CartAddress::where([['user_id', '=', auth()->id()], ['id', '=', $orderData['address_id']]])
            ->select($this->cartAddress->addressFields())->first();
        $shippingDetails = $shippingDetails->toArray();

        $cartItems = Cart::where('user_id', auth()->id())->get();

        foreach ($cartItems as $key => $value) {

            $product = Product::where([
                ['status', '=', '1'],
                ['id', '=', $value->product_id],
            ])->first();

            if ($product) {

                $price = $value->variant->price;

                $orderItems[] = [
                    'order_id' => 0,
                    'product_id' => $product->id,
                    'variant_id' => $value->variant_id,
                    'quantity' => $value->quantity,
                    'price' => $price,
                    'total_price' => $price * $value->quantity,
                    'product_details' => serialize([
                        'id' => $product->id,
                        'name' => $product->name,
                        'category_id' => $product->category_id,
                        'category_name' => $product->category->name,
                        'brand_id' => $product->brand_id,
                        'brand_name' => $product->brand->name ?? '',
                        'image' => $product->cover_image,
                        'variant_name' => $value->variant->name,
                        'unit_name' => $value->variant->unit->name,
                    ]),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
                $cartAmount += $price * $value->quantity;
            }
        }

        $totalAmount = $cartAmount;

        //Check already have any dummy order
        $isOrderExists = Order::where([['user_id', '=', auth()->id()], ['is_dummy_order', '=', 1]])->first();

        if (!empty($isOrderExists)) {

            OrderItem::where('order_id', $isOrderExists->id)->delete();

            //Assign order id to items
            array_walk_recursive($orderItems, function (&$item, $key) use ($isOrderExists) {
                if ($key == 'order_id') {
                    $item = $isOrderExists->id;
                }
            });
            OrderItem::insert($orderItems);

            Order::where('id', $isOrderExists->id)->update([
                'total_amount' => $totalAmount,
                'tax_amount' => $taxAmount,
                'amount' => $cartAmount,
                'shipping_amount' => $shippingAmount,
                'coupon_amount' => $couponAmount,
                'coupon_code' => serialize($couponCode),
                'billing_details' => serialize($billingDetails),
                'shipping_details' => serialize($shippingDetails),
                'ordered_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            ]);

            return [
                'status' => true,
                'data' => [
                    'order_id' => $isOrderExists->id,
                ],
            ];

        } else {

            if ($totalAmount > 0) {

                $orderNo = sprintf('%05d', Order::count());

                //Create order
                $order = Order::create([
                    'is_dummy_order' => 1,
                    'order_no' => $orderNo,
                    'payment_mode' => 'card',
                    'user_id' => auth()->id(),
                    'total_amount' => $totalAmount,
                    'tax_amount' => $taxAmount,
                    'amount' => $cartAmount,
                    'shipping_amount' => $shippingAmount,
                    'coupon_amount' => $couponAmount,
                    'coupon_code' => serialize($couponCode),
                    'billing_details' => serialize($billingDetails),
                    'shipping_details' => serialize($shippingDetails),
                    'ordered_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                //Update payment
                $payment = Payment::create([
                    'order_type' => 'card',
                    'order_id' => $order->id,
                    'status' => 0,
                    'sent_response' => serialize([]),
                ]);
                Order::where('id', $order->id)->update(['payment_id' => $payment->id]);

                //Assign order id to items
                array_walk_recursive($orderItems, function (&$item, $key) use ($order) {
                    if ($key == 'order_id') {
                        $item = $order->id;
                    }
                });
                OrderItem::insert($orderItems);

                return [
                    'status' => true,
                    'data' => [
                        'order_id' => $order->id,
                    ],
                ];
            }
        }

        return [
            'status' => false,
            'message' => 'Cart items are not available',
        ];
    }

}
