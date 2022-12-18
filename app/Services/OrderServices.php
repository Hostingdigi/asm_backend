<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\OrderHistory;
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

    public function updateOrderStatusHistory($data)
    {
        foreach ($data as $key => $value) {

            $isRowExists = OrderHistory::where([
                ['order_id', '=', $value['order_id']],
                ['status_code', '=', $value['status_code']],
                ['status', '=', '1'],
            ])->first();

            if($isRowExists){
                $isRowExists->status = '0';
                $isRowExists->save();
            }

            OrderHistory::create($value);
        }
    }

    public function updateOrderStatus($data)
    {
        return Order::where('id',$data['orderId'])->update(['status' => $data['statusValue']]);
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

    public function trackingDetails($order)
    {
        $dd = OrderStatus::select(['id', 'label', 'status_code'])->where('status', '1')
            ->whereIn('status_code', [3, 4, 5, 6])
            ->orderBy('sort_by', 'asc')->get();

        $buildOrderHis = [];
        $normalFormat = $dd;
        $orderSH = OrderHistory::where([['order_id', '=', $order->id], ['status', '=', '1']])->whereNotIn('status_code', [1])->oldest()->get()->toArray();

        foreach ($normalFormat as $nk => $nF) {

            $bd = [
                'label' => $nF['label'],
                'active_status' => 0,
                'updated_at' => null,
            ];
            $stCode = $nF['status_code'];
            $new = array_values(array_filter($orderSH, function ($var) use ($stCode) {
                return ($var['status_code'] == $stCode);
            }));

            if (!empty($new)) {
                $bd['active_status'] = 1;
                $bd['updated_at'] = \Carbon\Carbon::parse($new[0]['created_at'])->format('h:i A, d M Y');
            }

            array_push($buildOrderHis,$bd);

            $normalFormat[$nk]['activeStatus'] = 0;
        }

        $orderS = $order->status;
        $buildOrderHisT = null;
        if($orderS==2){
            $buildOrderHisT = array_values(array_filter($buildOrderHis, function ($var){
                return ($var['active_status']==1);
            }));

            $findCancelDetails = array_values(array_filter($orderSH, function ($var){
                return ($var['status_code']==2);
            }));

            array_push($buildOrderHisT,[
                'label' => 'Cancelled',
                'active_status' => 1,
                'updated_at' => \Carbon\Carbon::parse($findCancelDetails[0]['created_at'])->format('h:i A, d M Y')
            ]);
        }

        return $buildOrderHisT ?? $buildOrderHis;

    }

}
