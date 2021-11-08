@extends('layouts.common')
@section('title', $product->product_name)
@section('fb_image',$product->featured_image)
@section('content')

    <!-- Start of Main -->
    <main class="main mb-10 pb-1">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav container">
            <ul class="breadcrumb bb-no">
                <li><a href="/">Home</a></li>
                <li>{{$product->product_name}}</li>
            </ul>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg">
                    <div class="main-content">
                        <div class="product product-single row">
                            <div class="col-md-6 mb-6">
                                <div class="product-gallery product-gallery-sticky">
                                    <div
                                        class="product-single-carousel owl-carousel owl-theme owl-nav-inner row cols-1 gutter-no">
                                        <figure class="product-image">
                                            <img src="{{$product->featured_image}}"
                                                 data-zoom-image="{{$product->featured_image}}"
                                                 alt="Electronics Black Wrist Watch" width="800" height="900">
                                        </figure>
                                        <figure class="product-image">
                                            <img src="{{$product->featured_image}}"
                                                 data-zoom-image="{{$product->featured_image}}"
                                                 alt="Electronics Black Wrist Watch" width="800" height="900">
                                        </figure>


                                    </div>
                                    <div class="product-thumbs-wrap">
                                        <div class="product-thumbs row cols-4 gutter-sm">
                                            <div class="product-thumb active">
                                                <img src="{{$product->featured_image}}"
                                                     alt="Product Thumb" width="800" height="900">
                                            </div>
                                            <div class="product-thumb active">
                                                <img src="{{$product->featured_image}}"
                                                     alt="Product Thumb" width="800" height="900">
                                            </div>

                                        </div>
                                        <button class="thumb-up disabled"><i class="w-icon-angle-left"></i></button>
                                        <button class="thumb-down disabled"><i
                                                class="w-icon-angle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 mb-md-6">
                                <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                    <h2 class="product-title">{{$product->product_name}}</h2>
                                    <p>{{$product->weight}}</p>
                                    <div class="product-bm-wrapper">
                                        <figure class="brand">
                                            <img src="/images/logo.png" alt="Brand"
                                                 width="102" height="48"/>
                                        </figure>
                                        <div class="product-meta">
                                            <div class="product-categories">
                                                <?php
                                                $category_name = getParentCategoryName($product->parent_category_id);
                                                ?>
                                                Category:
                                                <span class="product-category"><a
                                                        href="/parent-categories/{{$product->parent_category_id}}/{{getTitleToUrl($category_name)}}">{{$category_name}}</a></span>
                                            </div>
                                            <div class="product-sku">
                                                Product Code: <span>{{$product->qr_code}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="product-divider">

                                    <div class="product-price">
                                        <ins class="new-price">{{$product->selling_price}}BDT</ins>
                                    </div>
                                    @include('includes.product.avarage_ratings')

                                    <div class="product-short-desc">
                                        {!! $product->product_details !!}
                                    </div>

                                    <hr class="product-divider">
                                    @if($product->product_color!=null AND $product->product_color!='null')

                                        <div class="product-form product-variations product-color">
                                            <label>Color:</label>
                                            <div class="select-box">
                                                <select name="color" class="form-control" ng-model="color"
                                                        ng-change="colorChange()">
                                                    <option value="" selected="selected">Choose an Option</option>
                                                    @foreach(json_decode($product->product_color) as $item)
                                                        <option
                                                            value="{{getColorFromId($item)}}">{{getColorFromId($item)}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    @if($product->product_size!=null AND $product->product_size!='null')
                                        <div class="product-form product-variations product-size mt-2 mb-2">
                                            <label>Size:</label>
                                            <div class="product-form-group">
                                                <div class="select-box">
                                                    <select name="size" class="form-control" ng-model="size"
                                                            ng-change="sizeChange()">
                                                        <option value="" selected="selected">Choose an Option</option>
                                                        @foreach(json_decode($product->product_size) as $item)

                                                            <option
                                                                value="{{getSizeFromId($item)}}">{{getSizeFromId($item)}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                {{--  <a href="#" class="product-variation-clean" style="display: none;">Clean
                                                      All</a>--}}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="fix-bottom product-sticky-content sticky-content">
                                        <div class="product-form container">
                                            <div class="product-qty-form">
                                                <div class="input-group">
                                                    <input class="quantity form-control" type="number" min="1"
                                                           max="10000000">
                                                    <button class="quantity-plus w-icon-plus"></button>
                                                    <button class="quantity-minus w-icon-minus"></button>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-cart" ng-click="addToCart({{$product}})">
                                                <i class="w-icon-cart"></i>
                                                <span>Add to Cart</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="social-links-wrapper">
                                        <div class="social-links">
                                            <div class="social-icons social-no-color border-thin">
                                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                                <a href="#"
                                                   class="social-icon social-pinterest fab fa-pinterest-p"></a>
                                                <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                                                <a href="#"
                                                   class="social-icon social-youtube fab fa-linkedin-in"></a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a href="#product-tab-description" class="nav-link active">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#product-tab-specification" class="nav-link">Specification</a>
                                </li>
                                {{-- <li class="nav-item">
                                     <a href="#product-tab-vendor" class="nav-link">Vendor Info</a>
                                 </li>--}}
                                <li class="nav-item">
                                    <a href="#product-tab-reviews" class="nav-link">Customer Reviews
                                        ({{getReviewCount($product->product_id)}})</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="product-tab-description">
                                    <div class="row mb-4">
                                        <div class="col-md-12 mb-5">
                                            <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                                            <p class="mb-4">{!! $product->product_details !!}</p>
                                        </div>

                                    </div>

                                </div>
                                <div class="tab-pane" id="product-tab-specification">

                                    <div class="row mb-4">
                                        <div class="col-md-12 mb-5">
                                            <h4 class="title tab-pane-title font-weight-bold mb-2">Specification</h4>
                                            <p class="mb-4">{!! $product->product_specification !!}</p>
                                        </div>

                                    </div>

                                </div>
                                {{-- <div class="tab-pane" id="product-tab-vendor">
                                     <div class="row mb-3">
                                         <div class="col-md-6 mb-4">
                                             <figure class="vendor-banner br-sm">
                                                 <img src="/common/assets/images/products/vendor-banner.jpg"
                                                      alt="Vendor Banner" width="610" height="295"
                                                      style="background-color: #353B55;"/>
                                             </figure>
                                         </div>
                                         <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                             <div class="vendor-user">
                                                 <figure class="vendor-logo mr-4">
                                                     <a href="#">
                                                         <img src="/common/assets/images/products/vendor-logo.jpg"
                                                              alt="Vendor Logo" width="80" height="80"/>
                                                     </a>
                                                 </figure>
                                                 <div>
                                                     <div class="vendor-name"><a href="#">Jone Doe</a></div>
                                                     <div class="ratings-container">
                                                         <div class="ratings-full">
                                                             <span class="ratings" style="width: 90%;"></span>
                                                             <span class="tooltiptext tooltip-top"></span>
                                                         </div>
                                                         <a href="#" class="rating-reviews">(32 Reviews)</a>
                                                     </div>
                                                 </div>
                                             </div>
                                             <ul class="vendor-info list-style-none">
                                                 <li class="store-name">
                                                     <label>Store Name:</label>
                                                     <span class="detail">OAIO Store</span>
                                                 </li>
                                                 <li class="store-address">
                                                     <label>Address:</label>
                                                     <span class="detail">Steven Street, El Carjon, CA 92020, United
                                                             States (US)</span>
                                                 </li>
                                                 <li class="store-phone">
                                                     <label>Phone:</label>
                                                     <a href="#tel:">1234567890</a>
                                                 </li>
                                             </ul>
                                             <a href="vendor-dokan-store.html"
                                                class="btn btn-dark btn-link btn-underline btn-icon-right">Visit
                                                 Store<i class="w-icon-long-arrow-right"></i></a>
                                         </div>
                                     </div>
                                     <p class="mb-5">Details</p>

                                 </div>--}}
                                <div class="tab-pane" id="product-tab-reviews">
                                    <div class="row mb-4">
                                        <div class="col-xl-4 col-lg-5 mb-4">
                                            <div class="ratings-wrapper">
                                                <div class="avg-rating-container">
                                                    <h4 class="avg-mark font-weight-bolder ls-50">{{getAverageRating($product->product_id)}}</h4>
                                                    <div class="avg-rating">
                                                        <p class="text-dark mb-1">Average Rating</p>
                                                        @include('includes.product.avarage_ratings')
                                                    </div>
                                                </div>
                                                {{--    <div
                                                        class="ratings-value d-flex align-items-center text-dark ls-25">
                                                            <span
                                                                class="text-dark font-weight-bold">66.7%</span>Recommended<span
                                                            class="count">(2 of 3)</span>
                                                    </div>--}}
                                                {{--<div class="ratings-list">
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 100%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <div class="progress-bar progress-bar-sm ">
                                                            <span></span>
                                                        </div>
                                                        <div class="progress-value">
                                                            <mark>70%</mark>
                                                        </div>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 80%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <div class="progress-bar progress-bar-sm ">
                                                            <span></span>
                                                        </div>
                                                        <div class="progress-value">
                                                            <mark>30%</mark>
                                                        </div>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 60%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <div class="progress-bar progress-bar-sm ">
                                                            <span></span>
                                                        </div>
                                                        <div class="progress-value">
                                                            <mark>40%</mark>
                                                        </div>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 40%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <div class="progress-bar progress-bar-sm ">
                                                            <span></span>
                                                        </div>
                                                        <div class="progress-value">
                                                            <mark>0%</mark>
                                                        </div>
                                                    </div>
                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width: 20%;"></span>
                                                            <span class="tooltiptext tooltip-top"></span>
                                                        </div>
                                                        <div class="progress-bar progress-bar-sm ">
                                                            <span></span>
                                                        </div>
                                                        <div class="progress-value">
                                                            <mark>0%</mark>
                                                        </div>
                                                    </div>
                                                </div>--}}
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-7 mb-4">

                                            @if (!Auth::check())
                                                <div class="review-form-wrapper">
                                                    <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                        Review</h3>
                                                    <p class="mb-3">Your email address will not be published. Required
                                                        fields are marked *</p>
                                                    @include('includes.message')
                                                    <form action="/customer/review-store" method="POST"
                                                          class="review-form">
                                                        @csrf
                                                        <div class="rating-form">
                                                            <label for="rating">Your Rating Of This Product :</label>
                                                            <span class="rating-stars">
                                                                <a class="star-1" href="">1</a>
                                                                <a class="star-2" href="">2</a>
                                                                <a class="star-3" href="">3</a>
                                                                <a class="star-4" href="">4</a>
                                                                <a class="star-5" href="">5</a>
                                                            </span>
                                                            <select name="score" id="rating" required=""
                                                                    style="display: none;">
                                                                <option value="">Rate…</option>
                                                                <option value="5">Perfect</option>
                                                                <option value="4">Good</option>
                                                                <option value="3">Average</option>
                                                                <option value="2">Not that bad</option>
                                                                <option value="1">Very poor</option>
                                                            </select>
                                                        </div>
                                                        <textarea cols="30" rows="6"
                                                                  placeholder="Write Your Review Here..."
                                                                  class="form-control" name="comment"
                                                                  id="review">

                                                        </textarea>
                                                        <input type="hidden" name="product_id"
                                                               value="{{$product->product_id}}">
                                                        <button type="submit" class="btn btn-dark">Submit
                                                            Review
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <h3 class="title tab-pane-title font-weight-bold mb-1">Submit Your
                                                    Review, Please Sign-In</h3>
                                                <a href="/common/assets/ajax/login.blade.php"
                                                   class="btn btn-sm d-lg-show login sign-in"><i
                                                        class="w-icon-account"></i>Sign In</a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="show-all">
                                                <ul class="comments list-style-none">
                                                    @foreach($reviews as $res)
                                                        <li class="comment">
                                                            <div class="comment-body">
                                                                <figure class="comment-avatar">
                                                                    <img
                                                                        src="/common/assets/images/agents/1-100x100.png"
                                                                        alt="Commenter Avatar" width="90" height="90">
                                                                </figure>
                                                                <div class="comment-content">
                                                                    <h4 class="comment-author">
                                                                        <a href="#">{{$res->customer_name}}</a>
                                                                        <span
                                                                            class="comment-date">{{getDateFormat($res->created_at) }}</span>
                                                                    </h4>
                                                                    <div class="ratings-container comment-rating">
                                                                        <div class="ratings-full">
                                                                            <span class="ratings"
                                                                                  style="width: 60%;"></span>
                                                                            <span
                                                                                class="tooltiptext tooltip-top"></span>
                                                                        </div>
                                                                    </div>
                                                                    <p>{{$res->comment}}</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <section class="related-product-section">
                            <div class="title-link-wrapper mb-4">
                                <h4 class="title">Related Products</h4>
                                <a href="/" class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                                    Products<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                            <div class="owl-carousel owl-theme row cols-lg-6 cols-md-4 cols-sm-3 cols-2"
                                 data-owl-options="{
                                    'nav': false,
                                    'dots': false,
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
                                            'items': 3
                                        }
                                    }
                                }">
                                @foreach($related_products as $product)
                                    @include('common.home.single_product')
                                @endforeach
                            </div>
                        </section>
                    </div>
                    <!-- End of Main Content -->
                    <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                        <div class="sidebar-overlay"></div>
                        <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                        <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                        <div class="sidebar-content scrollable">
                            <div class="sticky-sidebar">
                                <div class="widget widget-icon-box mb-6">
                                    <div class="icon-box icon-box-side">
                                            <span class="icon-box-icon text-dark">
                                                <i class="w-icon-truck"></i>
                                            </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">Free Shipping & Returns</h4>
                                            <p>For all orders over $99</p>
                                        </div>
                                    </div>
                                    <div class="icon-box icon-box-side">
                                            <span class="icon-box-icon text-dark">
                                                <i class="w-icon-bag"></i>
                                            </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">Secure Payment</h4>
                                            <p>We ensure secure payment</p>
                                        </div>
                                    </div>
                                    <div class="icon-box icon-box-side">
                                            <span class="icon-box-icon text-dark">
                                                <i class="w-icon-money"></i>
                                            </span>
                                        <div class="icon-box-content">
                                            <h4 class="icon-box-title">Money Back Guarantee</h4>
                                            <p>Any back within 30 days</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Widget Icon Box -->

                                <div class="widget widget-banner mb-9">
                                    <div class="banner banner-fixed br-sm">
                                        <figure>
                                            <img src="/common/assets/images/shop/banner3.jpg" alt="Banner" width="266"
                                                 height="220" style="background-color: #1D2D44;"/>
                                        </figure>
                                        <div class="banner-content">
                                            <div class="banner-price-info font-weight-bolder text-white lh-1 ls-25">
                                                40<sup class="font-weight-bold">%</sup><sub
                                                    class="font-weight-bold text-uppercase ls-25">Off</sub>
                                            </div>
                                            <h4
                                                class="banner-subtitle text-white font-weight-bolder text-uppercase mb-0">
                                                Ultimate Sale</h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- End of Widget Banner -->

                            </div>
                        </div>
                    </aside>
                    <!-- End of Sidebar -->
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
    <!-- End of Main -->


@endsection
