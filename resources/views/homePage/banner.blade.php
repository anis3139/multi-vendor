@php
$others=App\Models\OthersModel::first();
@endphp

<div id="banner">
    <div class="col-12 col-sm-12 col-md-11 col-lg-11 col-xl-11 m-auto text-center p-0">
        <a href="#">
            <img class="bannerImage img-fluid" src="@if ($others)
            {{$others->promo_image_three}}
            @endif" alt="Baner">
        </a>
    </div>
</div>
