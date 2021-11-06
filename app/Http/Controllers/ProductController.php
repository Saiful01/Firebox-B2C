<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductImage;
use App\Shop;
use App\SubCategory;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{

    public function create()
    {

        $shop_id = null;
        if (Auth::user()->user_type != 1) {
            $shop = Shop::where('user_id', Auth::user()->id)->first();
            if (is_null($shop)) {
                return Redirect::to('/shop/create')->with('failed', "Add shop first");
            }

            $shop_id = $shop->shop_id;
        }


        return view('admin.product.create')
            ->with('shops', Shop::get())
            ->with('shop_id', $shop_id)
            ->with('categories', ProductCategory::get())
            ->with('sub_categories', SubCategory::get());
    }

    public function store(Request $request)
    {

        //return $request->all();
        unset($request['_token']);
        $validator = Validator::make($request->all(), [
            /*'shop_id' => 'required',*/
            'product_name' => 'required',
            'parent_category_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'discount_rate' => 'required',
            'regular_price' => 'required',
            'selling_price' => 'required',
            'qr_code' => 'required',
            'product_details' => 'required',
            'product_specification' => 'required',
            'featured' => 'required',
        ]);
        $request['shop_id'] = 1;

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
            $image_resize->resizeCanvas(1080, 1080);
            $image_resize->save(public_path('/images/product/' . $image_name));


            /*  $image_name = time() . '.' . $image->getClientOriginalExtension();
              $destinationPath = public_path('/images/product/');
              $image->move($destinationPath, $image_name);*/


            $request['featured_image'] = '/images/product/' . $image_name;

        }

        $i = 1;
        $product_image = [];
        $image_array = [];
        if ($request->hasFile('image')) {
            foreach ($request['image'] as $image) {

                $image_name = $i . time() . '.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resizeCanvas(1080, 1080);
                $image_resize->save(public_path('/images/product/' . $image_name));

                /* $destinationPath = public_path('/images/product/');
                 $image->move($destinationPath, $image_name);*/

                $product_image['image'] = "/images/product/" . $image_name;
                $image_array[] = $product_image;
                $i++;
            }
        }

        $request['created_at'] = Carbon::now();
        $request['updated_at'] = Carbon::now();
        $request['selling_price'] = ceil($request['selling_price']);
        $request['product_size'] = json_encode($request['product_size']);
        $request['product_color'] = json_encode($request['product_color']);

        //$request['product_color'] = json_encode($request['product_color']);
        // return $request->all();
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

    public function show(Request $request)
    {

        //   return Auth::user();

        $category_id = $request['category_id'];
        $shop_id = $request['shop_id'];
        $product = $request['product_name'];
        $code = $request['qr_code'];
        $query = Product::join('product_categories', 'product_categories.category_id', '=', 'products.category_id')
            ->join('shops', 'shops.shop_id', '=', 'products.shop_id')
            ->select('products.*', 'shops.shop_name', 'product_categories.category_name_en')
            ->orderBY('products.created_at', "DESC");

        if ($product != null) {
            $query->where('products.product_name', 'like', "%$request->product_name%");
        }
      if ($code != null) {
            $query->where('products.qr_code', $code);
        }

        if ($category_id != null) {
            $query->where('products.category_id', $request['category_id']);
        }
        if ($shop_id != null) {
            $query->where('products.shop_id', $request['shop_id']);
        }


        $results = $query->get();


        return view('admin.product.view')
            ->with('results', $results);
    }

    public function productDetails($id)
    {
        $result = Product::join('product_categories', 'product_categories.category_id', '=', 'products.category_id')
            ->join('sub_categories', 'sub_categories.sub_category_id', '=', 'products.sub_category_id')
            ->join('parent_categories', 'parent_categories.parent_category_id', '=', 'products.parent_category_id')
            ->join('shops', 'shops.shop_id', '=', 'products.shop_id')
            ->select('products.*', 'product_categories.category_name_en',
                'sub_categories.sub_category_name_en', 'parent_categories.parent_category_name_en', 'shops.*')
            ->where('product_id', $id)->first();
        $images = ProductImage::where('product_id', $id)->get();
//        return $result;
        return view('admin.product.details')
            ->with('result', $result)
            ->with('images', $images)
            ->with('categories', ProductCategory::get())
            ->with('shops', Shop::get());
    }

    public function subcategory($id)
    {
        $result = SubCategory::where('category_id', $id)->first();

        return view('admin.product.details')
            ->with('result', $result);
    }

    public function featured($id)
    {
        try {
            Product::where('product_id', $id)->update([
                'is_featured' => true
            ]);
            return back()->with('success', "Successfully Featured");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function unfeatured($id)
    {
        try {
            Product::where('product_id', $id)->update([
                'is_featured' => false
            ]);
            return back()->with('success', "Successfully UnFeatured");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function active($id)
    {


        try {
            Product::where('product_id', $id)->update([
                'is_active' => true
            ]);
            return back()->with('success', "successfully active");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }


    }

    public function inactive($id)
    {

        try {
            Product::where('product_id', $id)->update([
                'is_active' => false
            ]);
            return back()->with('success', "successfully Inactive");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }


    }


    public function edit($id)
    {
        $shop_id = null;
        if (Auth::user()->user_type != 1) {
            $shop = Shop::where('user_id', Auth::user()->id)->first();
            if (is_null($shop)) {
                return Redirect::to('/shop/create')->with('failed', "Add shop first");
            }

            $shop_id = $shop->shop_id;
        }

        $result = Product::join('product_categories', 'product_categories.category_id', '=', 'products.category_id')
            ->leftJoin('sub_categories', 'sub_categories.sub_category_id', '=', 'products.sub_category_id')
            /* ->leftJoin('users', 'users.id', '=', 'products.owner_id')*/
            ->leftJoin('shops', 'shops.shop_id', '=', 'products.shop_id')
            ->where('product_id', $id)->first();

        return view('admin.product.edit')
            ->with('result', $result)
            ->with('categories', ProductCategory::get())
            ->with('sub_categories', SubCategory::get())
            ->with('shops', Shop::get())
            ->with('shop_id', $shop_id);
    }


    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            /*  'shop_id' => 'required',*/
            'product_name' => 'required',
            'parent_category_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'sub_category_id' => 'required|numeric',
            'discount_rate' => 'required',
            'regular_price' => 'required',
            'selling_price' => 'required',
            'qr_code' => 'required',
            'product_details' => 'required',
            'product_specification' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('failed', "There is an error. Please input all field properly.");
        }

        //return $request->all();

        unset($request['_token']); //Remove Token

        if ($request['video'] != null) {
            $request['video'] = getYoutubeVideoLink($request['video']);
        }
        if ($request->hasFile('featured')) {
            $image = $request->file('featured');
            $image_name = time() . '.' . $image->getClientOriginalExtension();

            /* $destinationPath = public_path('/images/product/');
             $image->move($destinationPath, $image_name);*/

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resizeCanvas(1080, 1080);
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
                $image_resize->resizeCanvas(1080, 1080);
                $image_resize->save(public_path('/images/product/' . $featured_image));
//                $destinationPath = public_path('/images/product/');
//                $image->move($destinationPath, $featured_image);

                $product_image['image'] = "/images/product/" . $featured_image;
                $image_array[] = $product_image;
                if ($i = 1) {
                    $product_image['image'] = "/images/product/" . $featured_image;
                    $image_array[] = $product_image;
                }
                $i++;

            }
        }


        $request['created_at'] = Carbon::now();
        $request['updated_at'] = Carbon::now();
        $request['product_size'] = json_encode($request['product_size']);
        $request['product_color'] = json_encode($request['product_color']);
        $request['selling_price'] = ceil($request['selling_price']);


        //$request['product_color'] = json_encode($request['product_color']);
        try {
            Product::where('product_id', $request['product_id'])->update($request->except(['image', 'featured', 'certificate', 'video_file']));

            if (count($image_array) > 0) {
                $old_images = ProductImage::where('product_id', $request['product_id'])->get();
                //Delete Old Image
                try {
                    ProductImage::where('product_id', $request['product_id'])->delete();
                } catch (\Exception $e) {
                    return $e->getMessage();
                }

                foreach ($old_images as $old_image) {
                    if (File::exists(public_path($old_image->image))) {
                        File::delete(public_path($old_image->image));
                    }
                }
            }

            foreach ($image_array as $image) {
                ProductImage::create([
                    'product_id' => $request['product_id'],
                    'image' => $image['image']
                ]);
            }
            return \redirect('/admin/product/show')->with('success', "Successfully Product Update");
        } catch (Exception $exception) {
            return $exception->getMessage();
            return back()->with('failed', $exception->getMessage());
        }

    }


    public function destroy($id)
    {
        try {
            $old_images = ProductImage::where('product_id', $id)->get();
            ProductImage::where('product_id', $id)->delete();
            foreach ($old_images as $old_image) {
                if (File::exists(public_path($old_image->image))) {
                    File::delete(public_path($old_image->image));
                }
            }

            Product::where('product_id', $id)->delete();

            return back()->with('success', "Successfully Product Deleted");
        } catch (Exception $exception) {
            return $exception->getMessage();
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function search(Request $request)
    {

        /* $request->all();       $shop =null;
                $category = ProductCategory::all();

                if (Auth::user()->user_type == 1) {
                       $shop = Shop::all();
                       $query = Product::join('product_categories','product_categories.category_id','=','products.category_id')
                                 ->join('shops','shops.shop_id','=','products.shop_id');
                }
               else{
                    $shop = Session::get('shop_id');
                    $query = Product::join('product_categories','product_categories.category_id','=','products.category_id')
                   ->join('shops','shops.shop_id','=','products.shop_id')
                   ->where('shops.shop_id',$shop);
                }



               if($request['product_name']!=null){
                    $query->where('products.product_name','like',"%$request->product_name%");
                }

                if($request['category_id']!=null){
                    $query->where('products.category_id',$request['category_id']);
                }
                if($request['shop_id']!=null){
                    $query->where('products.shop_id',$request['shop_id']);
              }

              $results=$query->get();








         return view('admin.product.view')->with('shops', $shop)
         ->with('categorys', $category)
         ->with('results', $results);*/

    }
}
