<div class="product-wrap">
    <div class="product text-center">
        <figure class="product-media">
            <a href="/product/{{$product->product_id}}/{{getTitleToUrl($product->product_name)}}">
                <img src="{{$product->featured_image}}" alt="Product"
                     width="300"
                     height="338" style="min-height: 256px">
                <img src="{{$product->featured_image}}" alt="Product"
                     width="300"
                     height="338" style="min-height: 256px">
            </a>
            <div class="product-label-group">
                <label class="product-label label-discount">{{$product->discount_rate}}% OFF</label>
            </div>
        </figure>
        <div class="product-details">
            <h4 class="product-name"><a href="/product/{{$product->product_id}}/{{getTitleToUrl($product->product_name)}}">{{$product->product_name}}</a></h4>

            <div class="product-price">
                <ins class="new-price">{{$product->selling_price}} BDT</ins>
                <del class="old-price ">{{$product->regular_price}} BDT</del>

            </div>
            <button class="btn btn-primary btn-cart" ng-click="addToCart({{$product}})">
                <i class="w-icon-cart"></i>
                <span>Add to Cart</span>
            </button>
        </div>
    </div>
</div>
