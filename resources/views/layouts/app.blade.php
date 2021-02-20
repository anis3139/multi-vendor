<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->


    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquerysctipttop.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">


    @yield('css')

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>


.notification img {
  padding: 10px 0;
}

.notification-menu {
    position: absolute;
    top: 50px;
    right: 0px;
    background-color: #e5e5e5;
    border: #989898;
    padding: 5px;
    list-style: none;
    display: none;
    text-align: left;
    z-index: 3;
    width: 376px;
    border-radius: 2px;
    height: 400px;
    overflow-y:scroll ;
}

.notification-menu li {
  background-color: #fff;
  padding: 3px;
  margin-bottom: 10px;
}

.notification-menu li:hover {
  background-color: rgb(189, 189, 189);
  cursor: pointer;

}


.notification-menu h3 {
  font-size: 15px;
  margin: 0 0 5px 0;
  font-weight: bold;
  display: inline;
}

.notification-menu p {
  margin-bottom: 0;
  font-size: 14px;
  color: black !important;
}

    </style>


    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images') }}/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images') }}/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images') }}/favicons/favicon-16x16.png">
    <link rel="manifest" href="{{asset('images') }}/favicons/site.webmanifest">
    <link rel="mask-icon" href="{{asset('images') }}/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>



</head>
<body>
    <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v9.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/bn_IN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution="setup_tool"
        page_id="118792296628029">
      </div>
    @php
    $others=App\Models\OthersModel::first();
    $socialData=App\Models\SocialModel::first();

    @endphp


    <header class="sticky-top">
        <div class="headerPill">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">

                <div class="container">
                    <div id="headerpill">
                        <div class="row">

                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 text-left">
                                <div class="row">
                                    <a class="text-decoration-none" href="{{ route('vendor.login') }}">Sell Center</a>
                                    <span class="mx-2">&#8739;</span>
                                    <a class="text-decoration-none" href="#">Download</a>
                                    <span class="mx-2">&#8739;</span>

                                    <p class="m-0">Follow Us</p>
                                    <a href="@if ($socialData)
                                    {{$socialData->facebook}}
                                    @endif"><i class="fab fa-facebook"></i></a>
                                    <a href="@if ($socialData)
                                    {{$socialData->twitter}}
                                    @endif"><i class="fab fa-twitter"></i></a>
                                    <a href="@if ($socialData)
                                    {{$socialData->instragram}}
                                    @endif"><i class="fab fa-instagram"></i></a>
                                    <a href="@if ($socialData)
                                    {{$socialData->youtube}}
                                    @endif"><i class="fab fa-youtube"></i></a>
                                    <a href="@if ($socialData)
                                    {{$socialData->linkin}}
                                    @endif"><i class="fab fa-linkedin-in"></i></a>


                                </div>
                            </div>

                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 p-0 text-right">
                                @auth

                                <div class="notification">
                                    <img class src="https://s3.amazonaws.com/codecademy-content/projects/2/feedster/bell.svg"><span style="position: relative; right: 10px; bottom: 10px;" class="badge badge-danger countNotify">0</span>
                                    <ul class="notification-menu">
                                        <li>
                                            <h3>William Roberts II</h3>
                                            <p>Clean as a whistle</p>
                                        </li>
                                        <li>
                                            <h3>Faheem Najm</h3>
                                            <p>All I do is win</p>
                                        </li>
                                    </ul>
                                    @endauth
                                    <a class="text-decoration-none" href="#"><span><i class="fas fa-question-circle text-light"></i></span>&nbsp;Help</a>
                                    @guest
                                    <a href="{{route('client.registration')}}" class="font-weight-bold text-decoration-none">&nbsp;Sing Up</a><span class="mx-2">&#8739;</span>
                                    <a class="font-weight-bold text-decoration-none" href="{{route('client.login')}}">Login</a>
                                </div>
                                @endguest
                                @auth
                                <a class="font-weight-bold text-decoration-none" href="{{ route('client.logout') }}">Log Out</a>
                                @endauth
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>


        <div id="navbar_with_search" class="p-md-3 p-lg-3 p-xl-3">
            <nav class="navbar navbar-expand-md navbar-light bg-faded">
                <div class="container">
                    <div id="navbarBrandWithToggle">

                        <a href="/" class="navbar-brand">
                            <img src="@if ($others)
                            {{$others->logo}}
                            @endif" alt="logo" class="header_logo">
                        </a>
                    </div>

                    <div id="searchbar">
                        <form class=" my-1 d-inline" method="post" action="{{route('client.search')}}">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control  border-right-0 searchInput"
                                    placeholder="Search on Ovender" class="searchInput"  name="key">
                                <span class="input-group-append">
                                    <button class="btn searchBtn" type="submit">
                                        <i class="fa fa-search text-light"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="shop_icon">
                        <a href="{{ route('client.showCart') }}">
                            <img src="{{ asset('images') }}/icons/shopping_cart.svg" alt="" srcset="">
                        </a>
                    </div>
                    @auth

                    <div class="acoount_icon d-block" >
                        <a href="{{ route('client.profile') }}">
                            <img src="{{ asset('images') }}/icons/account.svg" alt="" srcset="">
                        </a>
                    </div>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <div id="container">
        @yield('mainContent')
    </div>
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

            </div>
          </div>
        </div>
      </div>



  <!-- Footer -->
    <footer>
        <div id="mainFooter">

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
            <div class="container customarCareLinks">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">
                        <ul>
                            <h5>Customer Care</h5>
                            <li><a href="#">Help Center</a></li>
                            <li><a href="#">How to Buy</a></li>
                            <li><a href="#">Track Your Order</a></li>
                            <li><a href="#">Returns & Refunds</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                        <br>
                        <ul>
                            <h5>Earn With Ovender</h5>
                            <li><a href="#">Ovender University</a></li>
                            <li><a href="#">Sell on Ovender</a></li>
                            <li><a href="#">Code of Conduct</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3">

                        <ul>
                            <h5>Ovender</h5>
                            <li><a href="#">About Ovender</a></li>
                            <li><a href="#">Digital Payments</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Ovender Blog</a></li>
                            <li><a href="#">Amar Ovender</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mt-2">

                        <h5>Payment Method</h5>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 px-1 card m-1">
                                    <img src="{{asset('images') }}/icons/Cod.svg" alt="" class="img-fluid m-auto">
                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 px-1 card m-1">
                                    <img src="{{asset('images') }}/icons/Visa_Inc._logo.svg" alt="" class="img-fluid m-auto supportedPaymentIcons">
                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 px-1 card m-1">
                                    <img src="{{asset('images') }}/icons/masterCard.svg" alt="" class="img-fluid m-auto supportedPaymentIcons">

                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 px-1 card m-1">
                                    <img src="{{asset('images') }}/icons/BKash-Logo.svg" alt="" class="img-fluid m-auto supportedPaymentIcons">
                                </div>
                                <div class="col-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 px-1 card m-1">
                                    <img src="{{asset('images') }}/icons/amirican express.svg" alt="" class="img-fluid m-auto supportedPaymentIcons">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 mt-2">
                            <h5>Follow Us</h5>
                            <ul class="socialIcons p-0">
                                <li><a target="_blank" href="@if ($socialData)
                                    {{$socialData->facebook}}
                                    @endif"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a target="_blank" href="@if ($socialData)
                                    {{$socialData->twitter}}
                                    @endif"><i class="fab fa-twitter"></i></a></li>
                                <li><a target="_blank" href="@if ($socialData)
                                    {{$socialData->instragram}}
                                    @endif"><i class="fab fa-instagram"></i></a></li>
                                <li><a target="_blank" href="@if ($socialData)
                                    {{$socialData->youtube}}
                                    @endif"><i class="fab fa-youtube"></i></a></li>
                                <li><a target="_blank" href="@if ($socialData)
                                    {{$socialData->linkin}}
                                    @endif"><i class="fab fa-linkedin"></i></a></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <div id="copyright" class="text-center">
        <p>Copyright&copy; Ovender 2020 Allright Receive</p>
    </div>

    </footer>

    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/axios.min.js') }}"></script>


    @yield('js')
    <script src="{{ asset('js/custom.js') }}"></script>

    <script>
        $(document).ready(function(){
        setInterval(function time(){
            var d = new Date();
            var hours = 24 - d.getHours();
            var min = 60 - d.getMinutes();
            if((min + '').length == 1){
              min = '0' + min;
            }
            var sec = 60 - d.getSeconds();
            if((sec + '').length == 1){
                  sec = '0' + sec;
            }
            jQuery('#the-final-countdown p').html('<div class="hours">'+hours+'</div><p clss="semiclone">:</p><div class="min">'+min+'</div><p clss="semiclone">:</p><div class="sec">'+sec+'</div>')
          }, 1000);

    });
    var main = function() {
  $('.notification img').click(function() {
    $('.notification-menu').toggle();
  });

  $('.post .btn').click(function() {
    $(this).toggleClass('btn-like');
  });
};
$(document).ready(main);

$(document).ready(function(){
    getallnotify();
});

function getallnotify() {
    axios.get("{{route('getAllNotification')}}").then(function(response) {
        console.log(response.data);


        var allNotify=response.data.allnotify;
        var unread=response.data.unreadNotify;
        $('.countNotify').html(unread.length)

        var html="";
        for (let notify = 0; notify < allNotify.length; notify++) {
            const element = allNotify[notify];


            var color="";
            if (element.is_seen== 0) {
                color="background-color:#ff000021";
            }
            html+='<li style="'+color+'" onclick="getnotifydesc('+element.id+');">';
            html+='<h3>'+element.title+'</h3>';
            html+='<p>'+element.discription.substr(0,80)+'.....</p>';
            html+='</li>';
        }

        $('.notification-menu').html(html);



    }).catch(function(error) {
        console.log(error);
    })
}


function getnotifydesc(id) {
    axios.post("{{route('getAllNotificationSingle')}}",{id:id})
    .then(function(response){
        console.log(response.data);
        getallnotify();

        var jsondata=response.data;
        $('.modal-title').html(jsondata.title);
        $('.modal-body').html(jsondata.discription);
        $('.modal').modal("show");



    }).catch(function(error){
        console.log(error);
    });
}


    </script>
    <script>
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
    </script>



</body>
</html>
