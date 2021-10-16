<?php

namespace App\Http\Controllers;

use App\MerchantPayment;
use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\Shop;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class MerchantProductController extends Controller
{
    public function create()
    {
        /* return Auth::user();*/
        return view('merchant.product.create');
    }

    public function show(Request $request)
    {
        $category_id = $request['category_id'];
        $product = $request['product_name'];
        $query = Product::join('product_categories', 'product_categories.category_id', '=', 'products.category_id')
            ->join('shops', 'shops.shop_id', '=', 'products.shop_id')
            ->where('products.shop_id', Session::get('shop_id'))
            ->select('products.*', 'shops.shop_name', 'product_categories.category_name_en')
            ->orderBY('products.created_at', "DESC");

        if ($product != null) {
            $query->where('products.product_name', 'like', "%$request->product_name%");
        }

        if ($category_id != null) {
            $query->where('products.category_id', $request['category_id']);
        }

        $results = $query->get();

        return view('merchant.product.view')->with('results', $results);
    }

    public function edit($id)
    {
        $result = Product::join('product_categories', 'product_categories.category_id', '=', 'products.category_id')
            ->leftJoin('sub_categories', 'sub_categories.sub_category_id', '=', 'products.sub_category_id')
            ->leftJoin('shops', 'shops.shop_id', '=', 'products.shop_id')
            ->where('product_id', $id)->first();



        return view('merchant.product.edit')
            ->with('result', $result);
    }

    public function update(Request $request)
    {

        $request['shop_id'] = Session::get('shop_id');
        $request->validate([
            'product_name' => 'required',
            'regular_price' => 'required',
            'parent_category_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
        ]);

        if ($request['video'] != null) {
            $request['video'] = getYoutubeVideoLink($request['video']);
        }
        if ($request->hasFile('featured')) {
            $image = $request->file('featured');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resizeCanvas(1000, 1000);
            $image_resize->save(public_path('/images/product/' . $image_name));
            $request->request->add(['featured_image' => '/images/product/' . $image_name]);

        }
        $i = 1;
        $product_image = [];
        $image_array = [];
        if ($request->hasFile('image')) {
            foreach ($request['image'] as $image) {

                $featured_image = $i . time() . '.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resizeCanvas(1000, 1000);
                $image_resize->save(public_path('/images/product/' . $image_name));
                $product_image['image'] = "/images/product/" . $featured_image;
                $image_array[] = $product_image;
                if ($i = 1) {
                    $product_image['image'] = "/images/product/" . $featured_image;
                    $image_array[] = $product_image;
                }
                $i++;

            }
        }
        $request['is_active'] = false;
        $request['selling_price'] = ceil($request['selling_price']);
        $request['product_size'] = json_encode($request['product_size']);
        $request['product_color'] = json_encode($request['product_color']);


        try {
            Product::where('product_id', $request['product_id'])->update($request->except(['image', 'featured', '_token', 'certificate', 'video_file']));

            foreach ($image_array as $image) {
                ProductImage::create([
                    'product_id' => $request['product_id'],
                    'image' => $image['image']
                ]);
            }
            return \redirect('/merchant/product/show')->with('success', "Successfully Product Update");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }

    public function productDetails($id)
    {
        $result = Product::join('product_categories', 'product_categories.category_id', '=', 'products.category_id')
            ->join('sub_categories', 'sub_categories.sub_category_id', '=', 'products.sub_category_id')
            ->join('shops', 'shops.shop_id', '=', 'products.shop_id')
            ->select('products.*', 'shops.shop_name', 'product_categories.category_name_en')
            ->where('product_id', $id)->first();
        $images = ProductImage::where('product_id', $id)->get();
        return view('merchant.product.details')
            ->with('result', $result)
            ->with('images', $images)
            ->with('categories', ProductCategory::get())
            ->with('shops', Shop::get());
    }

    public function featured($id)
    {
        try {
            Product::where('whole_sales_product_id', $id)->update([
                'is_featured' => true
            ]);
            return back()->with('success', "Successfully Featured");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function paymentorderShow()
    {
        $results= MerchantPayment::join('shops', 'shops.shop_id', '=', 'merchant_payments.shop_id')
            ->where('merchant_payments.shop_id', Session::get("shop_id"))
            ->orderBy('merchant_payments.created_at', "DESC")
            ->select('merchant_payments.*', 'shops.shop_name')
            ->get();
        return view('merchant.payment.show')->with('results',$results);
    }

    public function store(Request $request)
    {
        unset($request['_token']);
        $validator = Validator::make($request->all(), [
            'shop_id' => 'required',
            'product_name' => 'required',
            'parent_category_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'discount_rate' => 'required',
            'regular_price' => 'required',
            'selling_price' => 'required',
            'qr_code' => 'required',
            'delivery_charge' => 'required',
            'deliverable_quantity' => 'required',
            'extra_delivery_charge' => 'required',
            'product_details' => 'required',
            'product_specification' => 'required',
            'featured' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('failed', "There is an error. Please input all field properly.");
        }
        /* Youtube Video Format*/
        if ($request['video'] != null) {
            $request['video'] = getYoutubeVideoLink($request['video']);
        }

        if ($request->hasFile('featured')) {
            $image = $request->file('featured');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resizeCanvas(1000, 1000);
            $image_resize->save(public_path('/images/product/' . $image_name));
            $request['featured_image'] = '/images/product/' . $image_name;

        }

        $i = 1;
        $product_image = [];
        $image_array = [];
        if ($request->hasFile('image')) {
            foreach ($request['image'] as $image) {

                $image_name = $i . time() . '.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resizeCanvas(1000, 1000);
                $image_resize->save(public_path('/images/product/' . $image_name));

                $product_image['image'] = "/images/product/" . $image_name;
                $image_array[] = $product_image;
                $i++;
            }
        }

        $request['created_at'] = Carbon::now();
        $request['is_active'] = false;
        $request['updated_at'] = Carbon::now();
        $request['selling_price'] = ceil($request['selling_price']);
        $request['product_size'] = json_encode($request['product_size']);
        $request['product_color'] = json_encode($request['product_color']);

        //$request['product_color'] = json_encode($request['product_color']);

        try {
            $product_id = Product::insertGetId($request->except(['image', 'featured']));
            foreach ($image_array as $image) {
                ProductImage::create([
                    'product_id' => $product_id,
                    'image' => $image['image']
                ]);
            }
            return back()->with('success', "Successfully Product Saved");
        } catch (Exception $exception) {
            //return $exception->getMessage();
            return back()->with('failed', "There is an error. Please input all field properly.");
            return back()->with('failed', $exception->getMessage());
        }
    }
}
