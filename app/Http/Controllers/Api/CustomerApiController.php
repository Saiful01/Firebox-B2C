<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Coupon;
use App\Customer;
use App\CustomerAddress;
use App\CustomerNotification;
use App\Http\Controllers\Controller;
use App\Order;
use App\OrderItem;
use App\OrderPayment;
use App\OrderStatus;
use App\ParentCategory;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\ProductReview;
use App\PromotionalSlider;
use App\Slider;
use App\SubCategory;
use App\Voucher;
use App\WholeSale;
use App\WholeSaleCategory;
use App\WholeSalePriceRange;
use App\WholeSaleProductImage;
use App\WholesSaleSubCategory;
use Carbon\Carbon;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;

class CustomerApiController extends Controller
{

    public function homeData(Request $request)
    {
        $message = "Successfully Retrieved";
        $status_code = 200;
        /* $validator = Validator::make($request->all(), [
             "customer_phone" => 'required|unique:customers',
         ]);
         if ($validator->fails()) {
             return getApiErrorResponse(400, "Validation failed", $request->all());
         }*/


        $sliders = Slider::limit(3)
            ->where('publish_status', true)
            ->select('slider_id',
                'slider_image',
                'slider_title',
                'slider_url'
            )
            ->get();

        $products = Product::select(
            'product_id'
            , 'product_name'
            , 'product_slug'
            , 'qr_code'
            , 'stock'
            , 'regular_price'
            , 'selling_price'
            , 'discount_rate'
            , 'stock_status'
            , 'length'
            , 'width'
            , 'height'
            , 'length_class'
            , 'weight'
            , 'weight_class'
            , 'brand_id'
            , 'product_size'
            , 'product_color'
            , 'featured_image'
            , 'image'
            , 'is_featured'
            , 'product_type'
            , 'publish_status'
            , 'minimum_order_quantity'
            , 'meta_title'
            , 'meta_description'
            , 'meta_keywords'
            , 'product_tags'
            , 'shop_id'
            , 'parent_category_id'
            , 'category_id'
            , 'sub_category_id'
            , 'video'

            , 'delivery_charge'
            , 'deliverable_quantity'
            , 'extra_delivery_charge'
            , 'is_active')
            ->get();
        foreach ($products as $product) {
            $product->product_size = [];
            $product->product_color = [];
        }


        $whole_sale = WholeSaleCategory::get();//TODO::
        $categories = ParentCategory::get();//TODO::


        $new_arrivals = $products;//TODO::
        $hot_deals = $products;//TODO::
        $gadgets = $products;//TODO::
        $popular_products = $products;//TODO::


        $brands = Brand::get();//TODO::
        foreach ($brands as $item) {
            if ($item->brand_image == null) {
                $item->brand_image = "/images/category/1.jpg";
            }
        }


        $half_slider = PromotionalSlider::where('section_id', 3)->limit(2)->get();
        $full_slider = PromotionalSlider::where('section_id', 2)->limit(1)->get();


        return $data = [
            'status_code' => 200,
            'custom_status_code' => 200,
            'message' => $message,
            'top_category_count' => 3,
            'sliders' => $sliders,
            'top_categories' => $categories,
            'new_arrivals' => $new_arrivals,
            'hot_deals' => $hot_deals,
            'full_slider' => $full_slider,
            'whole_sale' => $whole_sale,
            'gadgets' => $gadgets,
            'half_slider' => $half_slider,
            'categories' => $categories,
            'brands' => $brands,
            'popular_products' => $popular_products

        ];

    }

    public function filteredProducts(Request $request)
    {


        //// filter /////
        /*  private int is_discounted;
            private int is_low_to_high_price;
            private int is_high_to_lowprice;
            private int min_price;
            private int max_price;

            //// group wise ////
            private String shop_id;
            private String brand_id;
            private String product_sub_category_id;
            private String product_child_category_id;
            private String product_category_id;
            private String whole_sale_category_id;


            //// view all //////
            private int is_new_arrivals;
            private int is_hot_deals;
            private int is_gadgets;
            private int is_discounted_product;
            private int is_popular;
            private int is_offer;



            private String search_query;*/


        //return$request->all();
        $status_code = 200;
        $message = "Successfully Retrieved";

        $query = Product::orderBy('created_at', 'DESC');

        if ($request['product_category_id'] > 0) {
            $query->where('category_id', $request['product_category_id']);
        }

        if ($request['parent_category_id'] > 0) {
            $query->where('parent_category_id', $request['parent_category_id']);
        }

        if ($request['product_sub_category_id'] > 0) {
            $query->where('sub_category_id', $request['product_sub_category_id']);
        }
        if ($request['is_new_arrivals'] > 0) {
            $query->limit(15);//TODO://
        }

        if ($request['is_hot_deals'] > 0) {
            //TODO://
        }

        if ($request['is_gadgets'] > 0) {
            //TODO://
        }
        if ($request['is_discounted_product'] > 0) {
            //TODO://
        }
        if ($request['search_query'] != null) {
            $query->where('product_name', 'LIKE', '%' . $request['search_query'] . '%');
        }
        if ($request['shop_id'] != null) {
            $query->where('shop_id', $request['shop_id'] );
        }

        $products = $query
            ->select(
                'product_id'
                , 'product_name'
                , 'product_slug'
                , 'qr_code'
                , 'stock'
                , 'regular_price'
                , 'selling_price'
                , 'discount_rate'
                , 'stock_status'
                , 'length'
                , 'width'
                , 'height'
                , 'length_class'
                , 'weight'
                , 'weight_class'
                , 'brand_id'
                , 'product_size'
                , 'product_color'
                , 'featured_image'
                , 'image'
                , 'is_featured'
                , 'product_type'
                , 'publish_status'
                , 'minimum_order_quantity'
                , 'meta_title'
                , 'meta_description'
                , 'meta_keywords'
                , 'product_tags'
                , 'shop_id'
                , 'parent_category_id'
                , 'category_id'
                , 'sub_category_id'
                , 'video'

                , 'delivery_charge'
                , 'deliverable_quantity'
                , 'extra_delivery_charge'
                , 'is_active')
            ->get();


        foreach ($products as $product) {
            $product->product_size = [];
            $product->product_color = [];
        }


        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'access_token' => "",
            'data' => $products
        ];

    }

    public function categories(Request $request)
    {

        $status_code = 200;
        $message = "Successfully Retrieved";

        $datas = ParentCategory::get();
        foreach ($datas as $item) {
            $sub_categories = $item->categories = ProductCategory::where('parent_category_id', $item->parent_category_id)->get();
            foreach ($sub_categories as $sub_category) {
                $sub_category->sub_categories = SubCategory::where('category_id', $sub_category->category_id)->get();
            }
        }

        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'access_token' => "",
            'data' => $datas
        ];

    }

    public function productsDetails(Request $request)
    {

        //return $request['customer_id'];
        $status_code = 200;
        $message = "Successfully Retrieved";

        $product_id = $request['product_id'];
        $related_products = Product::join('shops', 'shops.shop_id', '=', 'products.shop_id')->orderBy('product_id', 'DESC')->where('publish_status', true)->get();
        $product = Product::leftjoin('product_categories', 'product_categories.category_id', '=', 'products.category_id')
            ->leftjoin('shops', 'shops.shop_id', '=', 'products.shop_id')
            ->where('product_id', $product_id)
            ->first();


        $sizes = [];


        if ($product->product_size != null and $product->product_size != "null") {
            foreach (json_decode($product->product_size) as $item) {
                $sizes[] = array(
                    "id" => $item,
                    "name" => getSizeFromId($item),
                );
            }
        }

        $product->product_size = $sizes;

        $colors = [];
        if ($product->product_color != null and $product->product_color != "null") {
            foreach (json_decode($product->product_color) as $item) {
                $colors[] = array(
                    "id" => $item,
                    "name" => getColorFromId($item),
                );
            }
        }

        $product->product_color = $colors;

        $product->product_rating = 5;
        $product->shop_rating = 5;
        $product->stock = 30;
        $product->stock_status = getStockStatusValueFromId($product->stock_status);

        $images = ProductImage::where('product_id', $product_id)->get();

        $reviews = ProductReview::get();


        foreach ($related_products as $item) {
            $item->product_size = [];
            $item->product_color = [];
        }


        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'access_token' => "",
            'data' => $product,
            'images' => $images,
            'related_products' => $related_products,
            'reviews' => $reviews,
        ];

    }

    public function vouchers(Request $request)
    {
        $status_code = 200;
        $message = "Successfully Retrieved";

        $data = Voucher::where('shop_id', $request['shop_id'])->get();
        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'access_token' => "",
            'data' => $data
        ];
    }

    public function getAddress(Request $request)
    {
        $status_code = 200;
        $message = "Successfully Retrieved";

        $data = CustomerAddress::where('customer_id', $request['customer_id'])->get();
        foreach ($data as $item) {

            $item->division = ['id' => $item->division_id, 'name' => getDivisionNameFromId($item->division_id)];
            $item->district = ['id' => $item->district_id, 'name' => getDistrictNameFromId($item->district_id)];
            $item->upozila = ['id' => $item->upazila_id, 'name' => getUpazilaNameFromId($item->upazila_id)];
            $item->type = ['id' => $item->customer_address_type, 'name' => "Home"];//TODO:://
            /* $item->type = ['id' => $item->customer_address_type, 'name' => getAddressNameFromId($item->customer_address_type)];*/
        }

        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'access_token' => "",
            'data' => $data
        ];
    }

    public function saveAddress(Request $request)
    {

        //return $request->all();
        $status_code = 200;
        $message = "Successfully Inserted";
        if ($request['api_from'] == "android") {
            $customer_id = $request['user_id'];

            $address = $request['address'];
            $customer_array = [
                'customer_id' => $customer_id,
                'customer_address' => $address['customer_address'],
                'division_id' => $address['division']['id'],
                'district_id' => $address['district']['id'],
                'upazila_id' => $address['upozila']['id'],
                'customer_address_type' => $address['type']['id'],
            ];
        } else {
            $customer_id = $request['customer_id'];
            $customer_array = [
                'customer_id' => $customer_id,
                'customer_address' => $request['customer_address'],
                'division_id' => $request['division_id'],
                'district_id' => $request['district_id'],
                'upazila_id' => $request['upazila_id'],
                'customer_address_type' => $request['customer_address_type'],
            ];
        }


        try {
            CustomerAddress::create($customer_array);
        } catch (\Exception $exception) {
            $status_code = 400;
            $message = $exception->getMessage();
        }
        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'access_token' => "",
            'data' => []
        ];
    }

    public function orderSave(Request $request)
    {

        if ($request['api_from'] == "android") {

            return $this->saveAndroidOrderData($request->all());
        }

        return $data = [
            'status_code' => 200,
            'custom_status_code' => 200,
            'message' => "Saved",
            'data' => $request->all()
        ];

        //return $status_code = 200;
        $message = "Successfully Retrieved-IOS";

        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'data' => $request->all()
        ];

    }

    public function getOrders(Request $request)
    {
        $status_code = 200;
        $message = "Successfully Retrieved";

        //return $request['customer_id'];
        $orders = Order::where('customer_id', $request['customer_id'])->get();
        foreach ($orders as $item) {
            $item->order_date = getDateFormat($item->created_at);
            $item->details = OrderItem::where('order_invoice', $item->order_invoice)
                ->join('products', 'products.product_id', '=', 'order_items.product_id')
                ->select('products.product_name', 'products.featured_image as product_image', 'order_items.*')
                ->get();
            foreach ($item->details as $product) {
                $product->size = getSizeFromId($product->size);
                $product->color = getColorFromId($product->color);
                $product->delivery_status_code = $product->delivery_status;
                $status_list = OrderStatus::where('order_item_id', $product->order_item_id)->get();
                foreach ($status_list as $status) {
                    $status->delivery_status = getDeliveryStatus($status->delivery_status);
                    $status->delivery_date = getDateFormat($status->created_at);
                }
                $product->delivery_statuses = $status_list;
            }
            $item->payment = OrderPayment::where('tran_id', $item->order_invoice)->get();
        }

        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'data' => $orders
        ];
    }

    public function orderDetails(Request $request)
    {
        $status_code = 200;
        $message = "Successfully Retrieved";

        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'data' => $request->all()
        ];
    }

    public function coupon(Request $request)
    {
        $status_code = 200;
        $message = "Successfully Retrieved";
        $discount = 0;
        $coupon = Coupon::where('coupon_code', $request['coupon_code'])->where('active_status', 1)
            /*->whereDate('expire_date', Carbon::now())*/
            ->first();
        if (is_null($coupon)) {
            $status_code = 400;
            $message = "Either coupon is invalid or Expired";
        } else {
            $discount = $coupon->discount_rate;
        }
        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'discount' => $discount,
            'data' => $request->all()
        ];
    }

    public function getDivisionDistrictUpazila(Request $request)
    {
        $division = Division::get();
        $district = District::get();
        $upazila = Upazila::get();
        return $data = [
            'status_code' => 200,
            'custom_status_code' => 200,
            'message' => "Success",
            'division' => $division,
            'district' => $district,
            'upazila' => $upazila,
            'data' => $request->all()
        ];
    }

    public function getDivisionDistrictUpazilaJson(Request $request)
    {
        $division = Division::get();
        foreach ($division as $item) {
            $district = District::where('division_id', $item->id)->get();
            $item->district = $district;
            foreach ($district as $r) {
                $r->upazila = Upazila::where('district_id', $r->id)->get();

                $status_code = 200;
                $message = "Successfully Retrieved";
                $discount = 0;
                $divisions = Division::get();
                foreach ($divisions as $item) {
                    $districts = District::where('division_id', $item->id)->get();
                    $item->district = $districts;
                    foreach ($districts as $district) {
                        $upazilas = Upazila::where('district_id', $district->id)->get();
                        $district->upazila = $upazilas;

                    }
                }

                return $data = [
                    'status_code' => 200,
                    'custom_status_code' => 200,
                    'message' => "Success",
                    'data' => $division
                ];
            }
        }
    }

    public function filteredWholeSaleProducts(Request $request)
    {


        $whole_sale_category_id = $request['whole_sale_category_id'];
        $whole_sale_sub_category_id = $request['whole_sale_sub_category_id'];
        $shop_id = $request['shop_id'];

        $query = WholeSale::where('is_active', true)->orderBy('created_at', 'DESC');
        if ($whole_sale_category_id != null) {
            $query->where('category_id', $whole_sale_category_id);
        }
        if ($whole_sale_sub_category_id != null) {
            $query->where('sub_category_id', $whole_sale_sub_category_id);
        }
        if ($shop_id != null) {
            $query->where('shop_id', $shop_id);
        }
        if ($request['search_query'] != null) {
            $query->where('product_name', 'LIKE', '%' . $request['search_query'] . '%');
        }
        $whole_sale_item = $query->get();

        foreach ($whole_sale_item as $product) {
            $product->max_price = getWholeSaleMaxFromPrice($product->whole_sales_product_id);
            $product->price = getWholeSaleStartFromPrice($product->whole_sales_product_id);

            $product->prices = [];


            $sizes = [];

            $product->product_size = $sizes;

            $colors = [];

            $product->product_color = $colors;

            $product->product_rating = rand(3, 5);
            $product->shop_rating = rand(3, 5);
            $product->stock = 30;
            $product->stock_status = getStockStatusValueFromId($product->stock_status);
        }

        return $data = [
            'status_code' => 200,
            'custom_status_code' => 200,
            'message' => "Success",
            'data' => $whole_sale_item
        ];
    }

    public function wholeSaleCategories(Request $request)
    {
        $whole_sale_category = WholeSaleCategory::all();
        foreach ($whole_sale_category as $item) {
            $item->whole_sale_sub_categories = WholesSaleSubCategory::where('category_id', $item->whole_sale_category_id)->get();
        }
        return $data = [
            'status_code' => 200,
            'custom_status_code' => 200,
            'message' => "Success",
            'data' => $whole_sale_category
        ];
    }

    public function wholeSalesProductDetails(Request $request)
    {
        $status_code = 200;
        $message = "Successfully Retrieved";

        $product_id = $request['product_id'];
        $related_products = WholeSale::leftJoin('shops', 'shops.shop_id', '=', 'whole_sales.shop_id')->orderBy('whole_sales_product_id', 'DESC')->where('publish_status', true)->get();
        $product = WholeSale::leftjoin('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id', '=', 'whole_sales.category_id')
            ->leftjoin('shops', 'shops.shop_id', '=', 'whole_sales.shop_id')
            ->where('whole_sales.whole_sales_product_id', $product_id)
            ->first();


        $product->max_price = getWholeSaleMaxFromPrice($product->whole_sales_product_id);
        $product->price = getWholeSaleStartFromPrice($product->whole_sales_product_id);

        $product->prices = WholeSalePriceRange::where('whole_sales_product_id', $product_id)->get();

        $product->max_delivery_quantity = 32;
        $product->delivery_charge = 150;
        $product->extra_charge = 2;

        $sizes = [];
        if ($product->product_size != null and $product->product_size != "null") {
            foreach (json_decode($product->product_size) as $item) {
                $sizes[] = array(
                    "id" => $item,
                    "name" => getSizeFromId($item),
                );
            }
        }
        $product->product_size = $sizes;

        $colors = [];
        if ($product->product_color != null and $product->product_color != "null") {
            foreach (json_decode($product->product_color) as $item) {
                $colors[] = array(
                    "id" => $item,
                    "name" => getColorFromId($item),
                );
            }
        }

        $product->product_color = $colors;

        $product->product_rating = rand(3, 5);
        $product->shop_rating = rand(3, 5);
        $product->stock = 30;
        $product->stock_status = getStockStatusValueFromId($product->stock_status);

        $images = WholeSaleProductImage::where('product_id', $product_id)->get();

        $reviews = ProductReview::get();


        foreach ($related_products as $item) {
            $item->product_size = [];
            $item->product_color = [];
            $item->max_price = getWholeSaleMaxFromPrice($item->whole_sales_product_id);
            $item->price = getWholeSaleStartFromPrice($item->whole_sales_product_id);
        }


        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'access_token' => "",
            'data' => $product,
            'images' => $images,
            'related_products' => $related_products,
            'reviews' => $reviews,
        ];

    }

    public function forgetPassword(Request $request)
    {

        return $data = [
            'status_code' => 200,
            'custom_status_code' => 200,
            'message' => "Success",
            'data' => [],
        ];
    }

    public function androidWriteReview(Request $request)
    {

        $is_whole_sale = false;
        $order = Order::where('order_invoice', $request['order_product']['order_invoice'])
            ->first();
        if (!is_null($order)) {
            $is_whole_sale = $order->is_whole_sale;

        }
        $review_array = [
            'score' => $request['rating'],
            'comment' => $request['review'],
            'product_id' => $request['order_product']['product_id'],
            'is_whole_sale' => $is_whole_sale,
            'customer_id' => $request['customer_id'],
        ];

        try {
            ProductReview::firstOrCreate($review_array);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return $data = [
            'status_code' => 200,
            'custom_status_code' => 200,
            'message' => "Success",
            'data' => $request->all(),
        ];
    }

    function saveAndroidOrderData($request)
    {

        //return $request;
        $checkout = $request['checkoutItem'];
        $checkoutCartsItems = $request['checkoutItem']['checkoutCartsItems'];
        $appliedVoucherList = $request['checkoutItem']['appliedVoucherList'];
        $address = $request['checkoutItem']['address'];
        $is_whole_sale = false;
        $order_invoice = getInvoice();
        $total_price = 0;
        $total_delivery_charge = 0;
        $coupon = $checkout['promo_discount'];
        $voucher = 0;


        //Address
        $customer_id = $request['customerModel']['customer_id'];
        $address_array = [
            'customer_id' => $customer_id,
            'customer_address' => $address['customer_address'],
            'division_id' => $address['division']['id'],
            'district_id' => $address['district']['id'],
            'upazila_id' => $address['upozila']['id'],
            'customer_address_type' => 1,
            /*  'customer_address_type' => $address['type']['id'],*/ //TODO::
        ];

        //Insert into Address
        try {

            $is_exist = CustomerAddress::where('customer_id', $customer_id)
                ->where('division_id', $address['division']['id'])
                ->where('district_id', $address['district']['id'])
                ->where('upazila_id', $address['upozila']['id'])
                ->first();
            if (is_null($is_exist)) {
                $address_id = CustomerAddress::insertGetId($address_array);
            } else {
                $address_id = $is_exist->id;
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        foreach ($checkoutCartsItems as $product) {
            if ($product['isProductType'] == false) {
                $is_whole_sale = true;
                $product_id = $product['whole_sale_product_id'];
            } else {
                $product_id = $product['product_id'];
            }

            $total_delivery_charge = $checkout['delivery_charges'];
            $total_price = $total_price + $product['price'];
            if (!isset($product['size_id'])) {
                $product['size_id'] = null;
            }
            if (!isset($product['color_id'])) {
                $product['color_id'] = null;
            }
            $order_array = [
                'product_id' => $product_id,
                'selling_price' => $product['price'],
                'quantity' => $product['quantity'],
                'order_invoice' => $order_invoice,
                'total_price' => $product['price'] * $product['quantity'],
                'size' => $product['size_id'],
                'color' => $product['color_id'],
                'shop_id' => $product['shop_id'],
                'commission_rate' => getCommissionRate($product['shop_id']),
                'delivery_charge' => 0,//TODO::
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            try {
                $order_item_id = OrderItem::insertGetId($order_array);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }
            $status_array = [
                'order_item_id' => $order_item_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            try {
                OrderStatus::create($status_array);
            } catch (\Exception $exception) {
                return $exception->getMessage();
            }

            $shop_array[] = $product['shop_id'];
        }

        $voucher_array = [];
        foreach ($checkout['appliedVoucherList'] as $voucher_item) {
            $voucher = $voucher + $voucher_item['vouchersModels']['discount'];
            $temp = [
                'shop_id' => $voucher_item['shop_id'],
                'discount' => $voucher_item['vouchersModels']['discount'],
                'voucher_id' => $voucher_item['vouchersModels']['voucher_id']
            ];
            if (!in_array($temp, $voucher_array)) {
                $voucher_array[] = $temp;
            }
        }


        $shop_array = array_unique($shop_array);
        $shop_array = array_values($shop_array);
        $shop_array = json_encode($shop_array);

        $voucher_array = json_encode($voucher_array);


        if ($checkout['payment_method'] == 1) {
            //Cash
            $payment_status = 0;
            $paid_amount = 0;
            $payment_type = "Cash";
        } else {
            $payment_status = 1;
            $paid_amount = $request['checkoutItem']['grand_Total_amount'];
            $payment_type = "Online";
        }

        $order_data = [
            'order_invoice' => $order_invoice,
            'total' => $request['checkoutItem']['total_amount'],
            'shipping_cost' => $request['checkoutItem']['delivery_charges'],
            /*'shipping_cost' => $total_delivery_charge,*/
            'sub_total' => $request['checkoutItem']['grand_Total_amount'],
            'coupon' => $checkout['promo_discount'],
            'coupon_code' => $checkout['promo_code'],
            'discount' => $voucher + $coupon,
            'paid_amount' => $paid_amount,
            'customer_id' => $request['customerModel']['customer_id'],
            'comment' => "",
            'delivery_address_id' => $address_id,
            'is_whole_sale' => $is_whole_sale,

            'payment_type' => $payment_type,
            'payment_status' => $payment_status,
            'shops' => $shop_array,
            'vouchers' => $voucher_array,
        ];


        try {
            Order::create($order_data);
            $customer = Customer::where('customer_id', $customer_id)->first();
            if ($checkout['payment_method'] == 1) {
                $message = "Dear " . $customer->customer_name . ", Thanks for placing your order " . $order_invoice . ". ";
            } else {
                $message = "Dear " . $customer->customer_name . ", Thanks for placing your order " . $order_invoice . ". Your order is now processing.";
            }

            sendsms($customer->customer_phone, $message);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        $status_code = 200;
        $message = "Successfully Order Saved";

        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'data' => []
        ];


    }

    public function notifications()
    {
        $status_code = 200;
        $notifications = CustomerNotification::get();
        foreach ($notifications as $notification) {
            $notification->date = $notification->created_at;
        }
        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => "Retrieved",
            'data' => $notifications
        ];

    }
}
