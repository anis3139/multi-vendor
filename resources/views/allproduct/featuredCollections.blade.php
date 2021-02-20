  <!-- Featured Collections -->

  <div id="featuredCollections" class="mt-4">
    <h3>Featured Collections</h3>
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
        <div class="card">
            <div class="card-body">
                <table class="table table-borderless table-responsive-sm featuredSellersTable">
                    <tr>
                        @foreach ($featureProducts as $featureProduct)
                        <td class="text-center text-capitalize mx-auto">

                            @php $i= 1; @endphp
                            @foreach ($featureProduct->img as $images)
                                @if ($i > 0)
                                <img style="width: 10rem; height:10rem;" src="{{ $images->image_path }}" alt="">
                                @endif
                                @php $i--; @endphp
                            @endforeach


                            <h5 class="featuredSellersTitle">{{ $featureProduct->product_title }}</h5>
                            <p class="featuredSellersPrice"><span>From</span> ৳ <span>{{ $featureProduct->product_price }}</span></p>
                        </td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
