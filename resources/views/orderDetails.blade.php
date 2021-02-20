@extends('layouts.app')
@section('css')

<style>
.profile{
    margin: 20px 0px!important;
}
.profile-link{
    position: fixed;
    top: 200px;
    right: 5px;
    background-color:#FF6666;
    color:#fff;
    padding: 10px;
    border-radius: 20px;
    display: inline-block;
    animation-name: profile-link;
    animation-duration: 2s;
    animation-iteration-count: infinite;
    }
    @keyframes profile-link {
  0%   {background-color: red;}
  50%  {background-color: #FF6666;}
  100% {background-color: rgb(228, 122, 23);}
}

</style>

@endsection

@section('mainContent')
    <div class="container">
        <div class="col-md-10 offset-md-1">
            <a class="profile-link" href="{{route('client.profile')}}">Go Your Profile</a>
            <h2 class=" profile  text-center">Order id: {{ $orders->id }}</h2>
            @include('massege')
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>


                        <th>Title</th>
                        <th>Details</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders->toArray() as $column => $value)
                    @if (is_string($value))


                    @if($column=='user_id') @continue
                    @elseif ($column=='id') @continue
                    @elseif ($column=='order_product_id') @continue
                    @elseif ($column=='product_owner_id') @continue
                    @endif
                        <tr>
                            <td>{{ucwords(str_replace('_',' ', $column))}}</td>
                            <td>{{$value}}</td>
                        </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-10 offset-md-1">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>

                        <th class="text-center">Product Title</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Color</th>
                        <th class="text-center">Maserment</th>
                        <th class="text-center">Total Price</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders->product as $product)

                        <tr>
                            <td class="text-center">{{$product->product->product_title}}</td>
                            <td class="text-center">{{$product->quantity}}</td>

                            <td style="display:flex; justify-content:center; align-items: center;">
                                @if($product->color)

                               <div style=" width:20px; height:20px; border:1px solid #000; border-radius:50%; background-color: {{$product->color}};"></div>
                                @else
                                {{"N/A"}}
                            @endif

                            </td>
                            <td class="text-center">@if($product->maserment)
                               {{$product->maserment}}
                                @else
                                {{"N/A"}}
                            @endif</td>
                            <td class="text-center">tk&nbsp;{{number_format($product->price, 2)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
