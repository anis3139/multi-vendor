@extends('layouts.app')


@section('css')

<link rel="stylesheet" href="{{ asset('css') }}/slick.css">
<link rel="stylesheet" href="{{ asset('css') }}/slick-theme.css">

@endsection

@section('title',"All Product")


@section('mainContent')

{{-- Brand Slider --}}
<div class="col-12 col-sm-12 col-md-11 col-lg-11 col-xl-11 mt-4 mx-auto allproduct">

{{-- @include('allproduct.allproductBrandslider')
@include('allproduct.featuredCollections')
@include('allproduct.featuredSellers')
@include('allproduct.main-content') --}}

</div>




@endsection

@section('js')
    <script src="{{ asset('js') }}/slick.js"></script>
@endsection
