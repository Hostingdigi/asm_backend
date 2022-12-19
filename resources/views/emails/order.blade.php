<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hi <b>{{$order->customer->name}}!</b>,
<p>Your order has been placed successfully.</p>

<h4>Order Details:</h4>
@php
    $shippingAddress = null;
    try{
        $shippingAddress = unserialize($order->shipping_details);
    }catch(Exception $e){
        $shippingAddress = null;
    }
@endphp
<table border="1px">
    <thead>
        <tr>
            <th>Order Details</th>
            <th>Shipping Address</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <table border="1px">
                    <tbody>
                        <tr>
                            <td>Order Number</td>
                            <td>#{{$order->order_no}}</td>
                        </tr>
                        <tr>
                            <td>Order Place Date</td>
                            <td>{{\Carbon\Carbon::parse($order->ordered_at)->format('d/m/Y h:i:s A')}}</td>
                        </tr>
                        <tr>
                            <td>Order Status</td>
                            <td>{{$order->order_status->label}}</td>
                        </tr>
                        <tr>
                            <td>Payment Mode</td>
                            <td>{{ $order->payment_mode == 'card' ? 'Online' : 'Pay On Delivery' }}</td>
                        </tr>
                        <tr>
                            <td>Payment Status</td>
                            <td>{{  $order->payment_mode == 'pod' ? ($order->payment_status == 1 ? 'Paid' : 'Pending') : 
                                    ($order->payment_status == 1 ? 'Paid' : 'Failed') }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table border="1px">
                    <tbody>
                        @if(!empty($shippingAddress))
                        <tr>
                            <td>Name</td>
                            <td>{{$shippingAddress['name']}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{$shippingAddress['email_address']}}</td>
                        </tr>
                        <tr>
                            <td>Mobile</td>
                            <td>{{$shippingAddress['mobile']}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$shippingAddress['address']}},
                                <br>
                                {{$shippingAddress['city']}},
                                <br>
                                {{$shippingAddress['state']}},
                                <br>
                                {{countryName($shippingAddress['country_id'])->name.' - '.$shippingAddress['zipcode']}}.
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td>Not found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<br>
<table border="1px">
    <thead>
        <tr>
            <th>#</th>
            <th>ITEM</th>
            <th>QUANTITY</th>
            <th>PRICE</th>
            <th>TOTAL PRICE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $ik => $item)
        <tr>
            <td>{{$ik+1}}</td>
            <td>{{ $item->product->name }}</td>
            <td align="center">{{ $item->quantity }}</td>
            <td align="right">${{ $item->price }}</td>
            <td align="right">${{ $item->total_price }}</td>
        </tr>
        @endforeach
        <tr align="right">
            <td colspan="4">Sub Total</td>
            <td>${{number_format($order->amount,2)}}</td>
        </tr>
        <tr align="right">
            <td colspan="4">Shipping</td>
            <td>${{number_format($order->shipping_amount,2)}}</td>
        </tr>
        <!-- <tr align="right">
            <td colspan="4">Tax</td>
            <td>${{number_format($order->tax_amount,2)}}</td>
        </tr> -->
         <tr align="right">
            <td colspan="4">Discount (-) </td>
            <td>${{number_format($order->coupon_amount,2)}}</td>
        </tr>
        <tr align="right">
            <td colspan="4" >Grand Total</td>
            <td>${{number_format($order->total_amount,2)}}</td>
        </tr>
    </tbody>
</table>
</body>
</html>

