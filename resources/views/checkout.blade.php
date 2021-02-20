
@extends('layouts.app')
@section('title',"Cart")
@section('mainContent')


<!-- Cart view section -->
<section id="checkout">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="checkout-area">
                    @include('massege')
                    @include('errorMassage')
                    <div class="row">
                        @guest
                            <div class="col-md-12 text-center">
                                <h1>You need to <a class="text-primary" href="{{ route('client.login') }}"> Login </a>First
                                </h1>
                            </div>
                        @endguest
                        @auth
                            <div class="col-md-12">
                                <h1>You ordering as {{ auth()->user()->name }} </a></h1>
                            </div>
                        @endauth

                    </div>
                    @auth()


                        <form action="{{route('client.processOrder')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">

                                    <div class="accordion" id="accordionExample">
                                        <div class="card">
                                          <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                              <button class="btn btn-link btn-block text-left text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Billing Address
                                              </button>
                                            </h2>
                                          </div>

                                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                <div class="col-md-12">
                                                    <div class="aa-checkout-single-bill form-group">
                                                        <input class="form-control" type="text" placeholder="Name*" value="{{ auth()->user()->name }}" name="customer_name">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="aa-checkout-single-bill form-group">
                                                        <input class="form-control" type="tel" placeholder="Phone*" name="customer_phone_number" value="{{ auth()->user()->phone_number }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="aa-checkout-single-bill form-group">
                                                        <textarea cols="8" rows="3" class="form-control" name="address" placeholder="Address*"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill form-group">
                                                        <input type="text" name="country" value="Bangladesh" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill form-group">
                                                        <input type="text" class="form-control" placeholder="City / Town*" class="form-control" name="city">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill form-group">
                                                        <input class="form-control" type="text" placeholder="District*" name="district">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="aa-checkout-single-bill form-group">
                                                        <input type="text" class="form-control" placeholder="Postcode / ZIP*" name="postal_code">
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="card">
                                          <div class="card-header" id="headingTwo">
                                            <h2 class="mb-0">
                                              <button class="btn btn-link btn-block text-left collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Shiping Address
                                              </button>
                                            </h2>
                                          </div>
                                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="aa-checkout-single-bill form-group">
                                                            <input type="text" placeholder="Name*" class="form-control" value="" name="shipping_customer_name">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="aa-checkout-single-bill form-group">
                                                            <input type="tel" placeholder="Phone*" class="form-control" name="shipping_customer_phone_number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="aa-checkout-single-bill form-group">
                                                            <textarea cols="8" rows="3" class="form-control"
                                                                name="shipping_address" placeholder="Shipping Address*"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="aa-checkout-single-bill form-group">

                                                            <input type="text" name="shipping_country" class="form-control" value="Bangladesh" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="aa-checkout-single-bill form-group">
                                                            <input type="text" class="form-control" placeholder="City / Town*"
                                                                name="shipping_city">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="aa-checkout-single-bill form-group">
                                                            <input type="text" class="form-control" placeholder="District*"
                                                                name="shipping_district">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="aa-checkout-single-bill form-group">
                                                            <input type="text" class="form-control" placeholder="Postcode / ZIP*" name="shipping_postal_code">
                                                        </div>
                                                    </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkout-right">
                                        <h4>Order Summary</h4>
                                        <div class="aa-order-summary-area">
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
                                        <h4>Payment Method</h4>
                                        <div class="aa-payment-method">
                                            <label for="cashdelivery">
                                                <input type="radio" id="cashdelivery" checked   value="cashdelivery" name="payment_details"> Cash on Delivery
                                            </label>
                                            <label for="paypal">
                                                <input type="radio" id="paypal"  value="paypal" name="payment_details"> Via Paypal
                                            </label>
                                            <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg"
                                                border="0" alt="PayPal Acceptance Mark">

                                            @IF($total>0)
                                            <input class="btn btn-success" type="submit" value="Place Order" class="aa-browse-btn">
                                            @ELSE
                                             <input class="btn btn-danger"  value="Your Cart is empty" class="aa-browse-btn">
                                            @ENDIF
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="cart-view-total" style="margin:0px auto; display:block; width:auto; float:left;">
                            <a href="{{ route('all-product') }}" class="aa-cart-view-btn btn btn-primary" >Continue Shoping</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Cart view section -->


@endsection
