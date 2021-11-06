<?php

namespace App\Http\Controllers;

use App\CustomerAddress;
use App\ParentCategory;
use App\Product;
use App\ProductCategory;
use App\ProductReview;
use App\PromotionalSlider;
use App\SubCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home()
    {
        $popular_categories = ParentCategory::limit(9)->get();
        foreach ($popular_categories as $item) {
            $sub_categories = $item->categories = ProductCategory::where('parent_category_id', $item->parent_category_id)->get();
            foreach ($sub_categories as $sub_category) {
                $sub_category->sub_categories = SubCategory::where('category_id', $sub_category->category_id)->get();
            }
        }

        $healthcare_products = Product::orderBy('products.updated_at', 'DESC')
            ->where('products.is_active', true)
            ->where('products.parent_category_id', getCategoryIdFromName(1, "Health, Beauty"))
            ->limit(10)
            ->get();
        $footwear_products = Product::orderBy('products.updated_at', 'DESC')
            ->where('products.is_active', true)
            ->where('products.parent_category_id', getCategoryIdFromName(1, "Footwear"))
            ->limit(10)
            ->get();
        $hobbies_products = Product::orderBy('products.updated_at', 'DESC')
            ->where('products.is_active', true)
            ->where('products.parent_category_id', getCategoryIdFromName(1, "Hobbies , Sports & Kids"))
            ->limit(10)
            ->get();
        $new_products = Product::orderBy('products.updated_at', 'DESC')
            ->where('products.is_active', true)
            ->limit(10)
            ->get();

        $featured_products = Product::orderBy('products.updated_at', 'DESC')
            ->where('products.is_active', true)
            ->where('products.is_featured', true)
            ->limit(8)
            ->get();
        $sliders=PromotionalSlider::where('section_id',1)->orderBy('created_at','DESC')->limit(3)->get();
        $secondary_slider=PromotionalSlider::where('section_id',2)->orderBy('created_at','DESC')->limit(2)->get();


        return view('common.home.index')
            ->with('new_products', $new_products)
            ->with('featured_products', $featured_products)
            ->with('healthcare_products', $healthcare_products)
            ->with('footwear_products', $footwear_products)
            ->with('hobbies_products', $hobbies_products)
            ->with('sliders', $sliders)
            ->with('secondary_slider', $secondary_slider);

    }


    public function details($id, $name)
    {

        $product = Product::where('product_id', $id)->first();
        if (is_null($product)) {
            return Redirect::to('/');
        }
        $images = [];
        $related_products = Product::limit(10)->get();
        $reviews= ProductReview::Join('customers', 'product_reviews.customer_id', '=', 'customers.customer_id')
          ->where('product_id', $id)->OrderBy('product_reviews.created_at', "DESC")->limit(4)->get();
        return view('common.product.details')
            ->with('product', $product)
            ->with('images', $images)
            ->with('reviews', $reviews)
            ->with('related_products', $related_products);
    }

    public function parentaCategoryProduct($id, $name)
    {
        $title = $name;
        $products = Product::where('parent_category_id', $id)->limit(50)->get();
        $categories = ProductCategory::where('is_active', true)->where('parent_category_id', $id)->limit(10)->get();

        foreach ($categories as $category) {
            $category->category_name = $category->category_name_en;
            $category->category_link = "/categories/" . $category->parent_category_id . "/" . getTitleToUrl($category->category_name_en);
            if ($category->featured_image != null) {
                $category->category_image = $category->featured_image;
            } else {
                $category->category_image = "/images/no_image.jpg";
            }
        }
        return view('common.product.all_product')
            ->with('products', $products)
            ->with('title', $title)
            ->with('categories', $categories);

    }

    public function categoryProduct($id, $name)
    {
        $title = $name;
        $products = Product::where('category_id', $id)->limit(50)->get();
        $categories = SubCategory::where('category_id', $id)->limit(10)->get();

        foreach ($categories as $category) {
            $category->category_name = $category->sub_category_name_en;
            $category->category_link = "/sub-category/" . $category->sub_category_id . "/" . getTitleToUrl($category->sub_category_name_en);
            if ($category->featured_image != null) {
                $category->category_image = $category->featured_image;
            } else {
                $category->category_image = "/images/no_image.jpg";
            }
        }

        return view('common.product.all_product')
            ->with('products', $products)
            ->with('title', $title)
            ->with('categories', $categories);


    }

    public function subCategoryProduct($id, $name)
    {
        $title = $name;
        $products = Product::where('sub_category_id', $id)->limit(50)->get();
        return view('common.category.index')
            ->with('products', $products)
            ->with('title', $title);
    }


    public function history()
    {
        return view('common.history.index');

    }

    public function shop()
    {
        $products = Product::/*limit(15)->*/ get();
        return view('common.shop.index')
            ->with('products', $products)
            ->with('category_id', 0);

    }

    public function failed()
    {
        $message = Session::get('failed');
        return view('common.404')->with('message', $message);
    }

    public function cart()
    {
        return view('common.order.cart');

    }

    public function checkout()
    {
        $address = [];
        if (Auth::guard('is_customer')->check()) {
            $address = CustomerAddress::where('customer_id', Auth::guard('is_customer')->user()->customer_id)->get();
        }
        //return $address;
        return view('common.cart.index')->with('address', $address);

    }


    public function search(Request $request)
    {

        $id = $request['category'];
        $search = $request['search'];
        $query = Product::where('product_name', 'LIKE', '%' . $search . '%');
        if ($id > 0) {
            $query->where('parent_category_id', $id);
        }
        //$products = Product::where('parent_category_id', $id)->where('product_name', 'LIKE','%'.$search.'%')->limit(25)->get();
        $products = $query->limit(25)->get();

        return view('common.search.index')
            ->with('search', $search)
            ->with('products', $products);
    }

    public function contact()
    {
        return view('common.extra.contact');
    }
    public function about()
    {
        return view('common.extra.about');
    }
    public function privacyPolicy()
    {
        return view('common.extra.privacy_policy');

    }

    public function termsCondition()
    {
        return view('common.extra.terms_condition');

    }

    public function refundPolicy()
    {
        return view('common.extra.refund_policy');
    }
}
