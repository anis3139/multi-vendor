
<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0 mx-auto">
<div class="card">
    <div class="card-header border-1 text-center"><h4>Our Brand Product</h4></div>
    <div class="card-body p-2">
        <section class="customer-logos slider">
            @foreach ($brands as $brand)
            <div class="slide"><img src="{{$brand->image}}" alt=""></div>
            @endforeach
        </section>
    </div>
</div>

</div>




