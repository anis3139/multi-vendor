@php
$others=App\Models\OthersModel::first();
@endphp


<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">

            <div id="containerTriangle" class="row">
                <div id="triangle-left" class="col-6 col-sm-6 col-md-6 col-lg-6 colxl-6">

                    <div class="triangle-left"></div>
                    <div class="triangle-with-shadow-left"></div>
                </div>
                <div id="triangle-right" class="col-6 col-sm-6 col-md-6 col-lg-6 colxl-6">

                    <div class="triangle-right"></div>
                    <div class="triangle-with-shadow-right"></div>
                </div>
            </div>
            <!-- Slider -->
            <div id="slider">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <div class="col-12 col-sm-12 col-md-11 col-lg-11 col-xl-11 m-auto p-0 d-flex">

                        <div class="row d-flex">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 p-0">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">

                                        @foreach ($slider as $slideritem)
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="@if ($loop->first)
                                                active
                                            @endif"></li>
                                        @endforeach

                                    </ol>
                                    <div class="carousel-inner" role="listbox">

                                        @foreach ($slider as $slideritem)
                                            <div class="carousel-item @if ($loop->first)
                                                active
                                            @endif">
                                                <div class="img slider_mage"><a href="#">
                                                <img class="d-block" src="{{$slideritem->image}}" alt="First slide"></div>
                                                </a>
                                            </div>
                                        @endforeach


                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>

                            <div class=" col-md-4 col-lg-4 col-xl-4 p-0 d-none d-sm-block" id="sliderBanner">
                                <a class="sliderBanner" href="#">
                                    <img src="@if ($others)
                                    {{$others->promo_image_one}}
                                    @endif" alt="">
                                </a>
                                <a class="sliderBanner" href="#">
                                    <img src="@if ($others)
                                    {{$others->promo_image_two}}
                                    @endif" alt="">
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div id="Category">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <div class="col-12 col-sm-12 col-md-11 col-lg-11 col-xl-11 m-auto text-center p-0">
                        <table class="table table-borderless table-responsive-sm">
                            <tr>
                                <td>
                                    <a href="{{ route('omart') }}" class="text-decoration-none text-dark text-center">
                                        <img class="categoryIcon m-auto" src="{{asset('images/icons/cat(1).png')}}" alt="">
                                        <p class="categoryTitle">O Mart</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-decoration-none text-dark text-center">
                                        <img class="categoryIcon m-auto" src="{{asset('images/icons/cat(2).png')}}" alt="">
                                        <p class="categoryTitle">Buy In Bnagladesh</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-decoration-none text-dark text-center">
                                        <img class="categoryIcon m-auto" src="{{asset('images/icons/cat(3).png')}}" alt="">
                                        <p class="categoryTitle">Ovendar Exclucive</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-decoration-none text-dark text-center">
                                        <img class="categoryIcon m-auto" src="{{asset('images/icons/cat(4).png')}}" alt="">
                                        <p class="categoryTitle">Celebriting Event</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-decoration-none text-dark text-center">
                                        <img class="categoryIcon m-auto" src="{{asset('images/icons/cat(5).png')}}" alt="">
                                        <p class="categoryTitle">Muslim Club</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-decoration-none text-dark text-center">
                                        <img class="categoryIcon m-auto" src="{{asset('images/icons/cat(6).png')}}" alt="">
                                        <p class="categoryTitle">Cash Back</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-decoration-none text-dark text-center">
                                        <img class="categoryIcon m-auto" src="{{asset('images/icons/cat(7).png')}}" alt="">
                                        <p class="categoryTitle">Ovendar Free Shipping</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-decoration-none text-dark text-center">
                                        <img class="categoryIcon m-auto" src="{{asset('images/icons/cat(8).png')}}" alt="">
                                        <p class="categoryTitle">Brand Discount</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-decoration-none text-dark text-center">
                                        <img class="categoryIcon m-auto" src="{{asset('images/icons/cat(9).png')}}" alt="">
                                        <p class="categoryTitle">Desi Product</p>
                                    </a>
                                </td>
                                <td>
                                    <a href="#" class="text-decoration-none text-dark text-center">
                                        <img class="categoryIcon m-auto" src="{{asset('images/icons/cat(10).png')}}" alt="">
                                        <p class="categoryTitle">Ovendar Mall</p>
                                    </a>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
