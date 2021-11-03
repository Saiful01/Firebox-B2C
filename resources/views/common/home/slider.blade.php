<div class="intro-wrapper">
    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="owl-carousel owl-theme row gutter-no cols-1 animation-slider owl-dot-inner"
                 data-owl-options="{
                                'nav': false,
                                'dots': true,
                                'items': 1,
                                'autoplay': true
                            }">

                @foreach($sliders as $slider)
                    <a href="{{$slider->slider_url}}">
                        <div class="intro-slide intro-slide2 banner banner-fixed br-sm"
                             style="background-image: url({{$slider->slider_image}}); background-color: #EBEDEC;">
                            <div class="banner-content y-50">
                                <div class="slide-animate" data-animation-options="{
                                            'name': 'fadeInRightShorter', 'duration': '1s'
                                        }">
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach

                {{-- <div class="intro-slide intro-slide3 banner banner-fixed br-sm"
                      style="background-image: url(/images/slider_image/2.jpg); background-color: #E0E0DE;">
                     <div class="banner-content text-right y-50">
                         <div class="slide-animate" data-animation-options="{
                                             'name': 'fadeInUpShorter', 'duration': '1s'
                                         }">

                         </div>
                     </div>
                 </div>
                 <div class="intro-slide intro-slide3 banner banner-fixed br-sm"
                      style="background-image: url(/images/slider_image/3.jpg); background-color: #E0E0DE;">
                     <div class="banner-content text-right y-50">
                         <div class="slide-animate" data-animation-options="{
                                             'name': 'fadeInUpShorter', 'duration': '1s'
                                         }">

                         </div>
                     </div>
                 </div>--}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                @foreach($secondary_slider as $slider)
                    <div class="col-md-12 col-xs-6 mb-4">
                        <div class="category-banner banner banner-fixed br-sm">
                            <a href="{{$slider->slider_url}}">
                                <figure>
                                    <img src="{{$slider->slider_image}}" alt="Category"
                                         width="330" height="239" style="background-color: #605959;"/>
                                </figure>
                            </a>


                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<!-- End of Intro-wrapper -->

<div class="owl-carousel owl-theme row cols-md-4 cols-sm-3 cols-1 icon-box-wrapper appear-animate br-sm bg-white"
     data-owl-options="{
                    'nav': false,
                    'dots': false,
                    'loop': true,
                    'margin': 30,
                    'autoplay': true,
                    'autoplayTimeout': 4000,
                    'responsive': {
                        '0': {
                            'items': 1
                        },
                        '576': {
                            'items': 2
                        },
                        '768': {
                            'items': 2
                        },
                        '992': {
                            'items': 3
                        },
                        '1200': {
                            'items': 4
                        }
                    }
                    }">
    {{-- <div class="icon-box icon-box-side text-dark">
             <span class="icon-box-icon icon-shipping">
                 <i class="w-icon-truck"></i>
             </span>
         <div class="icon-box-content">
             <h4 class="icon-box-title font-weight-bolder ls-normal">Free Shipping & Returns</h4>
             <p class="text-default">For all orders over 500 BDT</p>
         </div>
     </div>--}}
    <div class="icon-box icon-box-side text-dark">
                        <span class="icon-box-icon icon-payment">
                            <i class="w-icon-bag"></i>
                        </span>
        <div class="icon-box-content">
            <h4 class="icon-box-title font-weight-bolder ls-normal">Secure Payment</h4>
            <p class="text-default">We ensure secure payment</p>
        </div>
    </div>
    <div class="icon-box icon-box-side text-dark icon-box-money">
                        <span class="icon-box-icon icon-money">
                            <i class="w-icon-money"></i>
                        </span>
        <div class="icon-box-content">
            <h4 class="icon-box-title font-weight-bolder ls-normal">Money Back Guarantee</h4>
            <p class="text-default">Any back within 7 days</p>
        </div>
    </div>
    <div class="icon-box icon-box-side text-dark icon-box-chat">
                        <span class="icon-box-icon icon-chat">
                            <i class="w-icon-chat"></i>
                        </span>
        <div class="icon-box-content">
            <h4 class="icon-box-title font-weight-bolder ls-normal">Customer Support</h4>
            <p class="text-default">Call or email us 24/7</p>
        </div>
    </div>
</div>
<!-- End of Iocn Box Wrapper -->
