<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <meta name="facebook-domain-verification" content="9s4xmoh2am6iwhmvvfley2vabmd6ih"/>
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="Description"
          content="Best Online shopping for men, women and kids. Buy groceries, dress, shoes, bags, perfume, jewelries, beauty products at Firebox.com.bd">
    <meta name="Keywords"
          content="online shopping bangladesh, Online Shopping bd, Online shopping mall, Online shop in Bangladesh">


    <meta property="og:image" content="@yield('fb_image')"/>
    <meta property="og:image:width" content="600"/>
    <meta property="og:image:height" content="375"/>


    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/favicon.png">


    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: {families: ['Poppins:400,500,600,700']}
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '/common/assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="preload" href="/common/assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font"
          type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="/common/assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font"
          type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="/common/assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font"
          type="font/woff2"
          crossorigin="anonymous">
    <link rel="preload" href="/common/assets/fonts/wolmart87d5.ttf?png09e" as="font" type="font/ttf"
          crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="/common/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/common/assets/vendor/animate/animate.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="/common/assets/vendor/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" type="text/css" href="/common/assets/vendor/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="/common/assets/vendor/photoswipe/photoswipe.min.css">
    <link rel="stylesheet" type="text/css" href="/common/assets/vendor/photoswipe/default-skin/default-skin.min.css">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="/common/assets/css/style.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="/js/new_cart.js"></script>

    <style>
        .product-wrap {
            margin-bottom: 2rem !important;
        }

        .product-media img:first-child {
            border: 1px solid #f0ebeb;
        }
    </style>

</head>

<body  ng-app="ecomApp" ng-controller="shoppingController">
<div class="page-wrapper">
    <!-- Start of Header -->
@include('includes.common.header')
<!-- End of Header -->

    <!-- Start of Main -->
@yield('content')
<!-- End of Main -->

    <!-- Start of Footer -->
@include('includes.common.footer')
    <!-- End of Footer -->
</div>
<!-- End of Page Wrapper -->

<!-- Start of Sticky Footer -->
<div class="sticky-footer sticky-content fix-bottom">
    <a href="demo1.html" class="sticky-link active">
        <i class="w-icon-home"></i>
        <p>Home</p>
    </a>
    <a href="shop-banner-sidebar.html" class="sticky-link">
        <i class="w-icon-category"></i>
        <p>Shop</p>
    </a>
    <a href="my-account.html" class="sticky-link">
        <i class="w-icon-account"></i>
        <p>Account</p>
    </a>
    <div class="cart-dropdown dir-up">
        <a href="cart.html" class="sticky-link">
            <i class="w-icon-cart"></i>
            <p>Cart</p>
        </a>
        <div class="dropdown-box">
            <div class="products">
                <div class="product product-cart">
                    <div class="product-detail">
                        <h3 class="product-name">
                            <a href="product-default.html">Beige knitted elas<br>tic
                                runner shoes</a>
                        </h3>
                        <div class="price-box">
                            <span class="product-quantity">1</span>
                            <span class="product-price">$25.68</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="#">
                            <img src="/common/assets/images/cart/product-1.jpg" alt="product" height="84" width="94"/>
                        </a>
                    </figure>
                    <button class="btn btn-link btn-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="product product-cart">
                    <div class="product-detail">
                        <h3 class="product-name">
                            <a href="https://www.portotheme.com/html/wolmart/product.html">Blue utility pina<br>fore
                                denim dress</a>
                        </h3>
                        <div class="price-box">
                            <span class="product-quantity">1</span>
                            <span class="product-price">$32.99</span>
                        </div>
                    </div>
                    <figure class="product-media">
                        <a href="#">
                            <img src="/common/assets/images/cart/product-2.jpg" alt="product" width="84" height="94"/>
                        </a>
                    </figure>
                    <button class="btn btn-link btn-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="cart-total">
                <label>Subtotal:</label>
                <span class="price">$58.67</span>
            </div>

            <div class="cart-action">
                <a href="cart.html" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                <a href="checkout.html" class="btn btn-primary  btn-rounded">Checkout</a>
            </div>
        </div>
        <!-- End of Dropdown Box -->
    </div>

    <div class="header-search hs-toggle dir-up">
        <a href="#" class="search-toggle sticky-link">
            <i class="w-icon-search"></i>
            <p>Search</p>
        </a>
        <form action="#" class="input-wrapper">
            <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                   required/>
            <button class="btn btn-search" type="submit">
                <i class="w-icon-search"></i>
            </button>
        </form>
    </div>
</div>

<!-- Start of Scroll Top -->
<a id="scroll-top" href="#top" title="Top" role="button" class="scroll-top"><i class="fas fa-chevron-up"></i></a>
<!-- End of Scroll Top -->

<!-- Start of Mobile Menu -->
@include('includes.common.mobile_menu')
<!-- End of Mobile Menu -->

<!-- Root element of PhotoSwipe. Must have class pswp -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides.
			PhotoSwipe keeps only 3 of them in the DOM to save memory.
			Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" aria-label="Close (Esc)"></button>
                <button class="pswp__button pswp__button--zoom" aria-label="Zoom in/out"></button>

                <div class="pswp__preloader">
                    <div class="loading-spin"></div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>

            <button class="pswp__button--arrow--left" aria-label="Previous (arrow left)"></button>
            <button class="pswp__button--arrow--right" aria-label="Next (arrow right)"></button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
<!-- End of PhotoSwipe -->


<!-- Plugin JS File -->
<script src="/common/assets/vendor/jquery/jquery.min.js"></script>
<script src="/common/assets/vendor/sticky/sticky.min.js"></script>
<script src="/common/assets/vendor/jquery.plugin/jquery.plugin.min.js"></script>
<script src="/common/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="/common/assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="/common/assets/vendor/owl-carousel/owl.carousel.min.js"></script>
<script src="/common/assets/vendor/zoom/jquery.zoom.min.js"></script>
<script src="/common/assets/vendor/photoswipe/photoswipe.min.js"></script>
<script src="/common/assets/vendor/photoswipe/photoswipe-ui-default.min.js"></script>


<!-- Main JS File -->
<script src="/common/assets/js/main.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>


</html>
