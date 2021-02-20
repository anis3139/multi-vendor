@extends('layouts.app')
@section('title',"Cart")
@section('mainContent')

    <!-- Cart view section -->
    <section id="cart-view" style="margin:20px 0px 20px 0px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            @include('massege')



                            @if (empty($cart))
                                <div class="table-responsive">
                                    <div class="alert alert-info alert-block">
                                        <p>Please Add Some Product On Your Cart. <a href="{{route('all-product')}}"> Go Shop Page</a></p>
                                    </div>
                                @else
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Action</th>
                                                <th>Image</th>
                                                <th>Product</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
                                                <th>Color</th>
                                                <th>Meserment</th>
                                                <th>Total Price</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $key => $cartItem)

                                            <tr>
                                                <td style="width: 50px">
                                                    <form action="{{ route('client.cartRemove') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="{{ $key }}" name="product_id">
                                                        <button type="submit" class="btn btn-warning">
                                                            Remove
                                                        </button>
                                                    </form>
                                                </td>

                                                <td><img src="{{ $cartItem['image'] }}"  style="width: 50px ;height:50px;" alt=""></td>


                                                <td><a class="aa-cart-title" href="#">{{ $cartItem['title'] }}</a></td>

                                                <td>tk &nbsp;{{ number_format($cartItem['unit_price']) }} </td>

                                                <td>{{ $cartItem['quantity'] }}</td>
                                                <td style="display:flex; justify-content:center; align-items: center; height:20vh;">
                                                    @if( $cartItem['maserment'])

                                                    <div style=" width:20px; height:20px; border:1px solid #000; border-radius:50%; background-color: {{ $cartItem['color'] }};"></div>
                                                    @else
                                                    {{"N/A"}}
                                                @endif
                                                </td>
                                                <td>@if( $cartItem['maserment'])
                                                    {{ $cartItem['maserment'] }}
                                                    @else
                                                    {{"N/A"}}
                                                @endif</td>

                                                <td>tk &nbsp;{{ number_format($cartItem['total_price'], 2) }}
                                                </td>

                                            </tr>
                                            @endforeach



                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="font-weight: bold; text-align:center;">
                                                    <a href="{{ route('client.ClearCart') }}" class="btn btn-danger">Clear</a>
                                                </td>
                                                <td colspan="6" style="font-weight: bold; text-align:center;">
                                                    Total
                                                </td>
                                                <td style="font-weight: bold; text-align:center;">
                                                    ${{ number_format($total, 2) }}
                                                </td>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>


                                <div class="row">


                                    <!-- Cart Total view -->
                                    <div class="cart-view-total">
                                        <a class="btn btn-primary" href="{{route('client.checkout')}}" class="aa-cart-view-btn">Proced to Checkout</a>
                                    </div>


                                    <!-- Cart Clear -->



                                    @endif


                                    <!-- Cart Total -->
                                    <div class="cart-view-total text-right" style="margin-left:auto; display:block; width:auto;">
                                        <a href="{{route('all-product')}}" class="btn btn-success" >Continue Shoping</a>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection
