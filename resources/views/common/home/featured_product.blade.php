<div class="title-link-wrapper title-deals appear-animate mb-4">
    <h2 class="title title-link">Deals Of The Day</h2>
    <div
        class="product-countdown-container font-size-sm text-white  align-items-center mr-auto">
        {{-- <label>Offer Ends in: </label>
         <div class="product-countdown countdown-compact ml-1 font-weight-bold" data-until="+10d"
              data-relative="true" data-compact="true">10days,00:00:00
         </div>--}}
    </div>
    <a href="#" class="ml-0">More Products<i class="w-icon-long-arrow-right"></i></a>
</div>
<div class="owl-carousel owl-theme appear-animate row cols-lg-5 cols-md-4 cols-sm-3 cols-2 mb-6"
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
@foreach($featured_products as $product)
    @include('common.home.single_product')
    <!-- End of Product Wrap -->
    @endforeach

</div>
<!-- End of Prodcut Deals Wrapper -->
