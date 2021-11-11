@extends('layouts.common')
@section('title', "Products")
@section('content')
    <!-- Start of Main -->
    <main class="main">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb bb-no">
                    <li><a href="/">Home</a></li>
                    {{-- <li><a href="shop-banner-sidebar.html">Shop</a></li>--}}
                    <li>{{$title}}</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content mb-10">
            <div class="container">
                <!-- Start of Shop Banner -->
                <div class="shop-default-banner banner d-flex align-items-center mb-5 br-xs"
                     style="background-image: url(/common/assets/images/shop/banner1.jpg); background-color: #FFC74E;">
                    <div class="banner-content">
                        <h4 class="banner-subtitle font-weight-bold">Accessories Collection</h4>
                        <h3 class="banner-title text-white text-uppercase font-weight-bolder ls-normal">Smart Wrist
                            Watches</h3>
                        <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Discover
                            Now<i class="w-icon-long-arrow-right"></i></a>
                    </div>
                </div>
                <!-- End of Shop Banner -->


                <div class=" owl-theme appear-animate row cols-lg-6 cols-md-4 cols-sm-3 cols-2 mb-6"
                     data-owl-options="{
                    'nav': false,
                    'dots': true,
                    'margin': 20,
                    'responsive': {
                        '0': {
                            'items': 2
                        },
                        '576': {
                            'items': 3
                        },
                        '768': {
                            'items': 4
                        },
                        '992': {
                            'items': 5
                        }
                    }
                }">
                @foreach($products as $product)
                    @include('common.home.single_product')
                    <!-- End of Product Wrap -->
                    @endforeach

                </div>


            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->
@endsection
