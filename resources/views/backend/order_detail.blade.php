@extends('backend.layouts.app')

@section('title', __('Orders'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            Order Detail : {{'#'.$order->order_no}}
        </x-slot>

        <x-slot name="body">

            <div class="row">
                <div class="col">
                    <h4>Order Details:</h4>
                    <p class="mb-1"><strong>{{'#'.$order->order_no}}</strong></p>
                    <p class="mb-0">Email:</p>
                    <p>Mobile:</p>
                </div>
                <div class="col">
                    <h4>Cutomer Details:</h4>
                    <p class="mb-1"><strong>Lal</strong></p>
                    <p class="mb-0">Email:</p>
                    <p>Mobile:</p>
                </div>
                <div class="col">
                    @php
                        $shippingDetails = [];
                            try{
                                $shippingDetails = unserialize($order->shipping_details);
                            }catch(Exception $e){
                                $shippingDetails = [];
                            }
                    @endphp
                    <h4>Shipping Address:</h4>
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
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col">
                    <h4>Ordered Items:</h4>
                </div>
            </div>


            <table id="orderTable" class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                    <th>#</th>
                    <th>IMAGE</th>
                    <th>ITEM</th>
                    <th>QUANTITY</th>
                    <th>AMOUNT</th>
                    <th>TOTAL AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $ik => $item)
                        @php
                            $productDetails = [];
                                try{
                                    $productDetails = unserialize($item->product_details);
                                }catch(Exception $e){
                                    $productDetails = [];
                                }
                        @endphp
                    <tr>
                        <td>{{ $ik+1 }}</td>
                        <td>
                            <img src="{{ (!empty($productDetails['image']) ? env('IMG_URL').$productDetails['image'] : url('images/noimage.png')) }}" width="75" height="75"></td>
                        <td><strong>{{ $productDetails['name'] }}</strong>
                            <p>[<strong>{{ $productDetails['variant_name'].$productDetails['unit_name'] }}</strong>]</p>
                        </td>
                        <td><strong>{{ $item->quantity }}</strong></td>
                        <td><strong>${{ $item->price }}</strong></td>
                        <td><strong>${{ $item->total_price }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
<script>
    $(document).ready( function () {

        $('#orderTable').DataTable();

    });
</script>
@endpush
