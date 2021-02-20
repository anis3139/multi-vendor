<!-- Flash Sell -->

<div id="flashSell">
    <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 mx-auto p-0 flashSellContainer">
        <div class="card rounded-0">
            <div class="card-header">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1 p-0 text-center ">
                            <p class="onSellNow">Flash Sell</p>
                        </div>
                        <div class="col-12 col-sm-12 col-md-1 col-lg-1 col-xl-1 p-0 text-center">
                            <p class="endIn">End in</p>
                        </div>
                        <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 p-0 mt-2">
                            <div id="the-final-countdown">
                                <p class="row"></p>
                            </div>
                        </div>
                        <a class="text-decoration-none ml-auto showButton"  href="{{ route('flash-product') }}">
                           Show All
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="flashSellProduct" class="m-2">
        <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 mx-auto p-0">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                <div class="row">
                    @foreach ($flshProducts as $flshProduct)

                    <div class="col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2 px-2">
                        <a class="text-dark text-decoration-none" href="{{ route('product-view', ['slug'=>$flshProduct->product_slug]) }}">
                            <div class="card p-0 rounded-0 border-0 flashSellProductCard">
                                <img src="{{$flshProduct->img[0]->image_path}}" alt="{{$flshProduct->product_title}}" class="img-fluid w-100">
                            <div class="card-footer p-1 pb-3">
                                <p class="productTitle">{{$flshProduct->product_title}}</p>
                                <p class="priceTitle">&#2547; <span>{{$flshProduct->product_selling_price}}</span></p>
                                <p> <span class="mainBalenceTitle">{{$flshProduct->product_price}}</span></p>
                            </div>
                        </div>
                    </a>
                </div>

                        @endforeach
                </div>
            </div>
        <!-- See More Button -->

        {{-- <div class="row">
            <div class="col-12 col-sm-12 col-md-4 col-lg-4-col-xl-4 mx-auto">
                <button class="seeMore">See More</button>
            </div>
        </div> --}}
    </div>
</div>
</div>
