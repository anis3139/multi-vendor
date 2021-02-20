@extends('layouts.app')

@section('mainContent')
<div id="login" class="container">

    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ml-auto">
        <div class="login-card card">
            <div class="card-header border-0 ">
                <h5 class="text-center">Profile Update</h5>
            </div>
            <div class="card-body pt-0">
                @include('massege')
                @include('errorMassage')


                <form action="{{route('client.upadeteProfile', $user->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <img id="profileImage" style="height: 150px !important; width: 150px !important;"
                        class="imgPreview mx-auto d-block" src="{{$user->image ?? asset('images/default-image.png') }}" />
                    <div class="form-group my-4">

                        <input type="file" class="form-control login" name="image" id="image" >
                    </div>
                    <div class="form-group my-4">
                        <input type="text" class="form-control login" name="name"  placeholder="Name" value="{{$user->name}}">
                    </div>
                    <div class="form-group my-4">
                        <input type="text" class="form-control login"name="phone_number" placeholder="Phone Number" value="{{$user->phone_number}}">
                    </div>
                    <div class="form-group my-4">
                        <input type="text" class="form-control login" name="email" id="email" placeholder="Email"  value="{{$user->email}}">
                    </div>
                    <div class="form-group my-4">

                        <textarea cols="30" rows="10"  class="form-control login" name="address" id="address" placeholder="Address" >{{$user->address}}</textarea>
                    </div>
                    <div class="form-group my-4">
                        <input type="text" class="form-control login" name="city" id="city" placeholder="City"  value="{{$user->city}}">
                    </div>
                    <div class="form-group my-4">
                        <input type="text" class="form-control login" name="district" id="district" placeholder="District"  value="{{$user->district}}">
                    </div>
                    <div class="form-group my-4">
                        <input type="text" class="form-control login" name="postal_code" id="postal_code" placeholder="Zip Code"  value="{{$user->postal_code}}">
                    </div>
                    <div class="form-group my-4">
                        <input type="Password" class="form-control login" name="password" id="password" placeholder="Password">
                    </div>

                    <div class="form-group my-4">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                    </div>

                    <div class="form-group text-center my-4">
                        <input type="submit" class="btn btn-success btn-disable btn-block p-2 font-weight-bold" value="Update" >
                    </div>
                </form>




            </div>
        </div>
    </div>


</div>
@endsection
 @section('js')

    <script>
          $('#image').change(function() {
            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(event) {
                var ImgSource = event.target.result;
                $('#profileImage').attr('src', ImgSource)
            }
        })
    </script>

 @endsection
