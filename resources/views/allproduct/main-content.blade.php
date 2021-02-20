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
                            </a></li>
                        <li class="sidebarCatecoryReating"><a class="text-decoration-none" href="#">
                                <span class="text-warning"><i class="fas fa-star"></i></span>
                                <span class="text-dark"><i class="fas fa-star"></i></span>
                                <span class="text-dark"><i class="fas fa-star"></i></span>
                                <span class="text-dark"><i class="fas fa-star"></i></span>
                                <span class="text-dark"><i class="fas fa-star"></i>
                                    <sanp class="text-decoration-none text-dark">&nbsp;& up
                                </span></span>
                            </a></li>

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
                        <div class="row">
                            @foreach ($CatWiseAllProducts as $CatWiseAllProduct)
                                <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 mt-4">
                                    <div class="item">
                                        <div class="pad15">
                                            <a href="{{ route('product-view', ['slug'=>$CatWiseAllProduct->product_slug]) }}" class="text-dark text-decoration-none">
                                                <div class="card">

                                                    @php $i= 1; @endphp
                                                    @foreach ($CatWiseAllProduct->img as $images)
                                                        @if ($i > 0)
                                                        <img class="card-img p-3" src="{{ $images->image_path }}"
                                                        alt="{{$CatWiseAllProduct->product_title}}">

                                                        @endif
                                                        @php $i--; @endphp
                                                    @endforeach






                                                    <div class="card-body py-1">
                                                        <h5 class="card-title">{{$CatWiseAllProduct->product_title}}</h5>
                                                        <p class="card-subtitle mb-2 text-muted">{{$CatWiseAllProduct->brand->name}}</p>
                                                        <div
                                                            class="buy d-flex justify-content-between align-items-center border-top">
                                                            <div class="price text-success">
                                                                <h5 class="mt-4">&#2547;&nbsp;{{$CatWiseAllProduct->product_price}}</h5>
                                                            </div> &emsp;
                                                            <a href="{{ route('product-view', ['slug'=>$CatWiseAllProduct->product_slug]) }}"
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
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="card-footer border-0">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link text-success" href="#">1 <span
                            class="sr-only">(current)</span> </a></li>
                <li class="page-item"><a class="page-link text-success" href="#">2</a></li>
                <li class="page-item"><a class="page-link text-success" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link text-success" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<script>



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
