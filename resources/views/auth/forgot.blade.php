@extends('layouts.app')

@section('mainContent')

 <!-- catg header banner section -->

  <!-- / catg header banner section -->
 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">
            <div class="row">
              <div class="col-md-12">

                <div class="aa-myaccount-register">
                 <h4 class="text-center mt-5 text-primary">Reset Password</h4>
                 @include('massege')
                 @include('errorMassage')
                 <form action="{{route('client.forgotPassword')}}" class="aa-login-form registration" method="post">
                    @csrf
                    <label for="email" class="text-primary">Please Enter Your Email<span>*</span></label>
                    <input class="form-control" required name="email" type="email" placeholder="Email" value="{{old('email')}}">
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                  </form>
                </div>
                <div class="row">

                    @guest
                        <div class="col-md-12"  style="margin-top: 20px !important">
                            <p>Don't have an account? <a class="text-primary" href="{{route('client.registration')}}"> Register now! </a></p>
                        </div>
                    @endguest
                </div>
              </div>
            </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
@endsection
