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

    <div class="card border-0 mt-4">
        <div class="card-body p-0 pb-4">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                <div class="row">

                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 p-0">
                        <a class="text-decoration-none text-dark" id="sidebar-toggle-button">
                            <h5 class="px-4 pt-3"><span><i class="fas fa-bars"></i></span> All Category</h5>
                        </a>
                        <hr>
                        <ul id="sidebarUnorderList">

                            <li class="sidebarCatecory"><a href="#"><span></span> Watch</a></li>
                            <li class="sidebarCatecory"><a href="#"><span></span>Man's Watch</a></li>
                            <li class="sidebarCatecory"><a href="#"><span></span>Woman Watch</a></li>
                            <li class="sidebarCatecory"><a href="#"><span></span>Casual Watch</a></li>
                            <li class="sidebarCatecory"><a href="#"><span></span>Luxary Watch</a></li>
                            <li class="sidebarCatecory"><a href="#"><span></span>Couple & set Watch</a></li>
                            <li class="sidebarCatecory"><a href="#"><span></span>Sports Watch</a></li>

                        </ul>
                        <a class="text-decoration-none text-dark" id="sidebar-toggle-button-reating">
                            <h5 class="pl-3 pt-3"><span>Reating</h5>
                        </a>
                        <hr>
                        <ul id="sidebarUnorderListReating">
                            <li class="sidebarCatecoryReating"><a class="text-decoration-none" href="#">
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                </a></li>
                            <li class="sidebarCatecoryReating"><a class="text-decoration-none" class="text-decoration-none"
                                    href="#">
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-dark"><i class="fas fa-star"></i>
                                        <sanp class="text-decoration-none text-dark">&nbsp;& up
                                    </span></span>
                                </a></li>
                            <li class="sidebarCatecoryReating"><a class="text-decoration-none" href="#">
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-dark"><i class="fas fa-star"></i></span>
                                    <span class="text-dark"><i class="fas fa-star"></i>
                                        <sanp class="text-decoration-none text-dark">&nbsp;& up
                                    </span></span>
                                </a></li>
                            <li class="sidebarCatecoryReating"><a class="text-decoration-none" href="#">
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-warning"><i class="fas fa-star"></i></span>
                                    <span class="text-dark"><i class="fas fa-star"></i></span>
                                    <span class="text-dark"><i class="fas fa-star"></i></span>
                                    <span class="text-dark"><i class="fas fa-star"></i>
                                        <sanp class="text-decoration-none text-dark">&nbsp;& up
                                    </span></span>


                        </ul>

                        <a class="text-decoration-none text-dark" id="sidebar-toggle-button">
                            <h5 class="px-4 pt-3"><span>Price Range</h5>
                        </a>
                        <hr>
                        <ul id="" class="p-0">
                            <div class="form-group form-group-sm">
                                <input type="text" name="first_range" id="first_range" class="form-control ml-2"
                                    placeholder="Minimum Value">
                            </div>
                            <div class="form-group form-group-sm">
                                <input type="text" name="second_range" id="second_range" class="form-control ml-2"
                                    placeholder="Maximum Value">
                            </div>
                            <div class="form-group form-group-sm text-center">
                                <input type="submit" name="range_submit" id="range_submit"
                                    class="btn btn-success btn-sm btn-block ml-2" value="Apply">
                            </div>
                        </ul>

                        <hr>
                        <ul id="" class="p-0">
                            <div class="form-group form-group-sm text-center">
                                <input type="reset" name="reset" id="reset" class="btn btn-danger btn-sm btn-block ml-2"
                                    value="Reset">
                            </div>
                        </ul>
                    </div>

                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 p-0">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                            @if($searchProducts->count() == 0)
                            <div  style="margin:30px 0px 10px 0px; text-align:center;">
                                <h2 style=" background-color:rgb(222, 231, 226); padding:20px; color:#000; margin:0px 50px; ">You Search for: <span style="color:#f00">{{$key}}</span></h2>
                                <h2 style="margin-top: 20px; color:#000">No products found which match your selection</h2>
                                <h3 style="margin-top: 20px; color:#000">Retarn  <a style="color:#f00" href="{{route('all-product')}}">Shop Page</a></h3>
                            </div>
                            @else
                            <div  style="margin:30px 0px 10px 0px; text-align:center;">
                                <h2 style="background-color:rgb(222, 231, 226); padding:20px; color:#000; margin:0px 50px;">You Search for: <span style="color:#FF6666">{{$key}}</span></h2>

                            </div>
                            <div class="row">
                                @foreach ($searchProducts as $searchProduct)
                                    <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 mt-4">
                                        <div class="item">
                                            <div class="pad15">
                                                <a href="{{ route('product-view', ['slug'=>$searchProduct->product_slug]) }}" class="text-dark text-decoration-none">
                                                    <div class="card">

                                                        @php $i= 1; @endphp
                                                        @foreach ($searchProduct->img as $images)
                                                            @if ($i > 0)
                                                            <img class="card-img" src="{{ $images->image_path }}"
                                                            alt="{{$searchProduct->product_title}}">

                                                            @endif
                                                            @php $i--; @endphp
                                                        @endforeach






                                                        <div class="card-body">
                                                            <h5 class="card-title">{{$searchProduct->product_title}}</h5>
                                                            <p class="card-subtitle mb-2 text-muted">{{$searchProduct->brand->name}}</p>
                                                            <div
                                                                class="buy d-flex justify-content-between align-items-center border-top">
                                                                <div class="price text-success">
                                                                    <h5 class="mt-4">&#2547;&nbsp;{{$searchProduct->product_price}}</h5>
                                                                </div> &emsp;
                                                                <a href="{{ route('product-view', ['slug'=>$searchProduct->product_slug]) }}"
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
                    <div class="row">
                        <div class="custompagination"></div>
                        {{$searchProducts->links()}}
                    </div>
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
