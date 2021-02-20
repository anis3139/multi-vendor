<div id="populer">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
        <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 p-0 mx-auto">

            <div class="card border-0">
                <div class="populercardheader card-header p-0 text-center">
                    <img src="{{ asset('/images/xcv.png') }}" class="img-fluid populerheaderbanner" alt="">
                </div>
                <div class="card-body populercardbody">

                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-0">
                            <div class="row">

                                @foreach ($featureProducts as $featureProduct)
                                    @if ($loop->odd)
                                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 px-1">
                                            <a class="popularProduct" href="{{ route('product-view', ['slug'=>$featureProduct->product_slug]) }}">
                                                <div class="card border-0">
                                                    <img src="{{$featureProduct->img[0]->image_path}}" alt="Card image cap">
                                                    <div class="card-body border-0 rounded-0 text-center  p-0">
                                                        <h5 class="card-title text-danger"><span>&#2547;</span>{{$featureProduct->product_selling_price}}</h5>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-0">
                            <div class="row">
                                @foreach ($featureProducts as $featureProduct)
                                @if ($loop->even)
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 px-1">
                                        <a class="popularProduct" href="{{ route('product-view', ['slug'=>$featureProduct->product_slug]) }}">
                                            <div class="card border-0">
                                                <img src="{{$featureProduct->img[0]->image_path}}" alt="Card image cap">
                                                <div class="card-body border-0 rounded-0 text-center  p-0">
                                                    <h5 class="card-title text-danger"><span>&#2547;</span>{{$featureProduct->product_selling_price}}</h5>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer populercardbody text-center">
                    <a href="{{ route('all-product') }}" class="btn btn-danger">Show All</a>
                </div>
            </div>
        </div>
    </div>
</div>
