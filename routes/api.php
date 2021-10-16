<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('customer:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => "/v1/customer", 'middleware' => ['app_request']], function () {

    Route::any('/login', 'Api\AuthController@login');
    Route::any('/home', 'Api\CustomerApiController@homeData');

    Route::any('/all-categories', 'Api\CustomerApiController@categories');
    Route::any('/filtered-product', 'Api\CustomerApiController@filteredProducts');
    Route::any('/product-details', 'Api\CustomerApiController@productsDetails');
    Route::any('/vouchers', 'Api\CustomerApiController@vouchers');

    //After Login
    Route::any('/get-address', 'Api\CustomerApiController@getAddress');
    Route::any('/save-address', 'Api\CustomerApiController@saveAddress');
    Route::any('/get-orders', 'Api\CustomerApiController@getOrders');
    Route::any('/order-details', 'Api\CustomerApiController@orderDetails');


    Route::any('/products', 'Api\CustomerApiController@products');


    Route::any('/coupon', 'Api\CustomerApiController@coupon');
    Route::any('/order-save', 'Api\CustomerApiController@orderSave');

    //WholeSale
    Route::any('/whole-sale-categories', 'Api\CustomerApiController@wholeSaleCategories');
    Route::any('/filtered-whole-sale-product', 'Api\CustomerApiController@filteredWholeSaleProducts');
    Route::any('/whole-sale-product-details', 'Api\CustomerApiController@wholeSalesProductDetails');

});
Route::any('/merchant/reset-pass/otp', 'Api\AuthController@MerchantGenerateOtp');

Route::group(['prefix' => "/v1/customer"], function () {
    //OTP
    Route::any('/create-account/generate-otp', 'Api\AuthController@createAccountGenerateOtp');
    Route::any('/app-check-otp', 'Api\AuthController@appCheckOtp');//Register from App
    Route::any('/registration', 'Api\AuthController@registration');

    //For All
    Route::any('/reset-pass/otp', 'Api\AuthController@generateOtp');
    Route::any('/reset-pass/check-otp', 'Api\AuthController@checkOtp');
    Route::any('/reset-pass', 'Api\AuthController@resetPass');

    Route::any('/get-notifications ', 'Api\CustomerApiController@notifications');
    //For Android
    Route::any('/android-registration', 'Api\AuthController@androidRegistration');
    Route::any('/android-check-otp', 'Api\AuthController@androidCheckOtp');
    Route::any('/android-update-profile', 'Api\AuthController@androidUpdateProfile');
    Route::any('/write-review', 'Api\CustomerApiController@androidWriteReview');

});


Route::any('/get-division-district-upazila', 'Api\CustomerApiController@getDivisionDistrictUpazila');
Route::any('/get-division-district-upazila-json', 'Api\CustomerApiController@getDivisionDistrictUpazilaJson');

