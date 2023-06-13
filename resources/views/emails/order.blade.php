<!DOCTYPE html>
<html lang="en" xmlns="https://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title>Order Mail</title>
    <!--[if mso]> 
    <style> 
    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;} 
    div, td {padding:0;} 
    div {margin:0 !important;} 
    </style> 
    <noscript> 
    <xml> 
    <o:OfficeDocumentSettings> 
    <o:PixelsPerInch>96</o:PixelsPerInch> 
    </o:OfficeDocumentSettings> 
    </xml> 
    </noscript> 
    <![endif]-->
    <style>
        table, td, div, h1, a, p {
            font-family: Arial, sans-serif;
        }

        @media screen and (max-width: 530px) {
            .unsub {
                display: block;
                padding: 8px;
                margin-top: 14px;
                border-radius: 6px;
                background-color: #555555;
                text-decoration: none !important;
                font-weight: bold;
            }

            .col-lge {
                max-width: 100% !important;
            }
        }

        @media screen and (min-width: 531px) {
            .col-sml {
                max-width: 27% !important;
            }
            .col-lge {
                max-width: 73% !important;
            }
        }
    </style>
</head>
@php
    $shippingAddress = null;
    try{
        $shippingAddress = unserialize($order->shipping_details);
    }catch(Exception $e){
        $shippingAddress = null;
    }
@endphp
<body style="margin:0;padding:0;word-spacing:normal;background-color:#e7e7e7;">
    <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;">
        <table role="presentation" style="width:100%;border:none;border-spacing:0;background-color: #eee;">
            <tr>
                <td align="center" style="padding:0;">
                    <!--[if mso]> 
                    <table role="presentation" align="center" style="width:600px;"> 
                    <tr> 
                    <td> 
                    <![endif]-->
                    <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;
                                background-color: #fff;">
                        
                        @include('emails.includes.mail_header')
                        <tr>
                            <td style="padding:10px 30px 0px 30px;background-color:#ffffff;">
                                <h1
                                    style="margin-top:0;margin-bottom:4px;font-size:20px;line-height:32px;font-weight:normal;letter-spacing:-0.02em;">
                                    Hello {{$order->customer->name}}, </h1>
                                <p style="margin:0;font-weight: normal; font-size: large; padding: 5px 0px 5px 0px;">
                                    Thank you for your order.
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 30px 0px 30px;background-color:#ffffff;">
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 50%;">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <p style="padding-bottom: 1px; margin: 0;">Delivery Type: 
                                                            <strong>@if(!empty($shippingAddress))
                                                                {{$shippingAddress['address_type'] ?? '-'}} @endif</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="padding-bottom: 1px; margin: 0;">Delivery Date: <strong>{{ !empty($order->preferred_delivery_date) ? \Carbon\Carbon::parse($order->preferred_delivery_date)->format('d/m/Y') : (!empty($order->expected_delivery_date) ? \Carbon\Carbon::parse($order->expected_delivery_date)->format('d/m/Y')) }}</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="padding-bottom: 1px; margin: 0;">Delivery Slot: <strong>{{ !empty($order->delivery_slot) ? $order->delivery_slot : '-' }}</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="padding-bottom: 1px; margin: 0;">Delivery Instructions: <strong>{{ !empty($order->delivery_instructions) ? $order->delivery_instructions : '-' }}</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="padding-bottom: 1px; margin: 0;">Payment Mode: <strong>{{ $order->payment_mode == 'card' ? 'Online' : 'Pay Now' }}</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="padding-bottom: 1px; margin: 0;">Payment Status: <strong>{{  $order->payment_mode == 'pod' ? ($order->payment_status == 1 ? 'Paid' : 'Pending') : 
                                    ($order->payment_status == 1 ? 'Paid' : 'Failed') }}</strong>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="text-align: right; width: 50%;">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <p style="padding: 0px; margin: 0;">Order Number: <strong>#{{$order->order_no}}</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="padding: 0px; margin: 0;">Order Date: <strong>{{\Carbon\Carbon::parse($order->ordered_at)->format('d/m/Y h:i A')}}</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="padding-bottom: 1px; margin: 0;">Order Status: <strong>{{$order->order_status->label ?? ''}}</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="padding: 0px; margin: 0;">Phone Number: <strong>{{$shippingAddress['mobile']}}</strong></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p style="padding: 0px; margin: 0;">Address: 
                                                            <strong>@if(!empty($shippingAddress))
                                                                {{$shippingAddress['name']}},
                                                                {{$shippingAddress['address']}},
                                                                {{$shippingAddress['city']}},
                                                                {{$shippingAddress['state']}},
                                                                {{countryName($shippingAddress['country_id'])->name.' - '.$shippingAddress['zipcode']}}
                                                                @endif
                                                            </strong>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="text-align: center; font-weight:bold; font-size: large; margin-bottom: 0;">Order Details</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 30px 10px 30px;">
                                <table style="width: 100%; border: 1px solid #ccc;">
                                    <thead>
                                        <tr>
                                            <th style="border: 1px solid #ccc;">Qty</th>
                                            <th style="border: 1px solid #ccc;">Item Name</th>
                                            <th style="border: 1px solid #ccc;">Cut Options</th>
                                            <th style="border: 1px solid #ccc;">Price</th>
                                            <th style="border: 1px solid #ccc;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $ik => $item)
                                            @php
                                                $cutOptions = [];
                                                if(!empty($item->product_details)){
                                                    try{
                                                        $expandPD = unserialize($item->product_details); 
                                                        try{
                                                            $cutOptions = $expandPD['cut_options'] ? unserialize($expandPD['cut_options']) : []; 
                                                        }catch(Exception $e){
                                                            $cutOptions = [];
                                                        }
                                                    }catch(Exception $e){
                                                        $cutOptions = [];
                                                    }
                                                }
                                            @endphp
                                        <tr style="border: 1px solid #ccc;">
                                            <td style="border: 1px solid #ccc;">{{ $item->quantity }}</td>
                                            <td style="border: 1px solid #ccc;">{{ $item->product->name }}</td>
                                            <td style="border: 1px solid #ccc;">{{ implode(',',$cutOptions) }}</td>
                                            <td style="border: 1px solid #ccc;" align="right">${{ $item->price }}</td>
                                            <td style="border: 1px solid #ccc;" align="right">${{ $item->total_price }}</td>
                                        </tr>
                                        @endforeach
                                        <tr style="border: 1px solid #ccc;">
                                            <td style="border: 1px solid #ccc; text-align: center;" colspan="3">Total
                                                Charge</td>
                                            <td style="border: 1px solid #ccc;" align="right">${{number_format($order->amount,2)}}</td>
                                        </tr>
                                        <tr style="border: 1px solid #ccc;">
                                            <td style="border: 1px solid #ccc; text-align: center;" colspan="3">Delivery
                                                Charges</td>
                                            <td style="border: 1px solid #ccc;" align="right">${{number_format($order->shipping_amount,2)}}</td>
                                        </tr>
                                        <tr style="border: 1px solid #ccc;">
                                            <td style="border: 1px solid #ccc; text-align: center;" colspan="3">Discount (-)</td>
                                            <td style="border: 1px solid #ccc;" align="right">${{number_format($order->coupon_amount,2)}}</td>
                                        </tr>
                                        <tr style="border: 1px solid #ccc;">
                                            <td style="border: 1px solid #ccc; text-align: center;" colspan="3">Grand
                                                Total</td>
                                            <td style="border: 1px solid #ccc;" align="right">${{number_format($order->total_amount,2)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="text-align: center;">
                                    <strong>Further Enquires Call <span style="color: blue;">+65 000000</span> Or Email To 
                                        <a href="mailto:#">EMAIL</a> </strong>
                                </p>
                            </td>
                        </tr>
                        @include('emails.includes.mail_footer')
                    </table>
                    <!--[if mso]> 
                    </td> 
                    </tr> 
                    </table> 
                    <![endif]-->
                </td>
            </tr>
        </table>
    </div>
</body>
</html>