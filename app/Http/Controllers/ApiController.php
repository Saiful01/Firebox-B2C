<?php

namespace App\Http\Controllers;


use App\Coupon;
use App\Models\OtpVerification;
use App\Product;
use App\ProductCategory;
use App\SubCategory;
use App\WholeSale;
use App\WholesSaleSubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{

    public function getDivision()
    {
        $results = DB::table('divisions')->get();
        return [
            'status_code' => 200,
            'message' => "Successfully Retrived",
            'results' => $results
        ];

    }

    public function getDistrict(Request $request)
    {
        $division_id = $request['division_id'];
        $results = DB::table('districts')->where('division_id', $division_id)->get();
        return [
            'status_code' => 200,
            'message' => "Successfully Retrived",
            'results' => $results
        ];

    }

    public function getUpazila(Request $request)
    {
        $district_id = $request['district_id'];
        $results = DB::table('upazilas')->where('district_id', $district_id)->get();
        return [
            'status_code' => 200,
            'message' => "Successfully Retrived",
            'results' => $results
        ];
    }

    public function getUnion($id)
    {
        $results = DB::table('unions')->where('upazila_id', $id)->get();
        return [
            'status_code' => 200,
            'message' => "Successfully Retrived",
            'results' => $results
        ];
    }

    public function getCategories($id)
    {
        $results = ProductCategory::where('parent_category_id', $id)->get();
        return [
            'status_code' => 200,
            'message' => "Successfully Retrived",
            'results' => $results
        ];
    }

    public function getSubCategories($id)
    {
        $results = SubCategory::where('category_id', $id)->get();
        return [
            'status_code' => 200,
            'message' => "Successfully Retrived",
            'results' => $results
        ];
    }

    public function getProducts(Request $request)
    {
        //return $request['query'];

        $query = Product::join('product_categories', 'product_categories.category_id', '=', 'products.category_id');
        if ($request['type'] == 1) {
            $query->where('products.parent_category_id', $request['category_id']);
        } else if ($request['type'] == 2) {
            $query->where('products.category_id', $request['category_id']);
        } else if ($request['type'] == 3) {
            $query->where('products.sub_category_id', $request['category_id']);
        }

        if ($request['price_range']) {
            $query->where('products.selling_price', '<=', $request['price_range']);
        }

        if ($request['offer'] != 0) {
            $query->where('products.discount_rate', '>', 0);
        }

        if ($request['query'] != 1) {
            $query->where('products.product_name', 'like', '%' . $request['query'] . '%');
        }
        //Sort By
        if ($request['sort_by'] == "low_to_high") {
            $query->orderBy('products.selling_price', 'ASC');
        } else if ($request['sort_by'] == "high_to_low") {
            $query->orderBy('products.selling_price', 'DESC');
        } else if ($request['sort_by'] == "in_stock") {
            //$query->where('products.selling_price', '<=', $request['price_range']);
        } else {
            $query->orderBy('products.created_at', 'DESC');
        }
        $result = $query->where('products.is_active', true)->get();
        return [
            'status_code' => 200,
            'message' => "Successfully Retrived",
            'results' => $result
        ];
    }

    public function getShopProducts(Request $request)
    {
        $query = Product::where('shop_id', $request->shop_id);
        //Sort By
        if ($request['sort_by'] == "low_to_high") {
            $query->orderBy('products.selling_price', 'ASC');
        } else if ($request['sort_by'] == "high_to_low") {
            $query->orderBy('products.selling_price', 'DESC');
        } else if ($request['sort_by'] == "in_stock") {
            //$query->where('products.selling_price', '<=', $request['price_range']);
        } else {
            $query->orderBy('products.created_at', 'DESC');
        }
        $retail_product_list = $query->get();

        $query = WholeSale::where('shop_id', $request->shop_id)->where('is_active',true);
        $whole_sale_product_list = $query->get();
        foreach ($whole_sale_product_list as $res) {
            $res->price = getWholeSaleStartFromPrice($res->whole_sales_product_id);
        }
        return [
            'status_code' => 200,
            'message' => "Successfully Retrived",
            'retail_product_list' => $retail_product_list,
            'whole_sale_product_list' => $whole_sale_product_list
        ];
    }

    public function getWholeSaleProducts(Request $request)
    {

        //return
        //return Product::select('parent_category_id','category_id','sub_category_id')->get();
        $query = WholeSale::where('whole_sales.is_active', true);
        if ($request['type'] == 1) {
            $query->where('whole_sales.category_id', $request['category_id']);
        } elseif ($request['type'] == 2) {
            $query->where('whole_sales.sub_category_id', $request['category_id']);
        }

        if ($request['price_range']) {
            //$query->where('whole_sales.selling_price', '<=', $request['price_range']);
        }
        if ($request['query'] != 1) {
            $query->where('whole_sales.product_name', 'LIKE', '%' . $request['query'] . '%');
        }

        //Sort By
        if ($request['sort_by'] == "low_to_high") {
            //$query->orderBy('whole_sales.selling_price', 'ASC');
        } else if ($request['sort_by'] == "high_to_low") {
            // $query->orderBy('whole_sales.selling_price', 'DESC');
        } else if ($request['sort_by'] == "in_stock") {
            //$query->where('whole_sales.selling_price', '<=', $request['price_range']);
        } else {
            $query->orderBy('whole_sales.created_at', 'DESC');
        }

        $result = $query->where('is_active', true)->get();
        foreach ($result as $res) {
            $res->price = getWholeSaleStartFromPrice($res->whole_sales_product_id);
        }


        return [
            'status_code' => 200,
            'message' => "Successfully Retrieved",
            'results' => $result
        ];
    }

    public function couponValidate(Request $request)
    {

        Session::remove('promo');
        $is_exist = Coupon::where('coupon_code', $request['coupon_code'])
            ->where('expire_date', '>', Carbon::now())
            ->where('active_status', true)
            ->select(['coupon_code', 'discount_rate', 'max_discount'])
            ->first();
        if (is_null($is_exist)) {
            return [
                'status_code' => 400,
                'message' => "Coupon is Expired or invalid",
                'results' => []
            ];
        } else {
            Session::put('promo', $is_exist);
            return [
                'status_code' => 200,
                'message' => "Valid Coupon",
                'results' => $is_exist,
            ];
        }
    }

    public function getWholeSaleProductCategories($id)
    {
        $result = WholesSaleSubCategory::where('category_id', $id)->get();
        return [
            'status_code' => 200,
            'message' => "Valid Coupon",
            'results' => $result
        ];

    }


}
