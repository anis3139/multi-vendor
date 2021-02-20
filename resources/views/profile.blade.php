@extends('layouts.app')
@section('css')

<style>
.profile{
    margin: 20px 0px!important;
}
</style>

@endsection

@section('mainContent')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 mt-5">
                <img src="{{auth()->user()->image ?? asset('images/default-image.png') }}" alt="{{auth()->user()->name}}" width="150px" height="150px" style="border-radius:50%; margin:0 auto !important; display:block">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $key => $product)

                            <tr>
                                <td>
                                    {{ $product['title'] }} <strong> ({{ $product['main_price'] }}x {{ $product['quantity'] }})</strong>
                                </td>
                                <td>
                                    &#2547; &nbsp;{{  number_format($product['main_price'] * $product['quantity'],2)  }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Total Price</th>
                            <td>&#2547; &nbsp;{{ number_format($total_main_price, 2)}}</td>
                        </tr>
                        <tr>
                            <th>Total Discount</th>
                            <td>&#2547; &nbsp;{{ number_format($total_discount, 2)}}</td>
                        </tr>
                        <tr>
                            <th>Subtotal (After Discount)</th>
                            <td>&#2547; &nbsp;{{ number_format($total, 2)}}</td>
                        </tr>
                        <tr>
                            <th>Tax</th>
                            <td>&#2547; &nbsp;{{ number_format($total_tax, 2)}}</td>
                        </tr>
                        <tr>
                            <th>Delivery Charge</th>
                            <td>&#2547; &nbsp;{{ number_format($total_delivery_charge, 2) }}</td>
                        </tr>

                        <tr>
                            <th>Total Paid Amount</th>
                            <td>&#2547; &nbsp;{{ number_format( $total+ $total_tax + $total_delivery_charge , 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>


        <div class="col-md-10 offset-md-1 text-center mt-5">

            <table class="table table-bordered table-hover" style="padding:10px;">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer name</th>
                        <th class="hidden-xs">Customer Phone Number</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->customer_name}}</td>
                            <td class="hidden-xs">{{$order->customer_phone_number}}</td>
                            <td>tk&nbsp;{{number_format($order->total_amount, 2)}}</td>
                            <td>tk&nbsp;{{number_format($order->paid_amount, 2)}}</td>
                            <td><a class="text-primary" href="{{route('client.orderDetails', $order->id)}}">View Details</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@endsection
