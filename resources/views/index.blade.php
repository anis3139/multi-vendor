@extends('layouts.app')

@section('title','Ovendar Home')

@section('mainContent')



{{-- Slider --}}
@include('homePage.slider')



{{-- Banner --}}
@include('homePage.banner')



{{-- Popular Product --}}
@include('homePage.popular')


{{-- Categories Product --}}
@include('homePage.categories')


{{-- flash Product --}}
@include('homePage.flashSell')

@endsection
