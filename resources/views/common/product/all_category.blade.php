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
                    <li>All Categories</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content mb-10">
            <div class="container">
                <!-- Start of Shop Category -->
                <div class="shop-default-category category-ellipse-section mb-6">
                    <div
                        class=" owl-theme appear-animate row cols-lg-8 cols-md-4 cols-sm-3 cols-2 mb-6"
                        data-owl-options="{
                            'nav': false,
                            'dots': true,
                            'margin': 20,
                            'responsive': {
                                '0': {
                                    'items': 2
                                },
                                '480': {
                                    'items': 3
                                },
                                '576': {
                                    'items': 4
                                },
                                '768': {
                                    'items': 6
                                },
                                '992': {
                                    'items': 7
                                },
                                '1200': {
                                    'items': 8,
                                    'margin': 30
                                }
                            }
                        }">

                        @foreach($categories as $category)
                            <div class="category-wrap">
                                <div class="category category-ellipse">
                                    <figure class="category-media">
                                        <a href="{{$category->category_link}}">
                                            <img src="{{$category->category_image}}" alt="Categroy"
                                                 width="100" height="100" style="background-color: #5C92C0;"/>
                                        </a>
                                    </figure>
                                    <div class="category-content">
                                        <h4 class="category-name">
                                            <a href="{{$category->category_link}}">{{$category->category_name}}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- End of Shop Category -->

            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->
@endsection
