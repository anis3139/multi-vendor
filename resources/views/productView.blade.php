@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<style>

    /* Product Color */
    .product-color {
      margin-bottom: 20px;
    }

    .color-choose div {
      display: inline-block;
      margin-top: 10px;
    }

    .color-choose input[type="radio"] {
      display: none;
    }

    .color-choose input[type="radio"] + label span {
      display: inline-block;
      width: 40px;
      height: 40px;
      margin: -1px 4px 0 0;
      vertical-align: middle;
      cursor: pointer;
      border-radius: 50%;
    }

    .color-choose input[type="radio"] + label span {
      border: 2px solid #FFFFFF;
      box-shadow: 0 1px 3px 0 rgba(0,0,0,0.33);
    }



    .color-choose input[type="radio"]:checked + label span {
      background-image: url(http://127.0.0.1:8000/check-icn.svg);
      background-repeat: no-repeat;
      background-position: center;
    }





    /* Product Size */
    .product-color {
      margin-bottom: 20px;
    }

    .meserment-choose div {
      display: inline-block;
      margin-top: 10px;
    }

    .meserment-choose input[type="radio"] {
      display: none;
    }

    .meserment-choose input[type="radio"] + label span {
      display: inline-block;
      width: 30px;
      height: 30px;
      margin: -1px 4px 0 0;
      vertical-align: middle;
      cursor: pointer;
      border-radius: 50%;
    }

    .meserment-choose input[type="radio"] + label span {
      border: 2px solid #FFFFFF;
      box-shadow: 0 1px 3px 0 rgba(0,0,0,0.33);
    }



    .meserment-choose input[type="radio"]:checked + label span {
      background-image: url(http://127.0.0.1:8000/check-icn.svg);
     background-size: 15px;
      background-repeat: no-repeat;
      background-position: center;
    }


    nav > .nav.nav-tabs{

  border: none;
    color:#fff;
    background:#272e38;
    border-radius:0;

}
    nav > div a.nav-item.nav-link,
    nav > div a.nav-item.nav-link.active
    {
    border: none;
        padding: 18px 25px;
        color:#fff;
        background:#272e38;
        border-radius:0;
    }

    /* nav > div a.nav-item.nav-link.active:after
    {
    content: "";
    position: relative;
    bottom: -60px;
    left: -10%;
    border: 15px solid transparent;
    border-top-color: #ff1900 ;
    } */
    .tab-content{
    background: #fdfdfd;
        line-height: 25px;
        border: 1px solid #ddd;
        border-top:5px solid #ff1900;
        border-bottom:5px solid #ff1900;
        padding:30px 25px;
    }

    nav > div a.nav-item.nav-link:hover,
    nav > div a.nav-item.nav-link:focus
    {
    border: none;
        background: #ec1800;
        color:#fff;
        border-radius:0;
        transition:background 0.20s linear;
    }

/* chat */
.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 40px;
    padding-bottom: 5px;
    /* border-bottom: 1px dotted #B3A9A9; */
    margin-top: 10px;
    width: 80%;
}


.chat li .chat-body p
{
    margin: 0;
    color: #ffffff;
}


.chat-care
{
    overflow-y: scroll;
    height: 350px;
}
.chat-care .chat-img
{
    width: 50px;
    height: 50px;
}
.chat-care .img-circle
{
    border-radius: 50%;
}
.chat-care .chat-img
{
    display: inline-block;
}
.chat-care .chat-body
{
    display: inline-block;
    max-width: 80%;
    background-color: #ff0000;
    border-radius: 12.5px;
    padding: 15px;
}
.chat-care .chat-body strong
{
  color: #ffffff;
}

.chat-care .admin
{
    text-align: right ;
    float: right;
}
.chat-care .admin p
{
    text-align: left ;
}
.chat-care .agent
{
    text-align: left ;
    float: left;
}
.chat-care .left
{
    float: left;
}
.chat-care .right
{
    float: right;
}

.clearfix {
  clear: both;
}




::-webkit-scrollbar-track
{
    box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}




    </style>

@endsection
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

                    @foreach ($productDetails->img as $keyThumb=>$imageThumb)
                    <li class="
                        @if ($loop->first)
                            active
                        @endif
                    "><a data-target="#pic-{{$keyThumb}}" data-toggle="tab"><img src="{{$imageThumb->image_path}}" /></a></li>
                    @endforeach



                    </ul>
              </div>
              <div class="preview col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6">

                  <div class="preview-pic tab-content">
                    @foreach ($productDetails->img as $key=>$image)
                    <div class="tab-pane
                    @if ($loop->first)
                        active
                    @endif" id="pic-{{$key}}"><img src="{{$image->image_path}}" /></div>
                    @endforeach

                  </div>
              </div>

              <div class="details col-md-4">
                <form action="{{ route('client.addCart') }}" id="cartForm" method="post">
                  <h3 class="product-title text-uppercase mt-2">{{$productDetails->product_title}}</h3>
                  <h4 class="price">current price: <span>&#2547;{{$productDetails->product_price}}</span></h4>

                  <div class="row">
                      <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 pl-0">

                          @if(count($productDetails->color)>0)
                          <!-- Product Color -->
                          <div class="product-color">
                              <span >Color</span>

                              <div class="color-choose mt-1">
                                  @foreach ($productDetails->color as $color)
                                  <div>
                                      <input type="radio" id="{{$color->product_color_code}}" name="color" @if($loop->first){{"checked"}} @endif value="{{$color->product_color_code}}" >
                                      <label for="{{$color->product_color_code}}"><span  style="background-color:{{$color->product_color_code}} "></span></label>
                                  </div>
                                  @endforeach


                          </div>
                      @endif
                      @if(count($productDetails->maserment) > 0)
                      <div class="product-color">
                          <span >Mezerment</span>

                          <div class="meserment-choose mt-1">
                              @foreach ($productDetails->maserment as $maserment)
                              <div>
                                  <input type="radio" id="{{$maserment->meserment_value}}" name="maserment" @if($loop->first){{"checked"}} @endif value="{{$maserment->meserment_value}}" >
                                  <label for="{{$maserment->meserment_value}}"><span style="background-color:#000;"></span></label>
                                  <span >{{$maserment->meserment_value}}</span>&ensp;
                              </div>
                              @endforeach
                      </div>
                      @endif

                      </div>


                        <span><label for="quantity">Quantity</label></span>
                          <input type="number" value="1" min="1"  max="100" name="quantity" class="form-control" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))">

                  </div>

                  <div class="action mt-3">

                        @csrf
                        <input type="hidden" id="product_id" name="product_id" value="{{ $productDetails->id }}">
                        <button type="submit" class="add-to-cart btn btn-danger" class="background-color:red !importent;" type="button">Add to cart</button>
            </form>

                  </div>
            </div>
        </div>
    </div>
</div>




































<hr class="border border-dark">
          <section id="tabs" class="project-tab mt-4">
            <div class="row">
                <div class="col-lg-12 p-0">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Discription</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Product Description</a>
                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Product Review</a>
                      <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Ask Queestion</a>
                    </div>
                  </nav>
                  <div class="tab-content py-3 px-3 px-sm-0 p-md-3 p-lg-3 pxl-3" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <p class="descriptionUi">
                            {!! nl2br(e( $productDetails->product_discription)) !!}
                        </p>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table class="table table-borderless table-sm-responsive table-sm mt-4">
                        <tr>
                            <th>Product ID</th>
                            <td class="bg-light">{{$productDetails->id}}</td>
                        </tr>
                        <tr>
                            <th>Manufactured By</th>

                            <td class="bg-light">{{$productDetails->brand->name}}</td>
                        </tr>
                        <tr>
                            <th>Sold By</th>
                            @if($productDetails->product_owner_id!==0)
                            <td class="bg-light">{{$productDetails->vendor->name}}</td>
                            @else
                            <td class="bg-light">Ovendar</td>
                            @endif
                        </tr>
                        <tr>
                            <th>Size/Weight</th>
                            <td class="bg-light">
                                @foreach ($productDetails->maserment as $maserments)
                                {{$maserments->meserment_value}},
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Color</th>
                            <td class="bg-light">


                                @foreach ($productDetails->color as $color)
                                <div style="height: 20px; width:20px; border-radius:50%; background-color: {{ $color->product_color_code}}; display:inline-block; margin:0px 5px;" ></div>
                        @endforeach
                            </td>
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
                            <td class="bg-light">

                                {{ $productDetails->cat->name}}

                            </td>
                        </tr>
                        <tr>
                            <th>Style</th>
                            <td class="bg-light">

                                {{ $productDetails->brand->name}}

                            </td>
                        </tr>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-0 px-md-4 px-lg-4 px-xl-4">
                                    <h4>Previous rate and review</h4>
                                    <div class="card m-0 p-0" style="background: none; ">
                                        <table class="table table-striped ">
                                            <tbody id="reviewResult" style="display:block;height:300px;overflow:auto;">

                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 p-0 px-md-4 px-lg-4 px-xl-4">

                                    @auth
                                    <form action="#" id="reating">
                                        <div class="form-group">
                                            <label for="reating">Rate</label>
                                            <div id="rateYo"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="review">Review</label>
                                            <textarea spellcheck="true" required title="This field can't be blank!" name="review" id="review" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                                                <div class="row">

                                                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 col-xl-10 p-0" id="messegeview">

                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 text-right p-0">
                                                        <input type="submit" class="btn btn-success" value="Rate">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    @endauth
                                    @guest
                                    <a href="{{ route('client.login') }}" class="text-center text-decoration-none">Please Login For Reating And Review</a>
                                    @endguest

                                </div>
                            </div>

                        </div>


                    </div>
                    <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                        @auth

                        {{-- Cheat window --}}
            <div class="card m-0 p-0">
                <div class="card-body chat-care">
                    <ul class="chat">
                    </ul>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm messege" placeholder="Type your message here..." />
                        &nbsp;
                        <span class="input-group-btn"><button type="submit" class="btn btn-primary" id="btn-chat">Send</button></span>
                                </div>
                            </div>
                        </div>
                        @endauth
                        @guest
                        <a href="{{ route('client.login') }}" class="text-center text-decoration-none">Please Login For Reating And Review</a>
                        @endguest

                    </div>
                  </div>

                </div>
              </div>


            <h4>

            </h4>

                </div>
            </div>
        </div>
    </div>
        </section>
    </div>
  </div>
</div>

<hr class="border border-dark">
<div class="container">

<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-4">
  <div class="row">
     @foreach ($relatedProducts as $relatedProduct)

        <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 mt-4">
            <div class="item">
                <div class="pad15">
                    <a href="" class="text-dark text-decoration-none">
                        <div class="card">

                            @php $i= 1; @endphp
                            @foreach ($relatedProduct->img as $images)
                                @if ($i > 0)
                                <img class="card-img p-4" src="{{ $images->image_path }}"
                                alt="{{$relatedProduct->product_title}}">

                                @endif
                                @php $i--; @endphp
                            @endforeach
                            <div class="card-body px-4 py-0">
                                <h5 class="card-title">{{$relatedProduct->product_title}}</h5>
                                <p class="card-subtitle mb-2 text-light">{{$relatedProduct->brand->name}}</p>
                                <div
                                    class="buy d-flex justify-content-between align-items-center border-top">
                                    <div class="price text-success">
                                        <h5 class="mt-4">&#2547;&nbsp;{{$relatedProduct->product_price}}</h5>
                                    </div> &emsp;
                                    <a href="{{ route('product-view', ['slug'=>$relatedProduct->product_slug]) }}"
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
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        $(function () {

  $("#rateYo").rateYo({
    starWidth: "30px"
  });

});




$('#reating').submit(function(e){
    e.preventDefault();
    var $rateYo = $("#rateYo").rateYo();
    var rating = $rateYo.rateYo("rating");
    var review= $('#review').val();
    var product_id=$('#product_id').val();


    axios.post("{{ route('clint.reatingReview' )}}",{
                    rating:rating,
                    review:review,
                    product_id:product_id
                }).then(function(response) {


                    if (response.data) {

                        var html="";

                        html+='<div class="alert alert-success" role="alert"><p class="text-capitalize">Thanks for your rate and review.We will approved it soon</p></div>';

                        $('#messegeview').html(html,
                            setTimeout(function(){
                                $('#messegeview').html("");
                            },5000)
                        );

                        $('#reating')[0].reset();
                        getReviewData();

                    } else {
                        html+='<div class="alert alert-danger" role="alert">Incomplete Review</div>';

                        $('#messegeview').html(html,
                            setTimeout(function(){
                                $('#messegeview').html("");
                            },5000)
                        );

                    }
                }).catch(function(error){
                    console.log(error);
                })


});


$(document).ready(function(){
getReviewData();
});




function getReviewData() {
     var product_id=$('#product_id').val();
            axios.post("{{route('getproductreating')}}",{
                product_id:product_id
            }).then(function(respones){


                var jsonData=respones.data.review;


                var html="";
                for (let rv = 0; rv < jsonData.length; rv++) {
                    const element = jsonData[rv];




                    html+='<tr>';
                    html+='<td><img src="'+element.image+'" alt="" style="border-radius: 50%; height:60px; width:60px;" ></td>';
                    html+='<td>';
                    html+='<p style="font-size:12px;" class="m-0">'+element.name+'</p><div id="rateYo'+rv+'" class="p-0"></div>';
                    html+='<p style="font-size:12px;">'+element.product_review.substring(0,100)+'</p>';
                    html+='</td>';
                    html+='</tr>';




                }

                $('#reviewResult').html(html);


                for (let rate = 0; rate < jsonData.length; rate++) {
                    const element2 = jsonData[rate];

                    $("#rateYo"+rate).rateYo({
                        rating: element2.star_reating,
                        readOnly: true,
                        starWidth: "15px"
                    });

                }





            }).catch(function(error){
                console.log(error);
            });
}



$('#btn-chat').click(function(){
    var product_id=$('#product_id').val();
    var messege=$('.messege').val();
    console.log(messege);

    axios.post("{{route('askaboutproduct.store')}}",{
        product_id:product_id,
        messege:messege,
    }).then(function(response){
        console.log(response.data);

        if (response.data) {
            var messege=$('.messege').val("");
            getmessegedata();

            $('.chat-care').scrollTop(350);

        }else{
            return;
        }


    }).catch(function(error){
        console.log(error);
    });

});


$(document).ready(function(){
    getmessegedata();
});

function getmessegedata(){
    var product_id=$('#product_id').val();
        axios.post("{{route('askaboutproduct.getallmessege')}}",{
            product_id:product_id
        }).then(function(response){
            console.log(response.data);
            var messegedetails=response.data.messegedata;
            var userID=response.data.userid;
            var ownerID=response.data.ownerId;




                var html2="";
            for (let m = 0; m < messegedetails.length; m++) {
                const element3 = messegedetails[m];




                if (element3.sender_id == userID) {
                    html2+='<li class="agent clearfix">';
                    html2+='<span class="chat-img left clearfix mx-2">';
                    html2+='<img src="'+element3.userImage+'" alt="Agent" class="img-circle" />';
                    html2+='</span>';
                    html2+='<div class="chat-body clearfix">';
                    html2+='<div class="header clearfix">';
                    html2+='<strong class="primary-font">'+element3.username+'</strong> <small class="right text-light">';
                    html2+='<span class="glyphicon glyphicon-time"></span>&emsp;14 mins ago</small>';
                    html2+='</div>';
                    html2+='<p>';
                    html2+=''+element3.messege+'';
                    html2+='</p>';
                    html2+='</div>';
                    html2+='</li>';

                }else if(element3.sender_id == ownerID && element3.reciver_id == userID){

                    html2+='<li class="admin clearfix">';
                    html2+='<span class="chat-img right clearfix  mx-2">';
                    html2+='<img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="Admin" class="img-circle" />';
                    html2+='</span>';
                    html2+='<div class="chat-body clearfix">';
                    html2+='<div class="header clearfix">';
                    html2+='<small class="left text-light"><span class="glyphicon glyphicon-time"></span>15 mins ago &emsp;</small>';
                    html2+='<strong class="right primary-font">'+element3.vendorName+'</strong>';
                    html2+='</div>';
                    html2+='<p>';
                    html2+=''+element3.messege+'';
                    html2+='</p>';
                    html2+='</div>';
                    html2+='</li>';
                }

            }


            $('.chat').html(html2);







        }).catch(function(error){
            console.log(error);
        });
}

    </script>
@endsection
