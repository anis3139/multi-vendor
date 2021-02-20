@extends('layouts.app')

@section('title',"All Product")

@section('css')
<style>
.custompagination{
        width: 40vw;
    }
</style>

@endsection


@section('mainContent')


<div class="col-12 col-sm-12 col-md-11 col-lg-11 col-xl-11 mt-4 mx-auto allproduct">
    <form action="{{ route('client.search2') }}" method="POST">
        @csrf
        <div class="row">

            <div class="col-1 col-sm-12 col-md-3 col-lg-3 col-xl-2">
                <input type="text" name="name" id="" class="form-control" placeholder="Product Name">
            </div>
            <div class="col-1 col-sm-12 col-md-3 col-lg-3 col-xl-2">
                <select class="custom-select" name="category" id="">
                    <option value="" selected disabled>Select Category</option>
                    @foreach ($Categorys as $Category)
                    <option value="{{$Category['id']}}">{{$Category['name']}}</option>

                    @endforeach

                </select>
            </div>
            <div class="col-1 col-sm-12 col-md-3 col-lg-3 col-xl-2">
                <select class="custom-select" name="brand" id="">
                    <option value="" selected disabled>Select Brands</option>
                    @foreach ($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>

                    @endforeach


                </select>
            </div>
            <div class="col-1 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <input type="number" name="pricerange1" class="form-control" id="" placeholder="Price Range Start">
            </div>
            <div class="col-1 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <input type="number" name="pricerange2" class="form-control" id="" placeholder="Price Range End">

            </div>
            <div class="col-1 col-sm-12 col-md-2 col-lg-2 col-xl-2">
                <input type="submit" name="" id="" class="btn btn-success btn-block" value="search">
            </div>
        </div>
    </form>

    <div class="card border-0 mt-4">
        <div class="card-body p-0 pb-4">

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                            @if(count($searchProducts) == 0)
                            <div  style="margin:30px 0px 10px 0px; text-align:center;">
                                <h2 style=" background-color:rgb(222, 231, 226); padding:20px; color:#000; margin:0px 20px; ">You Search for: <span style="color:#f00">{{$key}}</span></h2>
                                <h2 style="margin-top: 20px; color:#000">No products found which match your selection</h2>
                                <h3 style="margin-top: 20px; color:#000">Retarn  <a style="color:#f00" href="{{route('all-product')}}">Shop Page</a></h3>
                            </div>
                            @else
                            <div  style="margin:30px 0px 10px 0px; text-align:center;">
                                <h2 style="background-color:rgb(222, 231, 226); padding:20px; color:#000; margin:0px 20px;">You Search for: <span style="color:#FF6666">{{$key}}</span></h2>

                            </div>
                            <div class="row">


                                @foreach ($searchProducts as $searchProduct)

                                    <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 mt-4">
                                        <div class="item">
                                            <div class="pad15">
                                                <a href="{{ route('product-view', ['slug'=>$searchProduct['product_slug']]) }}" class="text-dark text-decoration-none">
                                                    <div class="card">

                                                            <img class="card-img" src="{{ $searchProduct['img'] }}"
                                                            alt="{{$searchProduct['product_title']}}">







                                                        <div class="card-body">
                                                            <h5 class="card-title">{{$searchProduct['product_title']}}</h5>
                                                            <p class="card-subtitle mb-2 text-muted">{{$searchProduct['brandName']}}</p>
                                                            <div
                                                                class="buy d-flex justify-content-between align-items-center border-top">
                                                                <div class="price text-success">
                                                                    <h5 class="mt-4">&#2547;&nbsp;{{$searchProduct['product_price']}}</h5>
                                                                </div> &emsp;
                                                                <a href="{{ route('product-view', ['slug'=>$searchProduct['product_slug']]) }}"
                                                                    class="btn btn-outline-success btn-sm">View</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endif

                        </div>
                </div>
            </div>
        </div>


    <script>
        $(document).ready(function() {
            $('.customer-logos').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                centerPadding: '1px',
                dots: false,
                pauseOnHover: false,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 3
                    }
                }]
            });
        });



        // Get the container element
        var btnContainer = document.getElementById("sidebarUnorderList");

        // Get all buttons with class="btn" inside the container
        var btns = btnContainer.getElementsByClassName("sidebarCatecory");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }




        $('#sidebar-toggle-button').click(function() {
            $('#sidebarUnorderList').toggle(700);
        })

    </script>
</div>




@endsection

@section('js')
    <script src="{{ asset('js') }}/slick.js"></script>
@endsection
