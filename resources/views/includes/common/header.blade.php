<header class="header header-border">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <p class="welcome-msg">Welcome to Firebox!</p>
            </div>
            <div class="header-right">

                <!-- End of Dropdown Menu -->

                <a href="/contact-us" class="d-lg-show">Contact Us</a>
                @if (!Auth::guard('is_customer')->check())
                    <a href="/common/assets/ajax/login.blade.php" class="d-lg-show login sign-in"><i
                            class="w-icon-account"></i>Sign In</a>
                    <span class="delimiter d-lg-show">/</span>
                    <a href="/common/assets/ajax/login.blade.php" class="ml-0 d-lg-show login register">Register</a>
                @else
                    <a href="/customer/profile" class="d-lg-show">My Account</a>
                @endif
            </div>
        </div>
    </div>
    <!-- End of Header Top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left mr-md-4">
                <a href="#" class="mobile-menu-toggle  w-icon-hamburger">
                </a>
                <a href="/" class="logo ml-lg-0">
                    <img src="/images/logo.png" alt="logo" width="145" height="45"/>
                </a>
                <form method="get" action="/search"
                      class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                    <div class="select-box">
                        <select id="category" name="category">
                            <option value="0">All Categories</option>
                            @foreach(getMainType() as $category)
                                <option
                                    value="{{$category->parent_category_id}}">{{$category->parent_category_name_en}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class="form-control" name="search" id="search"
                           placeholder="Search in..." required/>
                    <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                    </button>
                </form>
            </div>
            <div class="header-right ml-4">
                <div class="header-call d-xs-show d-lg-flex align-items-center">
                    <a href="tel:#" class="w-icon-call"></a>
                    <div class="call-info d-lg-show">
                        <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                            <a href="mailto:#" class="text-capitalize">Call Us Now</a> :</h4>
                        <a href="tel:#" class="phone-number font-weight-bolder ls-50">{{getPhone()}}</a>
                    </div>
                </div>
                <a class="wishlist label-down link d-xs-show" href="#">
                    <i class="w-icon-heart"></i>
                    <span class="wishlist-label d-lg-show">Wishlist</span>
                </a>

                <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                    <div class="cart-overlay"></div>
                    <a href="#" class="cart-toggle label-down link">
                        <i class="w-icon-cart">
                            <span class="cart-count" ng-bind="total_item" ng-cloak></span>
                        </i>
                        <span class="cart-label">Cart</span>
                    </a>
                @include('includes.common.cart_product')
                <!-- End of Dropdown Box -->
                </div>
            </div>
        </div>
    </div>
    <!-- End of Header Middle -->

    <div class="sticky-content-wrapper" style="">
        <div class="header-bottom sticky-content fix-top sticky-header" style="">
            <div class="container">
                <div class="inner-wrap">
                    <div class="header-left">
                        <div class="dropdown category-dropdown has-border" data-visible="true">
                            <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="true" data-display="static"
                               title="Browse Categories">
                                <i class="w-icon-category"></i>
                                <span>Browse Categories</span>
                            </a>

                            <div class="dropdown-box">
                                <ul class="menu vertical-menu category-menu">

                                    @foreach(getCategories(11) as $parent_category)

                                        @if(count($parent_category->categories)>0)



                                            <li class="has-submenu">
                                                <a href="/parent-categories/{{$parent_category->parent_category_id}}/{{getTitleToUrl($parent_category->parent_category_name_en)}}">
                                                    <i class="w-icon-furniture"></i>{{$parent_category->parent_category_name_en}}
                                                </a>
                                                <ul class="submenu">

                                                    @foreach($parent_category->categories as $category)


                                                        <li>
                                                            <a href="/categories/{{$category->category_id}}/{{getTitleToUrl($category->category_name_en)}}">{{$category->category_name_en}}</a>
                                                        </li>
                                                        {{-- <li>
                                                             <h4 class="menu-title">Men</h4>
                                                             <hr class="divider">
                                                             <ul>
                                                                 <li><a href="shop-fullwidth-banner.html">New Arrivals</a>
                                                                 </li>
                                                                 <li><a href="shop-fullwidth-banner.html">Best Sellers</a>
                                                                 </li>

                                                             </ul>
                                                         </li>--}}
                                                    @endforeach

                                                </ul>
                                            </li>


                                        @else
                                            <li>
                                                <a href="/parent-categories/{{$parent_category->parent_category_id}}/{{getTitleToUrl($parent_category->parent_category_name_en)}}">
                                                    <i class="w-icon-heartbeat"></i>{{$parent_category->parent_category_name_en}}
                                                </a>
                                            </li>
                                        @endif

                                    @endforeach


                                    <li>
                                        <a href="shop-banner-sidebar.html"
                                           class="font-weight-bold text-primary text-uppercase ls-25">
                                            View All Categories<i class="w-icon-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <nav class="main-nav">
                            <ul class="menu active-underline">
                                <li class="active">
                                    <a href="/">Home</a>
                                </li>
                                <li class="">
                                    <a href="/">About</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                    <div class="header-right">
                        <a href="#" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                        <a href="#"><i class="w-icon-sale"></i>Daily Deals</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
