@extends('vendor.layouts.vendor')
@section('title', 'Profile')
@section('content')
<div class="container m-5">
    <div class="row">
        <div class="col-md-12">
            <img  src="{{auth()->user()->image ?? asset('admin/images/default-image.png')}}" alt="{{auth()->user()->name}}" width="150px" height="150px" style="border-radius:50%; margin:20px  auto !important; display:block;">
            <table class="table table-borderless table-hover" style="padding:10px;">
                <tr>
                    <td>name:</td>
                    <td>{{auth()->user()->name}}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{auth()->user()->email}}</td>
                </tr>
                <tr>
                    <td>Mobile:</td>
                    <td>{{auth()->user()->phone_number}}</td>
                </tr>
                <tr>
                    <td>Adress:</td>
                    <td>{{auth()->user()->address}}</td>
                </tr>
                <tr>
                    <td>City:</td>
                    <td>{{auth()->user()->city}}</td>
                </tr>
                <tr>
                    <td>District:</td>
                    <td>{{auth()->user()->district}}</td>
                </tr>
                <tr>
                    <td>Zip code:</td>
                    <td>{{auth()->user()->postal_code}}</td>
                </tr>
                <tr>

                    <td colspan="2"><a class="btn btn-success" href="{{route('vendor.profileEdit', auth()->user()->id)}}" style="margin:20px  auto !important; display:block;"><h4>Profile Edit</h4></td>
                </tr>
            </table>
        </div>

    </div>


</div>
@endsection
