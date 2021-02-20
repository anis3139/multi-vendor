<div id="categories" class="mt-4">
    <div class="col-11 col-sm-11 col-md-11 col-lg-11 col-xl-11 p-0 mx-auto">

        <div class="card p-0 rounded-0">
            <div class="card-header border-0 rounded-0">
                <h4 class="text-danger text-uppercase">Categories</h4>
            </div>
            <div class="card-body p-0 rounded-0 border-0">
                <table class="table table-responsive-sm mb-0">
                    <tr>
                        @foreach ($categories as $categoriesitem)
                            @if ($loop->odd)
                            <td class="p-0 categories">
                                <a class="text-decoration-none text-dark" href="{{ route('category-wise-product-view', ['slug'=>$categoriesitem->slug]) }}">
                                    <div class="card categoryImages rounded-0">
                                        <div class="card-body">
                                            <img class="" style="height: 100px;width:100px; margin:0px auto; display:block;" src="{{$categoriesitem->icon}}"
                                            alt="">
                                        </div>
                                        <div class="card-footer border-0 pt-0">
                                            <p class="text-center categoryProductTitle">{{$categoriesitem->name}}</p>
                                        </div>
                                    </div>
                                </a>
                            </td>
                        @endif
                    @endforeach

                    </tr>

                    <tr>
                        @foreach ($categories as $categoriesitem)
                        @if ($loop->even)
                            <td class="p-0 categories">
                                <a class="text-decoration-none text-dark" href="{{ route('category-wise-product-view', ['slug'=>$categoriesitem->slug]) }}">
                                    <div class="card categoryImages rounded-0">
                                        <div class="card-body">
                                            <img class="" style="height: 100px;width:100px; margin:0px auto; display:block;" src="{{$categoriesitem->icon}}"
                                            alt="">
                                        </div>
                                        <div class="card-footer border-0 pt-0">
                                            <p class="text-center categoryProductTitle">{{$categoriesitem->name}}</p>
                                        </div>
                                    </div>
                                </a>
                            </td>
                        @endif
                    @endforeach

                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
