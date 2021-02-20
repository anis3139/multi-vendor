

<div class="mx-auto col-12 col-sm-12 col-md-11 col-lg-11 col-xl-11 p-1 p-sm-0 p-md-2 p-lg-2 p-xl-2 pt-1">
    <div class="card-header">
        <h3 class="text-uppercase text-danger">recommend</h3>
    </div>
    <div class="card-body p-1 p-sm-0 p-md-2 p-lg-2 p-xl-2 pt-1">
        <div class="col-12 col-sm-12 col-md-11 col-lg-11 col-xl-11 p-1 p-sm-0 p-md-2 p-lg-2 p-xl-2 pt-1 mx-auto">
            <div class="scrolling-pagination">
                <div class="row">
                    @foreach ($recomededs as $recomeded)

                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 p-1 p-sm-0 p-md-2 p-lg-2 p-xl-2 pt-1">
                        <a class="text-dark text-decoration-none" href="{{ route('product-view', ['slug'=>$recomeded->product_slug]) }}">
                            <div class="card p-0 rounded-0 border-0 flashSellProductCard">
                                <img src="{{$recomeded->img[0]->image_path}}" alt="{{$recomeded->product_title}}" class="img-fluid w-100 p-0 p-sm-1 p-md-4 p-lg-4 p-xl-4">
                                <div class="card-footer p-1 pb-3">
                                    <p class="productTitle">{{$recomeded->product_title}}</p>
                                    <p class="priceTitle">&#2547; <span>{{$recomeded->product_selling_price}}</span></p>
                                    <p> <span class="mainBalenceTitle">{{$recomeded->product_price}}</span></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    {{$recomededs->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
<script type="text/javascript">
    $('ul.pagination').hide();
    $(function() {
        $('.scrolling-pagination').jscroll({
            loadingHtml:'<div class="d-flex justify-content-center"><div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div></div>',
            autoTrigger: true,
            padding: 100,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.scrolling-pagination',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });
</script>
@endsection


