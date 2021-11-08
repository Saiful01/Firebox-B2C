<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CompanyAdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerNotificationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryChargeController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MerchantPaymentController;
use App\Http\Controllers\MerchantProductController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\ParentCategoryController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionalSliderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WholeSaleCategoryController;
use App\Http\Controllers\WholeSaleController;
use App\Http\Controllers\WholesSaleSubCategoryController;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*Admin Area Started Here*/
Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('/admin/report/show', [DashboardController::class, 'report']);
    Route::get('/admin/shop-report/show/{id}', [DashboardController::class, 'ShopReport']);
    Route::get('/admin/profile', [DashboardController::class, 'profile']);
    Route::get('/admin/product/create', [ProductController::class, 'create']);
    Route::post('/admin/product/store', [ProductController::class, 'store']);
    Route::get('/admin/product/show', [ProductController::class, 'show']);
    Route::get('/admin/product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('/admin/product/update', [ProductController::class, 'update']);
    Route::get('/admin/product/delete/{id}', [ProductController::class, 'destroy']);
    Route::get('/admin/product/details/{id}', [ProductController::class, 'productDetails']);
    Route::get('/admin/product/featured/{id}', [ProductController::class, 'featured']);
    Route::get('/admin/product/unfeatured/{id}', [ProductController::class, 'unfeatured']);
    Route::get('/admin/product/active/{id}', [ProductController::class, 'active']);
    Route::get('/admin/product/inactive/{id}', [ProductController::class, 'Inactive']);

    /*    whole sales Product management*/
    Route::get('/admin/whole-sale/product/create', [WholeSaleController::class, 'index']);
    Route::post('/admin/whole-sale/product/store', [WholeSaleController::class, 'store']);
    Route::get('/admin/whole-sale/product/show', [WholeSaleController::class, 'show']);
    Route::get('/admin/whole-sale/product/edit/{id}', [WholeSaleController::class, 'edit']);
    Route::post('/admin/whole-sale/product/update', [WholeSaleController::class, 'update']);
    Route::get('/admin/whole-sale/product/delete/{id}', [WholeSaleController::class, 'destroy']);
    Route::get('/admin/whole-sale/product/details/{id}', [WholeSaleController::class, 'productDetails']);
    Route::get('/admin/whole-sale/product/featured/{id}', [WholeSaleController::class, 'featured']);
    Route::get('/admin/whole-sale/product/unfeatured/{id}', [WholeSaleController::class, 'unfeatured']);
    Route::get('/admin/whole-sale/product/active/{id}', [WholeSaleController::class, 'active']);
    Route::get('/admin/whole-sale/product/inactive/{id}', [WholeSaleController::class, 'inactive']);


    //Manage Whole Sale Category
    Route::get('/admin/whole-sale/category/show', [WholeSaleCategoryController::class, 'show']);
    Route::get('/admin/whole-sale/category/create', [WholeSaleCategoryController::class, 'index']);
    Route::post('/admin/whole-sale/category/store', [WholeSaleCategoryController::class, 'store']);
    Route::get('/admin/whole-sale/category/delete/{id}', [WholeSaleCategoryController::class, 'destroy']);
    Route::get('/admin/whole-sale/category/edit/{id}', [WholeSaleCategoryController::class, 'edit']);
    Route::post('/admin/whole-sale/category/update', [WholeSaleCategoryController::class, 'update']);


    //Manage Sub Category
    Route::get('/admin/whole-sale/sub-category/show', [WholesSaleSubCategoryController::class, 'show']);
    Route::get('/admin/whole-sale/sub-category/create', [WholesSaleSubCategoryController::class, 'index']);
    Route::post('/admin/whole-sale/sub-category/store', [WholesSaleSubCategoryController::class, 'store']);
    Route::get('/admin/whole-sale/sub-category/delete/{id}', [WholesSaleSubCategoryController::class, 'destroy']);
    Route::get('/admin/whole-sale/sub-category/edit/{id}', [WholesSaleSubCategoryController::class, 'edit']);
    Route::post('/admin/whole-sale/sub-category/update', [WholesSaleSubCategoryController::class, 'update']);


    //Manage Customer
    Route::get('/admin/customer/create', [CustomerController::class, 'create']);
    Route::post('/admin/customer/store', [CustomerController::class, 'store']);
    Route::get('/admin/customer/show', [CustomerController::class, 'show']);
    Route::get('/admin/customer/edit/{id}', [CustomerController::class, 'edit']);
    Route::post('/admin/customer/update', [CustomerController::class, 'update']);
    Route::get('/admin/customer/delete/{id}', [CustomerController::class, 'destroy']);
    Route::get('/admin/customer/notification/{id}', [CustomerNotificationController::class, 'show']);
    Route::get('/admin/notification/delete/{id}', [CustomerNotificationController::class, 'destroy']);
    Route::post('/admin/notification/save', [CustomerNotificationController::class, 'store']);

    //Manage Customer
    Route::get('/admin/customer/create', [CustomerController::class, 'create']);
    Route::post('/admin/customer/store', [CustomerController::class, 'store']);
    Route::get('/admin/customer/show', [CustomerController::class, 'show']);
    Route::get('/admin/customer/edit/{id}', [CustomerController::class, 'edit']);
    Route::post('/admin/customer/update', [CustomerController::class, 'update']);

    //Manage Order
    Route::any('/admin/order/show', [OrderController::class, 'show']);
    Route::get('/admin/order/details/{invoice}', [OrderController::class, 'orderDetails']);
    Route::get('/admin/order/status-update/{invoice}/{status}', [OrderController::class, 'orderStatusUpdate']);

    Route::post('/admin/order/cash-payment/store', [OrderController::class, 'cashPaymentStore']);
    Route::get('/admin/order-invoice/print/{invoice}', [OrderController::class, 'InvoicePrint']);
    Route::get('/admin/order-status/history/{id}', [OrderController::class, 'orderDeliveryStatus']);
    Route::post('/admin/order/store', [OrderController::class, 'store']);
    Route::get('/admin/order/edit/{id}', [OrderController::class, 'edit']);
    Route::post('/admin/order/update', [OrderController::class, 'update']);

    //delivery status
    Route::get('/admin/order-status/update/{invoice}/{value}', [OrderStatusController::class, 'statusUpdate']);

    //Manage Coupon
    Route::get('/admin/coupon/show', [CouponController::class, 'show']);
    Route::get('/admin/coupon/create', [CouponController::class, 'create']);
    Route::post('/admin/coupon/store', [CouponController::class, 'store']);
    Route::get('/admin/coupon/delete/{id}', [CouponController::class, 'destroy']);
    Route::get('/admin/coupon/edit/{id}', [CouponController::class, 'edit']);
    Route::post('/admin/coupon/update', [CouponController::class, 'update']);

    //Manage Testimonial
    Route::get('/admin/testimonial/show', [TestimonialController::class, 'show']);
    Route::get('/admin/testimonial/create', [TestimonialController::class, 'create']);
    Route::post('/admin/testimonial/store', [TestimonialController::class, 'store']);
    Route::get('/admin/testimonial/delete/{id}', [TestimonialController::class, 'destroy']);
    Route::get('/admin/testimonial/edit/{id}', [TestimonialController::class, 'edit']);
    Route::post('/admin/testimonial/update', [TestimonialController::class, 'update']);
    Route::get('/admin/testimonial/active/{id}', [TestimonialController::class, 'active']);
    Route::get('/admin/testimonial/inactive/{id}', [TestimonialController::class, 'inactive']);

    //Manage FAQ
    Route::get('/admin/faq/show', [FaqController::class, 'show']);
    Route::get('/admin/faq/create', [FaqController::class, 'create']);
    Route::post('/admin/faq/store', [FaqController::class, 'store']);
    Route::get('/admin/faq/delete/{id}', [FaqController::class, 'destroy']);
    Route::get('/admin/faq/edit/{id}', [FaqController::class, 'edit']);
    Route::post('/admin/faq/update', [FaqController::class, 'update']);
    Route::get('/admin/faq/active/{id}', [FaqController::class, 'active']);
    Route::get('/admin/faq/inactive/{id}', [FaqController::class, 'inactive']);

    /*    //Manage Voucher
        Route::get('/admin/voucher/create', '[VoucherController::class,'index']);
        Route::get('/admin/voucher/show', '[VoucherController::class,'show']);
        Route::post('/admin/voucher/store', '[VoucherController::class,'store']);
        Route::get('/admin/voucher/delete/{id}', '[VoucherController::class,'destroy']);
        Route::get('/admin/voucher/edit/{id}', '[VoucherController::class,'edit']);
        Route::get('/admin/voucher/inactive/edit/{id}', '[VoucherController::class,'inactive']);
        Route::get('/admin/voucher/active/edit/{id}', '[VoucherController::class,'active']);
        Route::post('/admin/voucher/update', '[VoucherController::class,'update']);*/


    //Manage Order
    Route::get('/admin/shop/show', [ShopController::class, 'show']);
    Route::get('/admin/shop/create', [ShopController::class, 'create']);
    Route::post('/admin/shop/store', [ShopController::class, 'store']);
    Route::post('/admin/commission-rate/update', [ShopController::class, 'commisionUpdate']);
    Route::get('/admin/shop/delete/{id}', [ShopController::class, 'destroy']);

    Route::get('/admin/shop/update-status/{id}/{status}', [ShopController::class, 'updateStatus']);


    Route::get('/admin/shop/edit/{id}', [ShopController::class, 'edit']);
    Route::post('/admin/shop/update', [ShopController::class, 'update']);
    Route::get('/admin/shop/order/{id}', [ShopController::class, 'ShopOrder']);
    Route::get('/admin/shop/order-details/{invoice}', [ShopController::class, 'ShopOrderDetails']);
    Route::get('/admin/shop/order-status/history/{id}', [ShopController::class, 'ShopOrderDeliveryHistory']);
    Route::get('/admin/shop/payment-details/{id}', [ShopController::class, 'paymentDetails']);
    Route::get('/admin/shop-details/{id}', [ShopController::class, 'shopDetails']);
    Route::post('/admin/shop-payment/save', [MerchantPaymentController::class, 'store']);

    //Manage Parent Category
    Route::get('/admin/parent-category/create', [ParentCategoryController::class, 'index']);
    Route::get('/admin/parent-category/show', [ParentCategoryController::class, 'show']);
    Route::post('/admin/parent-category/store', [ParentCategoryController::class, 'store']);
    Route::get('/admin/parent-category/delete/{id}', [ParentCategoryController::class, 'destroy']);
    Route::get('/admin/parent-category/edit/{id}', [ParentCategoryController::class, 'edit']);
    Route::post('/admin/parent-category/update', [ParentCategoryController::class, 'update']);

    //Manage Category
    Route::get('/admin/category/show', [ProductCategoryController::class, 'show']);
    Route::get('/admin/category/create', [ProductCategoryController::class, 'create']);
    Route::post('/admin/category/store', [ProductCategoryController::class, 'store']);
    Route::get('/admin/category/delete/{id}', [ProductCategoryController::class, 'destroy']);
    Route::get('/admin/category/edit/{id}', [ProductCategoryController::class, 'edit']);
    Route::post('/admin/category/update', [ProductCategoryController::class, 'update']);


    //Manage Sub Category
    Route::get('/admin/sub-category/show', [SubCategoryController::class, 'show']);
    Route::get('/admin/sub-category/create', [SubCategoryController::class, 'create']);
    Route::post('/admin/sub-category/store', [SubCategoryController::class, 'store']);
    Route::get('/admin/sub-category/delete/{id}', [SubCategoryController::class, 'destroy']);
    Route::get('/admin/sub-category/edit/{id}', [SubCategoryController::class, 'edit']);
    Route::post('/admin/sub-category/update', [SubCategoryController::class, 'update']);

    //Manage Brand
    Route::get('/admin/brand/show', [BrandController::class, 'show']);
    Route::get('/admin/brand/create', [BrandController::class, 'create']);
    Route::post('/admin/brand/store', [BrandController::class, 'store']);
    Route::get('/admin/brand/delete/{id}', [BrandController::class, 'destroy']);
    Route::get('/admin/brand/edit/{id}', [BrandController::class, 'edit']);
    Route::post('/admin/brand/update', [BrandController::class, 'update']);

    //Manage Size
    Route::get('/admin/size/show', [SizeController::class, 'show']);
    Route::get('/admin/size/create', [SizeController::class, 'create']);
    Route::post('/admin/size/store', [SizeController::class, 'store']);
    Route::get('/admin/size/delete/{id}', [SizeController::class, 'destroy']);
    Route::get('/admin/size/edit/{id}', [SizeController::class, 'edit']);
    Route::post('/admin/size/update', [SizeController::class, 'update']);

    //Manage Color
    Route::get('/admin/color/show', [ColorController::class, 'show']);
    Route::get('/admin/color/create', [ColorController::class, 'create']);
    Route::post('/admin/color/store', [ColorController::class, 'store']);
    Route::get('/admin/color/delete/{id}', [ColorController::class, 'destroy']);
    Route::get('/admin/color/edit/{id}', [ColorController::class, 'edit']);
    Route::post('/admin/color/update', [ColorController::class, 'update']);

    //Manage Slider
    Route::get('/admin/slider/show', [SliderController::class, 'show']);
    Route::get('/admin/slider/create', [SliderController::class, 'create']);
    Route::post('/admin/slider/store', [SliderController::class, 'store']);
    Route::get('/admin/slider/delete/{id}', [SliderController::class, 'destroy']);
    Route::get('/admin/slider/edit/{id}', [SliderController::class, 'edit']);
    Route::post('/admin/slider/update', [SliderController::class, 'update']);


    //Manage promotional slider
    Route::get('/admin/promotional-slider/show', [PromotionalSliderController::class, 'show']);
    Route::get('/admin/promotional-slider/create', [PromotionalSliderController::class, 'create']);
    Route::post('/admin/promotional-slider/store', [PromotionalSliderController::class, 'store']);
    Route::get('/admin/promotional-slider/delete/{id}', [PromotionalSliderController::class, 'destroy']);
    Route::get('/admin/promotional-slider/edit/{id}', [PromotionalSliderController::class, 'edit']);
    Route::post('/admin/promotional-slider/update', [PromotionalSliderController::class, 'update']);


    //Manage User
    Route::get('/admin/user/show', [UserController::class, 'show']);
    Route::get('/admin/user/create', [UserController::class, 'create']);
    Route::post('/admin/user/store', [UserController::class, 'store']);
    Route::get('/admin/user/delete/{id}', [UserController::class, 'destroy']);
    Route::get('/admin/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/admin/user/update', [UserController::class, 'update']);

    //Manage User
    Route::get('/admin/video/show', [VideoController::class, 'show']);
    Route::post('/admin/video/store', [VideoController::class, 'store']);
    Route::get('/admin/video/delete/{id}', [VideoController::class, 'destroy']);
    Route::post('/admin/video/update', [VideoController::class, 'update']);

    //Manage Delivery charge
    Route::get('/admin/delivery-charge/create', [DeliveryChargeController::class, 'create']);

    Route::post('/admin/delivery-charge/store', [DeliveryChargeController::class, 'store']);

    //////profile update
    Route::post('/admin/profile/update', [DashboardController::class, 'update']);
    ///app setting
    Route::get('/admin/app/setting', [AppSettingController::class, 'appSetting']);
    Route::post('/admin/app/update', [AppSettingController::class, 'update']);


});


Route::group(['middleware' => 'company'], function () {

    Route::get('/company/order/show', [CompanyAdminController::class, 'orders']);
    //Route::get('/shop/create', '[CompanyAdminController::class,'createShop']);
    Route::post('/company/shop/store', [CompanyAdminController::class, 'storeShop']);
    Route::get('/qr-download/{id}', [CompanyAdminController::class, 'qrDownload']);
});
/*Admin Area Ended Here*/

/*Merchant Start*/
Route::get('/merchant/registration', [MerchantController::class, 'registration']);
Route::post('/merchant/registration/store', [MerchantController::class, 'registrationStore']);
//Route::get('/merchant/registration/shop/{id}', '[MerchantController::class,'registrationShop']);
Route::post('/merchant/register/shop/store', [MerchantController::class, 'RegistrationShopStore']);
//Manage payment report
Route::get('/merchant/report/show', [MerchantProductController::class, 'paymentordershow']);
Route::get('/merchant/sell-report/show', [DashboardController::class, 'MerchantShopReport']);
Route::get('/admin/payment-status/received/{id}', [MerchantPaymentController::class, 'MerchantReceivedStatus']);
Route::get('/merchant/forget-password', [MerchantController::class, 'forgetPassword']);
Route::post('/merchant/reset-password', [MerchantController::class, 'resetPassword']);

Route::group(['prefix' => "merchant", 'middleware' => ['merchant']], function () {
    /* Route::get('/registration', '[CustomerController::class,'login']);*/
    Route::get('/login', [MerchantController::class, 'login']);


    Route::get('/dashboard', [MerchantController::class, 'dashboard']);
    Route::get('/profile', [MerchantController::class, 'profile']);
    Route::get('/payment/report', [MerchantPaymentController::class, 'report']);
    Route::post('/profile/update', [MerchantController::class, 'update']);
    Route::post('/shop/update', [MerchantController::class, 'ShopUpdate']);

    Route::get('/product/create', [MerchantProductController::class, 'create']);
    Route::post('/product/store', [MerchantProductController::class, 'store']);
    Route::get('/product/show', [MerchantProductController::class, 'show']);
    Route::get('/product/edit/{id}', [MerchantProductController::class, 'edit']);
    Route::post('/product/update', [MerchantProductController::class, 'update']);
    Route::get('/product/delete/{id}', [MerchantProductController::class, 'destroy']);
    Route::get('/product/details/{id}', [MerchantProductController::class, 'productDetails']);
    Route::get('/product/featured/{id}', [MerchantProductController::class, 'featured']);

    ////Manage Order
    Route::get('/order/show', [OrderController::class, 'merchantShow']);
    Route::get('/order/details/{invoice}', [OrderController::class, 'merchantOrderDetails']);
    Route::get('/order-invoice/print/{invoice}', [OrderController::class, 'merchantOrderPrint']);
    Route::post('/order/store', [OrderController::class, 'merchantStore']);
    Route::get('/order/edit/{id}', [OrderController::class, 'merchantEdit']);
    Route::post('/order/update', [OrderController::class, 'merchantUpdate']);
    Route::get('/order-status/history/{id}', [OrderController::class, 'merchantOrderDeliveryStatus']);
    //Manage User
    Route::get('/user/show', [UserController::class, 'merchantShow']);
    Route::get('/user/create', [UserController::class, 'merchantCreate']);
    Route::post('/user/store', [UserController::class, 'merchantStore']);
    Route::get('/user/delete/{id}', [UserController::class, 'merchantDestroy']);
    Route::get('/user/edit/{id}', [UserController::class, 'merchantEdit']);
    Route::post('/user/update', [UserController::class, 'merchantUpdate']);

    //  Voucher manage
    Route::get('/voucher/create', [VoucherController::class, 'index']);
    Route::get('/voucher/show', [VoucherController::class, 'show']);
    Route::post('/voucher/store', [VoucherController::class, 'store']);
    Route::get('/voucher/delete/{id}', [VoucherController::class, 'destroy']);
    Route::get('/voucher/edit/{id}', [VoucherController::class, 'edit']);
    Route::get('/voucher/inactive/{id}', [VoucherController::class, 'inactive']);
    Route::get('/voucher/active/{id}', [VoucherController::class, 'active']);
    Route::post('/voucher/update', [VoucherController::class, 'update']);


    //whole sale
    /*    whole sales Product management*/
    Route::get('/whole-sale/product/create', [WholeSaleController::class, 'merchantIndex']);
    Route::post('/whole-sale/product/store', [WholeSaleController::class, 'MerchantStore']);
    Route::get('/whole-sale/product/show', [WholeSaleController::class, 'MerchantShow']);
    Route::get('/whole-sale/product/edit/{id}', [WholeSaleController::class, 'merchantEdit']);
    Route::post('/whole-sale/product/update', [WholeSaleController::class, 'MerchantUpdate']);
    Route::get('/whole-sale/product/delete/{id}', [WholeSaleController::class, 'merchantDestroy']);
    Route::get('/whole-sale/product/details/{id}', [WholeSaleController::class, 'merchantProductDetails']);
    Route::get('/whole-sale/product/featured/{id}', [WholeSaleController::class, 'merchantFeatured']);
    Route::get('/whole-sale/product/unfeatured/{id}', [WholeSaleController::class, 'merchantUnfeatured']);


    //delivery Status Change
    Route::get('/order-status/update/{invoice}/{value}', [OrderStatusController::class, 'MerchantStatusUpdate']);

    //video show
    Route::get('/video/show', [VideoController::class, 'merchantShow']);
    Route::post('/size/store', [SizeController::class, 'store']);
    Route::post('/color/store', [ColorController::class, 'store']);
    Route::post('/brand/store', [BrandController::class, 'store']);

});

/*Merchant End*/

/*Public Area started here*/

Route::get('/error', [Controller::class, 'error']);
Route::get('/', [Controller::class, 'home']);
Route::get('/cart', [Controller::class, 'cart']);
Route::get('/checkout', [Controller::class, 'cart']);
Route::get('/order/success', [Controller::class, 'OrderSuccess']);

Route::get('/contact-us', [Controller::class, 'contact']);
Route::get('/about', [Controller::class, 'about']);
Route::get('/privacy-policy', [Controller::class, 'privacyPolicy']);
Route::get('/return-policy', [Controller::class, 'refundPolicy']);
Route::get('/terms-condition', [Controller::class, 'termsCondition']);

Route::get('/shops', [Controller::class, 'shops']);
Route::get('/our-story', [Controller::class, 'history']);
Route::get('/shop', [Controller::class, 'shop']);
Route::get('/delivery', [Controller::class, 'delivery']);
Route::get('/secure-payment', [Controller::class, 'securePayment']);
Route::post('/contact/store', [ContactController::class, 'store']);
Route::get('/product/{id}/{name}', [Controller::class, 'details']);

Route::get('/parent-categories/{id}/{name}', [Controller::class, 'parentaCategoryProduct']);
Route::get('/categories/{id}/{name}', [Controller::class, 'categoryProduct']);
Route::get('/sub-categories/{id}/{name}', [Controller::class, 'subCategoryProduct']);


Route::any('/shop/{id}/{name}', [Controller::class, 'shopProducts']);

Route::any('/loll', [Controller::class, 'loll']);


Route::any('/offer', [Controller::class, 'offer']);
Route::any('/order-return-policy', [Controller::class, 'returnPolicy']);


//Whole Sale
Route::get('/whole-sale', [Controller::class, 'wholeSale']);
Route::any('/whole-sale/{category_id}/{name}', [Controller::class, 'wholeSaleCategoryProduct']);
Route::any('/whole-sale/sub-category/{sub_category_id}/{name}', [Controller::class, 'wholeSaleSubCategoryProduct']);
Route::get('/whole-sale-product/{product_id}/{product_name}', [Controller::class, 'wholeSaleProductDetails']);
Route::get('/all-featured-product', [Controller::class, 'featuredProduct']);
Route::get('/all-gadget-product', [Controller::class, 'gadget']);
Route::get('/all-fashion-product', [Controller::class, 'fashionProduct']);
Route::get('/recent-product', [Controller::class, 'recentProducts']);
Route::get('/all-wholesale-product', [Controller::class, 'allWholesale']);


Route::any('/shop/{id}/{name}', [Controller::class, 'shopProducts']);

/*Public Area ended here*/


/*Localization start*/
Route::get('locale/{locale}', function ($locale) {

    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});
/*Localization end*/


Route::group(['prefix' => "customer"], function () {
    Route::any('/sign-in', [CustomerController::class, 'login']);
    Route::get('/password-recovery', [CustomerController::class, 'passwordRecovery']);
    Route::post('/sign-in-check', [CustomerController::class, 'loginCheck']);
    Route::post('/sign-up', [CustomerController::class, 'register']);
    Route::get('/notifications', [CustomerController::class, 'notification']);

    Route::get('/forget-password', [CustomerController::class, 'forgetPassword']);
    Route::any('/reset-password', [CustomerController::class, 'resetPassword']);

    Route::any('/order-save', [CustomerController::class, 'orderSave']);
    Route::any('/order-success', [CustomerController::class, 'orderSuccess']);
    Route::any('/order-failed', [CustomerController::class, 'orderFailed']);

    Route::any('/message', [CustomerController::class, 'message']);

});
Route::group(['prefix' => "customer", 'middleware' => ['customer']], function () {

    Route::get('/profile', [CustomerController::class, 'profile']);
    Route::get('/orders', [CustomerController::class, 'orderHistory']);
    Route::get('/orders-detail/{order_invoice}', [CustomerController::class, 'orderDetails']);
    Route::post('/profile/update', [CustomerController::class, 'profileUpdate']);
    Route::post('/address/update', [CustomerController::class, 'addressUpdate']);

    Route::post('/password/update', [CustomerController::class, 'passwordUpdate']);
    Route::get('/logout', [CustomerController::class, 'logout']);

    Route::any('/review-store', [CustomerController::class, 'reviewStore']);

});

Route::any('/success', [CustomerController::class, 'success']);
Route::any('/fail', [CustomerController::class, 'fail']);
Route::any('/cancel', [CustomerController::class, 'cancel']);

/*Frontend Start*/


//Privacy_Policy
Route::get('/privacy-policy', [Controller::class, 'privacyPolicy']);
Route::get('/terms-condition', [Controller::class, 'termsCondition']);
Route::get('/refund-policy', [Controller::class, 'refundPolicy']);
Route::get('/about', [Controller::class, 'about']);


Route::post('/newsletter/store', [NewsletterController::class, 'store']);
/*Route::get('/details/{id}', '[Controller::class,'details2']);*/
Route::get('/details/{id}/{name}', [Controller::class, 'details']);
Route::any('/customer/order/store', [Controller::class, 'placeOrder']);

Route::any('/search', [Controller::class, 'search']);
Route::any('/product/search', [Controller::class, 'productSearch']);

Route::any('/shop/registration', [Controller::class, 'shopRegistration']);
Route::any('/shop/registration-do', function (Request $request) {

    $is_exist = User::where('phone', $request['phone'])->first();
    if (!is_null($is_exist)) {
        return back()->with('failed', '[This phone already used');
    }

    try {
        $otp = getOtp();
        $request['otp'] = $otp;

        $user_array = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'otp' => $request['otp'],
            'password' => Hash::make($request['password'])
        ];

        User::insert($user_array);
        sendSms($request['phone'], "Your eHaat verification code is: " . $otp);
        Session::put('phone', $request['phone']);
        return Redirect::to('/otp-verify');

    } catch (Exception $exception) {
        return back()->with('failed', $request->all());
    }
});
Route::any('/otp-verify', [Controller::class, 'otpVerify']);
Route::any('/failed', [Controller::class, 'failed']);

Route::get('/admin/login', function () {
    return view('admin.login.index');
});
Route::get('/admin/forgot-password', function () {
    return view('admin.login.forgot_password');
});


Route::post('/admin/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/admin/login-check', [AuthController::class, 'loginCheck']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/admin/logout', [AuthController::class, 'logout']);


Route::post('/payment-callback', [Controller::class, 'callbackResponse']);
Route::get('/payment-success', [Controller::class, 'paymentSuccess']);


//District/ Division API
Route::any('/pro/search', [ApiController::class, 'pSearch']);
Route::any('/my/search', [ApiController::class, 'mySearch']);

Route::get('/get-suppliers/{area_type}/{area_id}/{service_type}', [ApiController::class, 'getSuppliers']);

Route::get('/product/category/{id}', [ProductController::class, 'getSubCategory']);


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::any('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::any('/ipn', [SslCommerzPaymentController::class, 'ipn']);
Route::any('/product/search', [ProductController::class, 'search']);

//SSLCOMMERZ END

/*Frontend End*/

/*Shopping Cart API*/

Route::group(['prefix' => 'cart'], function () {
    Route::any('/add', [ShoppingCartController::class, 'addItem']);
    Route::any('/update', [ShoppingCartController::class, 'updateQuantity']);
    Route::any('/remove/{id}', [ShoppingCartController::class, 'removeItem']);
    Route::any('/all', [ShoppingCartController::class, 'getAll']);
    Route::any('/remove-all', [ShoppingCartController::class, 'removeAllItem']);
    Route::any('/get-total-weight', [ShoppingCartController::class, 'getTotalWeight']);
    Route::any('/get-total-item', [ShoppingCartController::class, 'getTotalItem']);
    Route::any('/get-total-price', [ShoppingCartController::class, 'getSubTotal']);
    Route::any('/get-total-discount', [ShoppingCartController::class, 'getTotalDiscount']);
    Route::any('/get-total-set', [ShoppingCartController::class, 'getTotalSet']);
});


/*Public Page  API*/

Route::group(['prefix' => 'web-api'], function () {
    Route::any('/products', [ApiController::class, 'getProducts']);
    Route::any('/whole-sale/products', [ApiController::class, 'getWholeSaleProducts']);
    Route::any('/product/parent-category/{id}', [ApiController::class, 'getCategories']);
    Route::any('/product/category/{id}', [ApiController::class, 'getSubCategories']);

    Route::any('/whole-sale-product/categories/{id}', [ApiController::class, 'getWholeSaleProductCategories']);

    Route::any('/shop-products', [ApiController::class, 'getShopProducts']);
    Route::any('/promo-code', [ApiController::class, 'couponValidate']);

    Route::any('/get-division', [ApiController::class, 'getDivision']);
    Route::any('/get-district', [ApiController::class, 'getDistrict']);
    Route::any('/get-upazila', [ApiController::class, 'getUpazila']);
    Route::any('/login', [ApiController::class, 'login']);
    Route::any('/subscribe', [ApiController::class, 'subscribe']);

    Route::any('/customer-info', [ApiController::class, 'customerInfo']);
});

//Order Save
Route::any('/success/{invoice}', [CustomerController::class, 'orderSuccess']);


Route::any('/user/sign-in', function (Request $request) {
    $phone = '01717849968';
    $password = '123456';

    $credentials = [
        'customer_phone' => $phone,
        'password' => $password,
    ];

    if (Auth::guard('is_customer')->attempt($credentials)) {

        return redirect('/customer/profile');
    }

});



