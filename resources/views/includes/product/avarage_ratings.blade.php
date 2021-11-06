<div class="ratings-container">
    <div class="ratings-full">
        <span class="ratings"
              @if(getAverageRating($product->product_id) == 5) style="width: 100%;"
              @elseif(getAverageRating($product->product_id)== 4) style="width: 80%;"
              @elseif(getAverageRating($product->product_id) == 3) style="width: 60%;"
              @elseif(getAverageRating($product->product_id) == 2) style="width: 40%;"
              @elseif(getAverageRating($product->product_id) == 1) style="width: 20%;"
             @else style="width: 0%;
              @endif
        >

        </span>
        <span class="tooltiptext tooltip-top"></span>
    </div>
    <a href="#product-tab-reviews"
       class="rating-reviews scroll-to">({{getReviewCount($product->product_id)}}
        Reviews)</a>
</div>
