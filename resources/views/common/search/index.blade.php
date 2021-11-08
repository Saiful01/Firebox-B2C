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
                    <li>Results for : {{$search}}</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content mb-10">
            <div class="container">


                <div class="shop-content toolbox-horizontal">
                    <!-- Start of Toolbox -->


                    <!-- Start of Product Wrapper -->
                    <div class="product-wrapper row cols-lg-6 cols-md-3 cols-sm-2 cols-2">
                        @foreach($products as $product)
                            @include('common.home.single_product')
                        @endforeach

                    </div>
                    <!-- End of Product Wrapper -->


                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->
@endsection
