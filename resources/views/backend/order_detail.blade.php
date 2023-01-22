@extends('backend.layouts.app')

@section('title', __('Orders'))

@section('content')
<style>
    .cut_opts {
        border: 1px solid #ccc;
        background-color: aliceblue;
        padding: 5px;
        border-radius: 5px;
    }
</style>
    <x-backend.card>
        <x-slot name="header">
            Order Detail : {{'#'.$order->order_no}}
            <a href="{{ url('admin/orders') }}" class="btn btn-dark float-right btn-sm"> <i class="fa fa-arrow-left"></i> BACK</a>
        </x-slot>

        <x-slot name="body">

        @php
            $paymentDetails = $couponDetails = [];
            try {
                $paymentDetails = unserialize($order->payment->payment_response);
            } catch (Exception $e) {
                $paymentDetails = [];
            }

            try {
                $couponDetails = unserialize($order->coupon_code);
            } catch (Exception $e) {
                $couponDetails = [];
            }
        @endphp

            <div class="row">

                <div class="col-12">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-dark">
                            <tr>
                                <th class="text-white">Order Details</th>
                                <th class="text-white">Customer Details</th>
                                <th class="text-white">Shipping Address</th>
                                <th class="text-white">Delivery Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p class="mb-1"><strong>{{'#'.$order->order_no}}</strong></p>
                                    <p class="mb-1">Order Date: <strong>{{  \Carbon\Carbon::parse($order->ordered_at)->format('d/m/Y') }}</strong></p>
                                    <p class="mb-1">Order Status: <b>{{ $order->order_status->label ?? '-' }}</b></p>
                                    <p class="mb-1">Payment Mode: <b>{{ $order->payment_mode == 'card' ? 'Online' : 'Pay On Delivery' }}</b></p>
                                    <p class="mb-1">Payment Status: <b>{{  $order->payment_mode == 'pod' ? ($order->payment_status == 1 ? 'Paid' : 'Pending') : 
                                        ($order->payment_status == 1 ? 'Paid' : 'Failed') }}</b></p>
                                    <p class="mb-1">Transaction number: {{ $paymentDetails['transaction_id'] ?? '-' }}</p>
                                    <a href=""> <i class="fa fa-mouse"></i> View Payment History</a>
                                </td>
                                <td>
                                    <p class="mb-1"><strong>{{ $order->customer->name }}</strong></p>
                                    <p class="mb-0">Email: {{ $order->customer->email }}</p>
                                    <p>Mobile: {{ $order->customer->mobile_no ?? '-' }}</p>
                                </td>
                                <td>
                                    @php
                        $shippingDetails = [];
                            try{
                                $shippingDetails = unserialize($order->shipping_details);
                            }catch(Exception $e){
                                $shippingDetails = [];
                            }
                    @endphp
                    @if(!empty($shippingDetails))
                    <p class="mb-1"><strong>{{ $shippingDetails['name'] }}</strong></p>
                    <p class="mb-0">{{ $shippingDetails['address'] }},</p>
                    <p class="mb-0">{{ $shippingDetails['city'].','.$shippingDetails['state'] }},</p>
                    <p class="mb-0">{{ (countryName($shippingDetails['country_id'])->name ?? '').','.$shippingDetails['zipcode'] }}.</p>
                    <p class="mb-0">Email: {{ $shippingDetails['email_address'] }}</p>
                    <p class="mb-0">Mobile: {{ $shippingDetails['mobile'] }}</p>

                    @else
                    <p>Address is not available.</p>
                    @endif
                                </td>
                                
                                <td>
                                    @php
                        $shippingDetails = [];
                            try{
                                $shippingDetails = unserialize($order->shipping_details);
                            }catch(Exception $e){
                                $shippingDetails = [];
                            }
                    @endphp
                    <p class="mb-1">Preferred Delivery Date: <strong>{{ !empty($order->preferred_delivery_date) ? \Carbon\Carbon::parse($order->preferred_delivery_date)->format('d/m/Y') : '-' }},</strong></p>
                    <p class="mb-1">Delivery Slot: <strong>{{ !empty($order->delivery_slot) ? $order->delivery_slot : '-' }}</strong>,</p>
                    <p class="mb-0">Delivery Instructions: <strong>{{ !empty($order->delivery_instructions) ? $order->delivery_instructions : '-' }}</strong>,</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-12">
                    <h4>Ordered Items:</h4>
                </div>
            </div>


            <table id="orderTable" class="table table-bordered table-hover">
                <thead class="bg-dark text-center">
                    <tr>
                    <th class="text-white" width="5%">#</th>
                    <th class="text-white" width="10%">IMAGE</th>
                    <th class="text-white">PRODUCT NAME</th>
                    <th class="text-white" width="5%">QUANTITY</th>
                    <th class="text-white" width="20%">AMOUNT</th>
                    <th class="text-white" width="20%">TOTAL AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $ik => $item)
                        @php
                            $productDetails = $cutOptions = [];
                                try{
                                    $productDetails = unserialize($item->product_details);
                                }catch(Exception $e){
                                    $productDetails = [];
                                }
                                try{
                                    $cutOptions = isset($productDetails['cut_options']) ? unserialize($productDetails['cut_options']) : [];
                                }catch(Exception $e){
                                    $cutOptions = [];
                                }
                        @endphp
                    <tr class="">
                        <td>{{ $ik+1 }}</td>
                        <td>
                            <img src="{{ (!empty($productDetails['image']) ? asset('storage/'.$productDetails['image']) : url('images/noimage.png')) }}" width="75" height="75"></td>
                        <td>
                            <p class="mb-0" style="font-size:22px;">{{ $productDetails['name'] }}</p>
                            <p>[{{ $productDetails['variant_name'].$productDetails['unit_name'] }}]</p>
                            @if(!empty($cutOptions))
                            <table>
                                <thead>
                                    <tr>
                                        <th>CUT OPTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            @foreach($cutOptions as $cut)
                                            <span class="cut_opts">{{$cut}}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                        </td>
                        <td align="center">{{ $item->quantity }}</td>
                        <td align="right"><strong>SGD {{ $item->price }}</strong></td>
                        <td align="right"><strong>SGD {{ $item->total_price }}</strong></td>
                    </tr>
                    @endforeach
                    <tr align="right" class="h5">
                        <td colspan="5">Sub Total</td>
                        <td>SGD {{number_format($order->amount,2)}}</td>
                    </tr>
                    <tr align="right" class="h5">
                        <td colspan="5">Shipping</td>
                        <td>SGD {{number_format($order->shipping_amount,2)}}</td>
                    </tr>
                    <!-- <tr align="right" class="h5">
                        <td colspan="5">Tax</td>
                        <td>SGD {{number_format($order->tax_amount,2)}}</td>
                    </tr> -->
                    <tr align="right" class="h5">
                        <td colspan="4">
                        @if(!empty($couponDetails))    
                            {{ $couponDetails['title'].' - '.$couponDetails['code'].' - ' }} 
                            @if($couponDetails['coupon_type']=='amount')
                                    SGD
                            @endif
                            {{ $couponDetails['offer_value'] }}
                            @if($couponDetails['coupon_type']!='amount')
                                %
                            @endif
                        @endif
                        </td>
                        <td>Discount (-) </td>
                        <td>SGD {{number_format($order->coupon_amount,2)}}</td>
                    </tr>
                    <tr align="right" class="h4">
                        <td colspan="5" >Grand Total</td>
                        <td>SGD {{number_format($order->total_amount,2)}}</td>
                    </tr>
                </tbody>
                </table>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
<script>
    $(document).ready( function () {


    });
</script>
@endpush
