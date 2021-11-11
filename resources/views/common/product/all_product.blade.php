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


                <!-- Start of Shop Category -->
                <div class="shop-default-category category-ellipse-section mb-6">
                    <div
                        class=" owl-theme appear-animate row cols-lg-6 cols-md-4 cols-sm-3 cols-2 mb-6"
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
                                                 width="190" height="190" style="background-color: #5C92C0;"/>
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

                <div class="shop-content toolbox-horizontal">
                    <!-- Start of Toolbox -->
                   {{-- <nav class="toolbox sticky-toolbox sticky-content fix-top">
                        <aside class="sidebar sidebar-fixed shop-sidebar">
                            <div class="sidebar-overlay"></div>
                            <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                            <div class="sidebar-content toolbox-left">
                                <!-- Start of Collapsible widget -->
                                <div class="toolbox-item select-menu">
                                    <a class="select-menu-toggle" href="#">All Categories</a>
                                    <ul class="filter-items">
                                        <li><a href="#">Accessories</a></li>
                                        <li><a href="#">Babies</a></li>
                                        <li><a href="#">Beauty</a></li>
                                        <li><a href="#">Decoration</a></li>
                                        <li><a href="#">Electronics</a></li>
                                        <li><a href="#">Fashion</a></li>
                                        <li><a href="#">Food</a></li>
                                        <li><a href="#">Furniture</a></li>
                                        <li><a href="#">Kitchen</a></li>
                                        <li><a href="#">Medical</a></li>
                                        <li><a href="#">Sports</a></li>
                                        <li><a href="#">Watches</a></li>
                                    </ul>
                                </div>
                                <div class="toolbox-item select-menu">
                                    <a class="select-menu-toggle" href="#">Price</a>
                                    <ul class="filter-items">
                                        <li><a href="#">$0.00 - $100.00</a></li>
                                        <li><a href="#">$100.00 - $200.00</a></li>
                                        <li><a href="#">$200.00 - $300.00</a></li>
                                        <li><a href="#">$300.00 - $500.00</a></li>
                                        <li><a href="#">$500.00+</a></li>
                                        <li>
                                            <form class="price-range">
                                                <input type="number" name="min_price" class="min_price text-center"
                                                       placeholder="$min"><span class="delimiter">-</span><input
                                                    type="number" name="max_price" class="max_price text-center"
                                                    placeholder="$max"><a href="#"
                                                                          class="btn btn-primary btn-rounded">Go</a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                <div class="toolbox-item select-menu">
                                    <a class="select-menu-toggle" href="#">Size</a>
                                    <ul class="filter-items item-check">
                                        <li><a href="#">Extra Large</a></li>
                                        <li><a href="#">Large</a></li>
                                        <li><a href="#">Medium</a></li>
                                        <li><a href="#">Small</a></li>
                                    </ul>
                                </div>
                                <div class="toolbox-item select-menu">
                                    <a class="select-menu-toggle" href="#">Brand</a>
                                    <ul class="filter-items item-check">
                                        <li><a href="#">Elegant Auto Group</a></li>
                                        <li><a href="#">Green Grass</a></li>
                                        <li><a href="#">Node Js</a></li>
                                        <li><a href="#">NS8</a></li>
                                        <li><a href="#">Red</a></li>
                                        <li><a href="#">Skysuite Tech</a></li>
                                        <li><a href="#">Sterling</a></li>
                                    </ul>
                                </div>
                                <div class="toolbox-item select-menu">
                                    <a class="select-menu-toggle" href="#">Color</a>
                                    <ul class="filter-items item-check">
                                        <li><a href="#">Black</a></li>
                                        <li><a href="#">Blue</a></li>
                                        <li><a href="#">Brown</a></li>
                                        <li><a href="#">Green</a></li>
                                        <li><a href="#">Grey</a></li>
                                        <li><a href="#">Orange</a></li>
                                        <li><a href="#">Yellow</a></li>
                                    </ul>
                                </div>
                                <!-- End of Collapsible Widget -->
                            </div>
                        </aside>
                        <div class="toolbox-left">
                            <div class="toolbox-item toolbox-sort select-menu">
                                <a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle
                                        btn-icon-left d-block d-lg-none"><i
                                        class="w-icon-category"></i><span>Filters</span></a>
                                <select name="orderby" class="form-control">
                                    <option value="default" selected="selected">Default sorting</option>
                                    <option value="popularity">Sort by popularity</option>
                                    <option value="rating">Sort by average rating</option>
                                    <option value="date">Sort by latest</option>
                                    <option value="price-low">Sort by pric: low to high</option>
                                    <option value="price-high">Sort by price: high to low</option>
                                </select>
                            </div>
                        </div>

                    </nav>--}}
                    <!-- End of Toolbox -->

                    <!-- Start of Selected Items -->
                    <div class="selected-items mb-3">
                        <a href="#" class="filter-clean text-primary">Clean All</a>
                    </div>
                    <!-- End of Selected Items -->

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
