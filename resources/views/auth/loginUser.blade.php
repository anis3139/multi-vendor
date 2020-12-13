<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ovendar</title>
    <link rel="stylesheet" href="{{asset('css')}}/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css')}}/all.min.css">
    <link rel="stylesheet" href="{{asset('css')}}/normalize.css">
    <!-- Favoicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images')}}/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images')}}/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images')}}/favicons/favicon-16x16.png">
    <link rel="manifest" href="{{asset('images')}}/favicons/site.webmanifest">
    <link rel="mask-icon" href="{{asset('images')}}/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <style>
        body{
            /* background: url('{{asset('images')}}/background.png'); */
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
        .login-card{
            position: relative;
            top: 10%;
        }
        header{
            display: block;
            width: 100%;
            content: '';
        }

    </style>


</head>

<body>
    <!-- Header -->
    <header>

    </header>
    <input type="hidden" id="background_images" value="{{ asset('images/banner') }}">


    <div id="login" class="container">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="row p-0">

        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 ml-auto">
            <div class="login-card card">
                <div class="card-header border-0 ">
                    <h5>Log In</h5>
                </div>
                <div class="card-body pt-0">
                    <form action="#" method="POST">
                        <div class="form-group my-4">
                            <input type="text" class="form-control login" name="" id="">
                        </div>

                        <div class="form-group my-4">
                            <input type="password" class="form-control login" name="" id="">
                        </div>
                        <div class="form-group text-center my-4">
                            <input type="submit" class="btn btn-danger btn-disable btn-block p-2 font-weight-bold" value="Log In" name="" id="">
                        </div>
                    </form>
                        <div class="row px-3">
                            <a href="" class="text-decoration-none text-left">Forget Password</a>
                            <div class="mr-auto"></div>
                            <a href="{{ route('home') }}" class="text-decoration-none text-decoration-none">Back To Home</a>
                        </div>
                        <div class="row px-3">
                            <div class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 p-0"><hr class="border"></div>
                            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 p-0 text-center">OR</div>
                            <div class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 p-0"><hr class="border"></div>
                        </div>
                        <div class="row px-3">
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <button class="btn btn-primary btn-block"><i class="fab fa-facebook"></i>&nbsp;<span class="font-weight-bold">Facebook</span></button>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <button class="btn btn-success btn-block"><i class="fab fa-google"></i>&nbsp;<span class="font-weight-bold">Google</span></button>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <button class="btn btn-dark btn-block"><i class="fab fa-apple"></i>&nbsp;<span class="font-weight-bold">Apple</span></button>
                            </div>
                        </div>
                        <div class="row my-4 text-center">
                            <div class="text-center mx-auto">
                                <span class="text-secondary">New To Ovendar</span>&nbsp;<a class="text-danger text-decoration-none font-weight-bolder" href="{{ route('register') }}">Sing Up</a>
                            </div>
                        </div>


                </div>
            </div>
        </div>

            </div>
        </div>


    </div>
    <!-- Scripts -->
    <script src="{{asset('js')}}/jquery-3.5.1.min.js"></script>
    <script src="{{asset('js')}}/bootstrap.min.js"></script>
    <script src="{{asset('js')}}/popper.min.js"></script>
    <script src="{{asset('js')}}/all.min.js"></script>
    <script>
        let background_images=$('#background_images').val();
        console.log(background_images);
        $('body').css('background-image', 'url("'+background_images+'/background.png")');

    </script>
</body>

</html>
