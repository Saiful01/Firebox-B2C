<div class="dropdown-box">
    <div class="cart-header">
        <span>Shopping Cart</span>
        <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
    </div>

    <div class="products">
        <div class="product product-cart" ng-repeat="product in cart_products">
            <div class="product-detail">
                <a href="/product/@{{ product.product_id }}/@{{product.product_name}}" class="product-name">@{{ product.product_name }}</a>
                <div class="price-box">
                    <span class="product-quantity">@{{ product.quantity }}</span>
                    <span class="product-price">@{{ product.selling_price*product.quantity }}</span>
                </div>
            </div>
            <figure class="product-media">
                <a href="/product/@{{ product.product_id }}/@{{product.product_name}}">
                    <img src="@{{ product.featured_image }}" alt="product" height="84"
                         width="94"/>
                </a>
            </figure>
            <button class="btn btn-link btn-close"
                    ng-click="deleteItem (product)">
                <i class="fas fa-times"></i>
            </button>
        </div>

    </div>

    <div class="cart-total">
        <label>Subtotal:</label>
        <span class="price">@{{totalPriceCountAll}}</span>
    </div>

    <div class="cart-action">
        <a href="/cart" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
        <a href="/checkout" class="btn btn-primary  btn-rounded">Checkout</a>
    </div>
</div>
