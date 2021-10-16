@extends('layouts.home')
@section('title',"Best Online Shopping mall in Bangladesh | Firebox.com.bd")
@section('fb_image',"/images/slider_image/1.jpg")

@section('content')

    <main class="main">
        <div class="container">
            @include('common.home.slider')
            @include('common.home.new_product')
            @include('common.home.full_banner')
            @include('common.home.featured_product')
            @include('common.home.double_banner')

            @include('common.home.healthcare')
            @include('common.home.footwear_products')
        </div>
        <!-- End of Container -->


        <div class="container mt-10 pt-2">
        @include('common.home.full_banner')
        <!-- End of Banner Simple -->

        {{-- @include('common.home.recent_views')--}}
        <!-- End of Reviewed Producs -->
        </div>
    </main>
@endsection
