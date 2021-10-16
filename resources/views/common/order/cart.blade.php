@extends('layouts.common')
@section('title', "Cart")
@section('content')

    <main class="main cart">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="active"><a href="/cart">Shopping Cart</a></li>
                    <li><a href="#">Order Complete</a></li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg mb-10">
                    <div class="col-lg-8 pr-lg-4 mb-6">
                        <table class="shop-table cart-table">
                            <thead>
                            <tr>
                                <th class="product-name"><span>Product</span></th>
                                <th></th>
                                <th class="product-price"><span>Price</span></th>
                                <th class="product-quantity"><span>Quantity</span></th>
                                <th class="product-subtotal"><span>Subtotal</span></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr ng-repeat="product in cart_products" ng-cloak>
                                <td class="product-thumbnail">
                                    <div class="p-relative">
                                        <a href="/product/@{{ product.product_id }}/@{{product.product_name}}">
                                            <figure>
                                                <img src="@{{ product.featured_image }}" alt="product" width="300"
                                                     height="338">
                                            </figure>
                                        </a>
                                        <button type="submit" class="btn btn-close" ng-click="deleteItem (product)"><i
                                                class="fas fa-times"></i></button>
                                    </div>
                                </td>
                                <td class="product-name">
                                    <a href="/product/@{{ product.product_id }}/@{{product.product_name}}">
                                        @{{ product.product_name }}
                                    </a>
                                </td>
                                <td class="product-price"><span class="amount">@{{ product.selling_price }}</span></td>
                                <td class="product-quantity">
                                    <div class="input-group">
                                        <input class="quantitys form-control" type="number" min="1" max="100000"
                                               value="@{{ product.quantity  }}">
                                        <button class="quantity-plus w-icon-plus" ng-click="incQty(product)"></button>
                                        <button class="quantity-minus w-icon-minus" ng-click="decQty(product)"></button>
                                    </div>
                                </td>
                                <td class="product-subtotal">
                                    <span class="amount">@{{ product.selling_price*product.quantity }} BDT</span>
                                </td>
                            </tr>

                            </tbody>
                        </table>

                        <div class="cart-action mb-6">
                            <a href="/" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i
                                    class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                            <button type="submit" class="btn btn-rounded btn-default btn-clear" name="clear_cart"
                                    value="Clear Cart">Clear Cart
                            </button>
                        </div>

                        <form class="coupon">
                            <h5 class="title coupon-title font-weight-bold text-uppercase">Coupon Discount</h5>
                            <input type="text" class="form-control mb-4" placeholder="Enter coupon code here..."
                                   required="" ng-model="coupon_code">
                            <button class="btn btn-dark btn-outline btn-rounded" ng-click="couponApply()">Apply Coupon
                            </button>
                        </form>
                    </div>
                    <div class="col-lg-4 sticky-sidebar-wrapper">
                        <div class="pin-wrapper" style="height: 788.969px;">
                            <div class="sticky-sidebar"
                                 style="border-bottom: 0px none rgb(102, 102, 102); width: 393.312px;">
                                <div class="cart-summary mb-4">
                                    <h3 class="cart-title text-uppercase">Cart Totals</h3>
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                        <label class="ls-25">Subtotal</label>
                                        <span ng-cloak>@{{totalPriceCountAll}} BDT</span>
                                    </div>
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between pt-3">
                                        <label class="ls-25">Delivery Charge</label>
                                        <span ng-cloak>@{{delivery_charge}} BDT</span>
                                    </div>
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between pt-3">
                                        <label class="ls-25">Coupon</label>
                                        <span ng-cloak>@{{coupon_value}} BDT</span>
                                    </div>
                                    <hr class="divider">

                                    <form action="/customer/order-save" method="post">
                                        @csrf
                                        <input type="hidden" name="products" value="@{{cart_products}}">
                                        <input type="text" style="display: none" name="coupon_code" id="coupon_code"
                                               ng-model="coupon_code">
                                        <input type="text" style="display: none" name="coupon_value" ng-model="coupon_value">
                                       {{-- <input type="text" style="display: none" name="customer_address" id="customer_address"
                                               ng-model="customer_address">--}}
                                        <input type="text" style="display: none" name="notes" ng-model="notes">
                                        <input type="text" style="display: none" name="customer_address_type" ng-model="customer_address_type">
                                        <input type="text" style="display: none" name="delivery_charge" ng-model="delivery_charge"
                                               value="60">


                                        <ul class="shipping-methods mb-2">
                                            <li>
                                                <label class="shipping-title text-dark font-weight-bold">Payment
                                                    Method</label>
                                            </li>

                                            <li>
                                                <div class="custom-radio">
                                                    <input type="radio" id="local-pickup" class="custom-control-input"
                                                           name="cash" checked>
                                                    <label for="local-pickup" class="custom-control-label color-dark">Cash
                                                        on Delivery</label>
                                                </div>
                                            </li>
                                           {{-- <li>
                                                <div class="custom-radio">
                                                    <input type="radio" id="flat-rate" class="custom-control-input"
                                                           name="online">
                                                    <label for="flat-rate" class="custom-control-label color-dark">Online
                                                        Payment</label>
                                                </div>
                                            </li>--}}
                                        </ul>
                                        <ul class="shipping-methods mb-2">
                                            <li>
                                                <label class="shipping-title text-dark font-weight-bold">Deliver to</label>
                                            </li>
                                            <li>
                                                <div class="custom-radio" ng-click="insideDhaka()">
                                                    <input type="radio" id="inside-dhaka" class="custom-control-input" name="deliver_to" checked>
                                                    <label for="inside-dhaka" class="custom-control-label color-dark" >Inside Dhaka</label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="custom-radio"  ng-click="outsideDhaka()">
                                                    <input type="radio" id="outside-dhaka" class="custom-control-input" name="deliver_to">
                                                    <label for="outside-dhaka" class="custom-control-label color-dark">Outside Dhaka</label>
                                                </div>
                                            </li>

                                        </ul>


                                        <div class="shipping-calculator">
                                            <h4 class="shipping-destination lh-1">Shipping to <strong></strong>.</h4>

                                            <div class="shipping-calculator-form">

                                                <div class="form-group">
                                                    <input class="form-control form-control-md" type="text" name="customer_name"
                                                           placeholder="Name" required>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control form-control-md" type="text" name="customer_phone"
                                                           placeholder="Phone" required>
                                                </div>
                                                <div class="form-group">
                                                <textarea class="form-control form-control-md"
                                                          name="customer_address"
                                                          placeholder="Address" required></textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <hr class="divider mb-6">
                                        <div class="order-total d-flex justify-content-between align-items-center">
                                            <label>Total</label>
                                            <span class="ls-50" ng-cloak>@{{  totalPriceCountAll+delivery_charge-coupon_value }} BDT</span>
                                        </div>

                                        <button type="submit"
                                                class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                            Place Order<i class="w-icon-long-arrow-right"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>

@endsection
