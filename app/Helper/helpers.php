<?php

use App\Customer;
use App\DeliveryCharge;
use App\Order;
use App\ParentCategory;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\Shop;
use App\SubCategory;
use App\WholeSaleCategory;
use App\WholeSaleProductImage;
use App\WholesSaleSubCategory;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

function getCategories($numbers)
{

    $popular_categories = ParentCategory::limit($numbers)->get();
    foreach ($popular_categories as $item) {
        $sub_categories = $item->categories = ProductCategory::where('parent_category_id', $item->parent_category_id)->get();
        foreach ($sub_categories as $sub_category) {
            $sub_category->sub_categories = SubCategory::where('category_id', $sub_category->category_id)->get();
        }
    }
    return $popular_categories;
}

function statusFormat($status)
{

    return ucfirst(str_replace('_', ' ', $status));
}

function getMerchantActiveMessage()
{
    return " your account have been successfully verified. Start your delivery today ";
}

function getShops()
{
    return Shop::get();
}

function getTestimonials()
{
    return \App\Testimonial::OrderBy('created_at', "DESC")->get();
}

function getFaq()
{
    return \App\Faq::OrderBy('created_at', "DESC")->get();
}


function getWeightClass()
{
    return $status_array = array(

        '1' => 'Gram',
        '2' => 'KiloGram',
        '3' => 'Pound',
        '4' => 'Ounce'

    );
}

function getWeightClassValueFromId($id)
{
    if ($id == null) {
        return "-";
    }
    $status_array = array(

        '1' => 'Gram',
        '2' => 'KiloGram',
        '3' => 'Pound',
        '4' => 'Ounce'
    );
    return $status_array[$id];
}

function getLengthClass()
{
    return $status_array = array(

        '1' => 'Centimeter',
        '2' => 'Meter',
        '3' => 'Inch',
        '4' => 'Foot',
        '5' => 'Hand'
    );
}

function getStockStatus()
{
    return $status_array = array(

        '1' => 'In Stock',
        '2' => 'Pre-book',
        '3' => 'Sold Out',
    );
}

function getStockStatusValueFromId($id)
{
    if (!is_numeric($id)) {
        return "-";
    }
    $status_array = array(

        '1' => 'In Stock',
        '2' => 'Pre-book',
        '3' => 'Sold Out',
    );
    return $status_array[$id];
}


function getGender()
{
    return $status_array = array(

        '1' => 'Men',
        '2' => 'Wemen',
        '3' => 'Children',

    );
}

function getGenderFromId($id)
{
    if (!is_numeric($id)) {
        return "-";
    }
    $status_array = array(
        '1' => 'Men',
        '2' => 'Wemen',
        '3' => 'Children',
    );
    return $status_array[$id];
}


function getColor()
{
    return \App\Color::get();
    /*    return $status_array = array(

            '1' => 'সাদা',
            '2' => 'কালো',
            '3' => 'লাল',
            '4' => 'ছাই',
            '5' => 'কালো-সাদা',
            '6' => 'ছাই-সাদা',
            '7' => 'লাল-সাদা',
        );*/
}


function getSize()
{
    return \App\Size::get();
    /*  return $status_array = array(


          '1' => 'Small',
          '2' => 'Medium',
          '3' => 'Large',
          '4' => 'Xtra Large ',

      );*/
}


function getSizeFromId($id)
{
    if ($id == null || !is_numeric($id)) {
        return "-";
    }
    return \App\Size::where('size_id', $id)->first()->size_name;

    /* $status_array = getSize();
     return $status_array[$id];*/
}


function getColorFromId($id)

{
    if ($id == null || !is_numeric($id)) {
        return "-";
    }
    return \App\Color::where('color_id', $id)->first()->color_name;

    /* $status_array = getColor();

     return $status_array[$id];*/
}

function gettingProductType()
{
    return $status_array = array(
        '1' => 'Recent',
        '2' => 'Popular',
        '3' => 'Best Deals',
    );
}

function gettingProductTypeById($id)
{
    $status_array = array(
        '1' => 'Recent',
        '2' => 'Popular',
        '3' => 'Best Deals',
    );
    return $status_array[$id];
}


function getEntity()
{
    return $status_array = array(
        '1' => 'Local Shop',
        '2' => 'Local Factory',
        '3' => 'Company',
    );
}

function getMainType()
{
    return ParentCategory::get();
    /* return $status_array = array(
         '1' => 'MOBILES & MORE',
         '2' => 'MEN',
         '3' => 'WOMEN',
         '4' => 'HOME & KITCHEN',
         '5' => 'APPLIANCES',
         '6' => 'SPORTS & MORE',
     );*/

}

function getParentCategoryName($id)
{
    $is_exist = ParentCategory::where('parent_category_id', $id)->first();
    if (is_null($is_exist)) {
        return "";
    } else {
        return $is_exist->parent_category_name_en;
    }

}

function getParentCategoryProducts($id)
{
    return Product::where('parent_category_id', $id)->get();


}

function getProducts()
{
    return Product::get();


}

function getCategoryName($id)
{
    $is_exist = ProductCategory::where('category_id', $id)->first();
    if (is_null($is_exist)) {
        return "";
    } else {
        return $is_exist->category_name_en;
    }

}

function getSubCategoryName($id)
{
    $is_exist = SubCategory::where('sub_category_id', $id)->first();
    if (is_null($is_exist)) {
        return "";
    } else {
        return $is_exist->sub_category_name_en;

    }
}

function getBrand()
{
    return \App\Brand::get();
}


function getProductCategory()
{
    return ProductCategory::get();
}

function getProductSubCategory()
{
    return SubCategory::get();
}

function getSubCategoryProductCount($id)
{
    return Product::where('sub_category_id', $id)->count();
}

function getReviewCountFromProductId($id)
{
    return \App\ProductReview::where('product_id', $id)->count();
}

function getWholeSaleCategory()
{

    $lists = WholeSaleCategory::get();
    foreach ($lists as $list) {

        $list->category = WholesSaleSubCategory::where('category_id', $list->whole_sale_category_id)->get();
    }

    return $lists;
}

function getWholeSaleProductImages($id)
{
    return WholeSaleProductImage::where('product_id', $id)->get();
}

function getWholeSaleCategoryName($id)
{
    return WholeSaleCategory::where('whole_sale_category_id', $id)->first()->category_name_en;
}

function getWholeSaleSubCategoryName($id)
{
    return WholesSaleSubCategory::where('whole_sale_sub_category_id', $id)->first()->sub_category_name_en;
}

function getWholeSaleSubCategory()
{
    return WholesSaleSubCategory::get();
}

function getWholeSaleSubCategoryFromCategoryId($id)
{
    return \App\WholesSaleSubCategory::where('category_id', $id)->get();
}

function getEntityFromId($id)
{
    $status_array = array(
        '1' => 'Local Shop',
        '2' => 'Local Factory',
        '3' => 'Company',

    );
    return $status_array[$id];
}


function getCustomerFromId($id)
{
    $customer = Customer::where('customer_id', $id)->first();
    if (is_null($customer)) {
        return "-";
    } else {
        return $customer->customer_name;
    }

}


function getTitleToUrl($title)
{
    if ($title == null) {
        return "-";
    }
    $title = strtolower(str_replace(" ", "-", $title));
    $title = strtolower(str_replace("/", "-", $title));

    return $title;
}


function getShopNameFromId($id)
{
    $is_exist = Shop::where('shop_id', $id)->first();
    if (is_null($is_exist)) {
        return "-";
    }
    return $is_exist->shop_name;
}

function getShopNameFromUserId($id)
{
    return Shop::where('user_id', $id)->first()->shop_name;
}

function getOrderCount()
{
    if (Auth::user()->user_type != 1) {
        return "";
    }


    return Order::count();
}

function getOrderItemCount($invoice)
{
    return \App\OrderItem::where('order_invoice', $invoice)->count();
}

function getCustomer()
{
    if (Auth::user()->user_type != 1) {
        return "";
    }
    return Customer::count();
}


function formatMydata($number)
{
    if (substr($number, 0, 2) == "88") {
        $number = substr($number, 2);
    }

    if (substr($number, 0, 1) != "0") {
        $number = "0" . $number;
    }

    if (substr($number, 0, 2) == "00") {
        $number = substr($number, 1);
    }
    return $number;

}

function sendSms($mobile, $sms)
{

    $response = Http::get('https://api.mobireach.com.bd/SendTextMessage?Username=martvenue&Password=}Nw3XBcz&From=' . getFromForApi() . '&To=' . $mobile . '&Message=' . $sms);
    $xml = simplexml_load_string($response);
    $json = json_encode($xml);
    $array = json_decode($json, TRUE);


    $MessageId = $array['ServiceClass']['MessageId'];
    $status = $array['ServiceClass']['Status'];
    $SMSCount = $array['ServiceClass']['SMSCount'];
    $ErrorText = $array['ServiceClass']['ErrorText'];
    $CurrentCredit = $array['ServiceClass']['CurrentCredit'];

    if ($status == 0) {
        return 1;
    }
    if ($status == 1) {
        return 0;
    }
    return $status;


    return 1;
    try {
        $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
        $paramArray = array(
            'userName' => "01717849968",
            'userPassword' => "acdd53898d",
            'mobileNumber' => $mobile,
            'smsText' => $sms,
            'type' => "TEXT",
            'maskName' => '',
            'campaignName' => '',
        );
        $value = $soapClient->__call("OneToOne", array($paramArray));

        return 1;

    } catch (\Exception $exception) {

        return $exception->getMessage();
        return 0;
        //echo $e->getMessage();
        //echo '{"status" : "sms_send_decline", "message": "' . $e->getMessage() . '"}';
    }


    $mobile = formatMydata($mobile);
    $url = "http://bulksms.teletalk.com.bd/link_sms_send.php?op=SMS&user=ekShop-core&pass=Jd\P3<ASPt&mobile=" . $mobile . "&charset=UTF-8&sms=" . urlencode($sms);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
}


function getMessageStatus($message_id)
{
    $response = Http::get('https://api.mobireach.com.bd/SendTextMessage?Username=mardtvenue&Password=}Nw3XBcz&From=' . getFromForApi() . '&MessageId=' . $message_id);
    $xml = simplexml_load_string($response);
    $json = json_encode($xml);
    return $array = json_decode($json, TRUE);

}

function getDivisionNameFromId($id)
{
    $is_exist = DB::table('divisions')->where('id', $id)->first();
    if (is_null($is_exist)) {
        return "-";
    } else {

        return $is_exist->name;
    }
}

function getDistrictNameFromId($id)
{
    $is_exist = DB::table('districts')->where('id', $id)->first();
    if (is_null($is_exist)) {
        return "-";
    } else {

        return $is_exist->name;
    }
}

function getUpazilaNameFromId($id)
{
    $is_exist = DB::table('upazilas')->where('id', $id)->first();
    if (is_null($is_exist)) {
        return "-";
    } else {

        return $is_exist->name;
    }
}

function getUnionNameFromId($id)
{
    $is_exist = DB::table('unions')->where('id', $id)->first();
    if (is_null($is_exist)) {
        return "-";
    } else {

        return $is_exist->en_name;
    }
}


function getBilingualcategoryName($category_type, $category)
{
    $category_name = "";
    if ($category_type == 1) {
        if (Config::get('app.locale') == "bn")
            $category_name = $category->parent_category_name_bn;
        else
            $category_name = $category->parent_category_name_en;
    } elseif ($category_type == 2) {
        if (Config::get('app.locale') == "bn")
            $category_name = $category->category_name_bn;
        else
            $category_name = $category->category_name_en;
    } elseif ($category_type == 3) {
        if (Config::get('app.locale') == "bn")
            $category_name = $category->sub_category_name_bn;
        else
            $category_name = $category->sub_category_name_en;
    }

    return $category_name;


}

function getBilingualWholeSaleCategoryName($category_type, $category)
{
    $category_name = "Whole Sale";
    if ($category_type == 1) {
        if (Config::get('app.locale') == "bn")
            $category_name = $category->category_name_bn;
        else
            $category_name = $category->category_name_en;
    } elseif ($category_type == 3) {
        if (Config::get('app.locale') == "bn")
            $category_name = $category->sub_category_name_bn;
        else
            $category_name = $category->sub_category_name_en;
    }

    return $category_name;


}

function getQrCode()
{
    $length = 1;

    $randomletter = "FB-" . $randomletter = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);;
    return $qr_code = strtoupper($randomletter) . date('is');
}

function getOtp()
{

    return rand(1000, 9999);
}

function getProductImage($id)
{
    $productImage = ProductImage::where('product_id', $id)->get();
    return $productImage;
}

function getApiErrorResponse($code, $message, $data)
{
    return $data = [
        'status_code' => $code,
        'custom_status_code' => $code,
        'message' => $message,
        'data' => $data
    ];
}

function getApiResponse($code, $message, $data)
{
    return $data = [
        'status_code' => $code,
        'custom_status_code' => $code,
        'message' => $message,
        'data' => $data
    ];
}

function getFormattedProductName($product_title)
{
    return str_replace("'", '"', $product_title);
}


function getSliderSections()
{
    return [
        '1' => 'Slider (730*510)',
        '2' => 'Secondary Slider (330*245)',
        '3' => 'Full Banner (1366*200)',
        '4' => 'Half banner (680*180)',
    ];
}

function getSectionName($id)
{
    $list = getSliderSections();
    return $list[$id];
}

function getSectionValueFromId($id)
{
    $status_array = getSections();
    return $status_array[$id];
}

function getAllCategories()
{
    $datas = ParentCategory::limit(5)->get();
    foreach ($datas as $item) {
        $sub_categories = $item->categories = ProductCategory::where('parent_category_id', $item->parent_category_id)->get();
        foreach ($sub_categories as $sub_category) {
            $sub_category->sub_categories = SubCategory::where('category_id', $sub_category->category_id)->get();
        }
    }
    return $datas;
}

function getInvoice()
{
    return time() . rand(1, 5);
}

function getExpireLimit()
{
    return 120;
}

function validatePhoneNumber($phone)
{
    if ($phone == null) {
        return 0;
    }
    $pattern = "/^(?:\+88|01)?(?:\d{11}|\d{13})$/";
    if (preg_match($pattern, $phone)) {
        return 1;
    };
}

function getWholeSaleStartFromPrice($id)
{
    if ($id == null) {
        return 0;
    }
    $is_exist = \App\WholeSalePriceRange::where('whole_sales_product_id', $id)->orderBy('id', 'DESC')->first();
    if (is_null($is_exist)) {
        return "-";
    }
    return $is_exist->price;
}

function getWholeSaleMaxFromPrice($id)
{
    if ($id == null) {
        return 0;
    }
    $is_exist = \App\WholeSalePriceRange::where('whole_sales_product_id', $id)->orderBy('id', 'ASC')->first();
    if (is_null($is_exist)) {
        return "-";
    }
    return $is_exist->price;
}

function getAddressNameFromId($id)
{
    if ($id == null) {
        return "Other";
    }
    $status_array = array(
        '1' => 'Home',
        '2' => 'Office',
        '3' => 'Other'
    );
    return $status_array[$id];
}

function getTotalDeliveryCharge()
{

    return 50;
}

function getTotalDeliveryChargeFromQnt()
{
    $total_delivery_charge = 0;
    $total_price = 0;
    $i = 0;
    foreach (Cart::content() as $item) {

        if ($item->options['product_type'] == "whole_sale") {

            if ($i == 0) {
                $total_delivery_charge = DeliveryCharge::first()->delivery_charge;
            }

            $total_price = $total_price + $item->price;
        } else {
            $qty = $item->qty;
            $delivery_charge = $item->options['delivery_charge'];
            $deliverable_quantity = $item->options['deliverable_quantity'];
            $extra_delivery_charge = $item->options['extra_delivery_charge'];
            $total_price = $total_price + ($item->price * $item->qt);
            if ($item->qty > $deliverable_quantity) {
                $total_delivery_charge = $total_delivery_charge + $delivery_charge + (($qty - $deliverable_quantity) * $extra_delivery_charge);
            } else {
                $total_delivery_charge = $total_delivery_charge + $delivery_charge;
            }
        }
        $i++;
    }
    return $total_delivery_charge;
}


function getPriceForWholeSale($product_id, $product_quantity)
{

    $is_exist = \App\WholeSalePriceRange::where('whole_sales_product_id', $product_id)
        ->where('min_quantity', '<=', $product_quantity)
        ->where('max_quantity', '>=', $product_quantity)
        ->first();
    if (is_null($is_exist)) {
        return 0;
    }

    return $is_exist->price;
}

function getDeliveryDate()
{
    $createdAt = Carbon::parse(\Carbon\Carbon::now()->addDays(4));

    return $createdAt->format('M d Y');
}

function getDateFormat($date)
{
    $createdAt = Carbon::parse($date);

    return $createdAt->format('d M, Y h:i A');
}

function getDeliveryStatus($id)
{
    $status = [
        'Pending',
        'Accepted',//Merchant
        'Ready For Pickup',//Merchant
        'On The Way',
        'Delivered',
        'Returned',
        'Cancelled',//6/ Merchant
        'Received By Merchant',//Merchant
    ];
    if (count($status) < $id) {
        return "-";
    }

    return $status[$id];
}

function getBrandName($id)
{
    $is_exist = \App\Brand::where('brand_id', $id)->first();
    if (is_null($is_exist)) {
        return "-";
    }

    return $is_exist->brand_name;
}

function getCommissionRate($id)
{
    $is_exist = \App\Shop::where('shop_id', $id)->first();
    if (is_null($is_exist)) {
        return 0;
    }
    return $is_exist->commission_rate;
}

function getDeliveryChargeText()
{
    return "Delivery Charge For max Quantity For this Product";
}

function getDeliverableQuantityText()
{
    return "Max Product Quantity For above Delivery Charge";
}

function getExtraDeliveryChargeText()
{
    return "Extra Delivery Charge ";
}


function getYoutubeVideoLink($link)
{
    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $matches);
    if ($matches != null) {
        $video = "https://www.youtube.com/embed/" . $matches[0];
    } else {
        $video = "";
    }

    return $video;
}

function getShopVoucherFromId($id)
{
    return \App\Voucher::where('shop_id', $id)->get();
}


//SMS API
function getFromForApi()
{
    return "Martvenue";
}

function getCategoryIdFromName($type, $category_name)
{
    if ($type == 1) {
        return $category = ParentCategory::where('parent_category_name_en', 'LIKE', '%' . $category_name . "%")->pluck('parent_category_id');

    } elseif ($type == 2) {
        return $category = ProductCategory::where('category_name_en', 'LIKE', '%' . $category_name . "%")->pluck('category_id');

    } else {
        return $category = SubCategory::where('sub_category_name_en', 'LIKE', '%' . $category_name . "%")->pluck('sub_category_id');

    }

}

function getEmail()
{
    return "info@firebox.com.bd";
}

function getPhone()
{
    return "+88 01303-218613";
}


/*https://github.com/devfaysal/laravel-bangladesh-geocode*/
//https://stackoverflow.com/questions/28290332/best-practices-for-custom-helpers-in-laravel-5
//https://stackoverflow.com/questions/40358510/resize-image-in-laravel-5-2
//ttps://stackoverflow.com/questions/52851208/laravel-passport-multiple-authentication-using-guards
?>
