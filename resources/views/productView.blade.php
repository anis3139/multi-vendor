@extends('layouts.app')
@section('title',"View Product")
@section('mainContent')

<div id="productContainer">

    <div id="productCard">
        <nav aria-label="breadcrumb ">
          <ol class="breadcrumb bg-pure-light border-bottom">
            <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="#">All Product</a> </li>
            <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="#">Watch</a></li>
            <li class="breadcrumb-item active" aria-current="page">Fation Watch</li>
          </ol>
        </nav>
      <div class="container">
          <div class="wrapper row">
              <div class="col-2 col-sm-2 col-md-1 col-lg-1 col-xl-1 p-0">
                  <ul class="preview-thumbnail">
                      <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{asset('images')}}/products/1.jpg" /></a></li>
                      <li><a data-target="#pic-2" data-toggle="tab"><img src="{{asset('images')}}/products/1.jpg" /></a></li>
                      <li><a data-target="#pic-3" data-toggle="tab"><img src="{{asset('images')}}/products/1.jpg" /></a></li>
                      <li><a data-target="#pic-4" data-toggle="tab"><img src="{{asset('images')}}/products/1.jpg" /></a></li>
                      <li><a data-target="#pic-5" data-toggle="tab"><img src="{{asset('images')}}/products/1.jpg" /></a></li>
                    </ul>
              </div>
              <div class="preview col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6 my-auto">

                  <div class="preview-pic tab-content">
                    <div class="tab-pane active" id="pic-1"><img src="{{asset('images')}}/products/1.jpg" /></div>
                    <div class="tab-pane" id="pic-2"><img src="{{asset('images')}}/products/1.jpg" /></div>
                    <div class="tab-pane" id="pic-3"><img src="{{asset('images')}}/products/1.jpg" /></div>
                    <div class="tab-pane" id="pic-4"><img src="{{asset('images')}}/products/1.jpg" /></div>
                    <div class="tab-pane" id="pic-5"><img src="{{asset('images')}}/products/1.jpg" /></div>
                  </div>
              </div>

              <div class="details col-md-4">
                  <h3 class="product-title text-uppercase mt-2">men's shoes fashion</h3>
                  <div class="rating">
                      <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                  </div>
                  <h4 class="price">current price: <span>&#2547;180</span></h4>
                  <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>

                  <div class="row">
                      <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 pl-0">
                          <label for="colorselect">Select Color</label>
                          <select name="colorselect" id="colorselect" class="custom-select">
                              <option value="0">Select Color</option>
                              <option value="1">Red</option>
                              <option value="1">Green</option>
                              <option value="1">Blue</option>
                          </select>
                      </div>
                      <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                          <label for="quantity">Quantity</label>
                          <input type="text" name="quantity" class="form-control">
                      </div>
                  </div>

                  <div class="action mt-3">
                      <button class="add-to-cart btn btn-danger" type="button">Add to cart</button>
                      <button class="like btn btn-danger" type="button"><span class="fa fa-heart"></span></button>
                  </div>
            </div>
        </div>

        <div class="container">

          <section id="tabs" class="project-tab mt-4">
            <div class="mt-4">
                <h4>Discription</h4>
                <hr>
                This accent chair allows you to enjoy all that your room has to offer, whether it is your living room, office, home office, or study. Made from sturdy wood, the soft, beautiful fabric will not only add a breath of freshness to whatever room you decide to place this chair in, but also allows you sit back and relax.
                Feature:
                <ul class="descriptionUi">

                    <li>  Ideal for small spaces, this chair work great in offices, bedrooms or living rooms</li>
                    <li>  Perfect alone or in a pair, this chair will last for years as it retains its beauty and elegance</li>
                    <li>  Use it for entertaining or relaxing while offering an intelligent design touch to your home</li>
                    <li>  Create a classic focal point in your home with this chic and cozy club chair</li>
                    <li>  Cushioned seat made from fabric and foam ensures you can rest comfortably for long hours</li>
                    <li>  Luxurious fabric upholstery and durable wooden frame, this armchair will be enjoyed for years to come</li>
                    <li>  Wood legs finished in a brown hue for a minimalist look</li>
                    <li>  Simple and minimal assembly is required</li>

                </ul>

            </div>

            <h4>
                Product Description
            </h4>
                <table class="table table-borderless table-sm-responsive table-sm mt-4">
                    <tr>
                        <th>Product ID</th>
                        <td class="bg-light">148828223</td>
                    </tr>
                    <tr>
                        <th>Manufactured By</th>
                        <td class="bg-light">Belleze</td>
                    </tr>
                    <tr>
                        <th>Sold By</th>
                        <td class="bg-light">OneBigOutlet</td>
                    </tr>
                    <tr>
                        <th>Size/Weight</th>
                        <td class="bg-light">W 27.55" / D 29.13" / H 31.49" / 33 lb.</td>
                    </tr>
                    <tr>
                        <th>Color</th>
                        <td class="bg-light">Light Gray</td>
                    </tr>
                    <tr>
                        <th>Materials</th>
                        <td class="bg-light"> Linen</td>
                    </tr>
                    <tr>
                        <th>Assembly Required</th>
                        <td class="bg-light">Yes</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td class="bg-light">Armchairs And Accent Chairs</td>
                    </tr>
                    <tr>
                        <th>Style</th>
                        <td class="bg-light">Midcentury</td>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
        </section>
    </div>
  </div>
</div>

<hr class="border border-dark">
<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
  <div class="row">
      <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-sm-left text-md-left text-lg-left p-0"><h4 class="text-center">Related Product</h4></div>
      </div>
    </div>
</div>
</div>
@endsection

@section('js')
@endsection
