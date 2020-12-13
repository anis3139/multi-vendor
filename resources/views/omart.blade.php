@extends('layouts.app')


@section('css')

<link rel="stylesheet" href="{{ asset('css') }}/slick.css">
<link rel="stylesheet" href="{{ asset('css') }}/slick-theme.css">

@endsection

@section('title',"Ovendar Mall")


@section('mainContent')

{{-- Brand Slider --}}
<div class="col-12 col-sm-12 col-md-11 col-lg-11 col-xl-11 mt-4 mx-auto allproduct">

@include('omart.allproductBrandslider')
@include('omart.featuredCollections')
@include('omart.featuredSellers')
@include('omart.main-content')

</div>




@endsection

@section('js')
    <script src="{{ asset('js') }}/slick.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.customer-logos').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrows: true,
                centerPadding:'1px',
                dots: false,
                pauseOnHover: false,
                responsive: [{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 520,
                    settings: {
                        slidesToShow: 3
                    }
                }]
            });
        });
    </script>
@endsection
