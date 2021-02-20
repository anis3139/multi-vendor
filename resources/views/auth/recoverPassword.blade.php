@extends('layouts.app')
@section('css')

<style>
    .aa-login-form input[type="email"], .aa-login-form input[type="number"]{
    border: 1px solid #ccc;
    font-size: 16px;
    height: 40px;
    margin-bottom: 15px;
    padding: 10px;
    width: 100%;
    }
}
</style>

@endsection
@section('mainContent')



 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">
            <div class="row">
              <div class="col-md-12">
                @include('massege')
                @include('errorMassage')

                @if($user)
                <div class="aa-myaccount-register my-5">
                 <h4 class=" text-center">Hello, Mr. {{$user->name}}.... <br> Please Reset Your Password</h4>

                 <form action="{{route('client.updatePassword')}}" class="aa-login-form registration" method="post" class="form-group">
                    @csrf
                    <label for="email">Email address<span>*</span></label>
                    <input name="email" readonly type="email" placeholder="Email" value="{{$user->email}}" class="form-control">
                    <label for="">New Password<span>*</span></label>
                    <input required name="password" type="password" placeholder="Password" class="form-control">
                    <label for="">Confirm Password<span>*</span></label>
                    <input required name="password_confirmation" type="password" placeholder="Confirm Password" class="form-control">
                    <button type="submit" class="btn btn-primary mt-3">Reset Password</button>
                  </form>
                </div>

                @endif
              </div>
            </div>
            <div class="row">

            </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
@endsection
