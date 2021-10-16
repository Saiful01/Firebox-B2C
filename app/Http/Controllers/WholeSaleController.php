<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\Shop;
use App\SubCategory;
use App\WholeSale;
use App\WholeSalePriceRange;
use App\WholeSaleProductImage;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;


class WholeSaleController extends Controller
{

    public function index()
    {
        $shop_id = null;
        if (Auth::user()->user_type != 1) {
            $shop = Shop::where('user_id', Auth::user()->id)->first();
            if (is_null($shop)) {
                return Redirect::to('/shop/create')->with('failed', "Add shop first");
            }
            $shop_id = $shop->shop_id;
        }
        return view('admin.whole_sales.create')
            ->with('shops', Shop::get())
            ->with('shop_id', $shop_id);

    }

    public function merchantIndex()
    {
        $shop_id = Shop::where('shop_id', \Illuminate\Support\Facades\Session::get('shop_id'))->first();

        return view('merchant.whole_sales.create')
            ->with('shops', Shop::get())
            ->with('shop_id', $shop_id);

    }


    public function store(Request $request)
    {
        //return $request->all();
        unset($request['_token']);
        $request['created_at'] = Carbon::now();
        $request['updated_at'] = Carbon::now();
        $request->validate([
            'shop_id' => 'required|numeric',
            'product_name' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'featured' => 'required',
        ]);
        if ($request['video'] != null) {
            $request['video'] = getYoutubeVideoLink($request['video']);
        }

        if ($request->hasFile('featured')) {
            $image = $request->file('featured');
            $image_name = "featured_".time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resizeCanvas(1000, 1000);
            $image_resize->save(public_path('/images/product/' . $image_name));
            $request['featured_image'] = '/images/product/' . $image_name;

        }


        $request['product_size'] = json_encode($request['product_size']);
        $request['product_color'] = json_encode($request['product_color']);


        try {
            $product_id = WholeSale::insertGetId($request->except(['image', 'featured', 'certificate', 'min_quantity', 'max_quantity', 'price']));
        } catch (Exception $exception) {
            //return $exception->getMessage();
            return back()->with('failed', $exception->getMessage());
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

        $i = 0;
        $price_range = array();
        foreach ($request['min_quantity'] as $price) {
            if ($price != null) {
                $price_range[] = [
                    'min_quantity' => $request['min_quantity'][$i],
                    'max_quantity' => $request['max_quantity'][$i],
                    'price' => $request['price'][$i],
                    'whole_sales_product_id' => $product_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            $i++;
        }

        try {
            WholeSalePriceRange::insert($price_range);
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
            //return $exception->getMessage();
        }

        foreach ($image_array as $image) {
            WholeSaleProductImage::create([
                'product_id' => $product_id,
                'image' => $image['image']
            ]);
        }


        return \redirect('/admin/whole-sale/product/show')->with('success', "Successfully Product Save");

    }

    public function MerchantStore(Request $request)
    {
        //return $request->all();
        unset($request['_token']);
        $request['created_at'] = Carbon::now();
        $request['updated_at'] = Carbon::now();
        $request->validate([
            'shop_id' => 'required|numeric',
            'product_name' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'featured' => 'required',
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
        $request['product_size'] = json_encode($request['product_size']);
        $request['product_color'] = json_encode($request['product_color']);
        $request['is_active'] = false;

        try {
            $product_id = WholeSale::insertGetId($request->except(['image', 'featured', 'certificate', 'min_quantity', 'max_quantity', 'price']));
        } catch (Exception $exception) {
            //return $exception->getMessage();
            return back()->with('failed', $exception->getMessage());
        }
        //Insert Price Range
        $i = 0;
        $price_range = array();
        foreach ($request['min_quantity'] as $price) {
            if ($price != null) {
                $price_range[] = [
                    'min_quantity' => $request['min_quantity'][$i],
                    'max_quantity' => $request['max_quantity'][$i],
                    'price' => $request['price'][$i],
                    'whole_sales_product_id' => $product_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            $i++;
        }

        try {
            WholeSalePriceRange::insert($price_range);
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
            //return $exception->getMessage();
        }

        foreach ($image_array as $image) {
            WholeSaleProductImage::create([
                'product_id' => $product_id,
                'image' => $image['image']
            ]);
        }
        return \redirect('/merchant/whole-sale/product/show')->with('success', "Successfully Product Save");

    }


    public function show(Request $request)
    {
        //return $request->all();

        $category_id = $request['category_id'];
        $shop_id = $request['shop_id'];
        $product = $request['product_name'];
        $query = WholeSale::join('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id', '=', 'whole_sales.category_id')
            ->leftJoin('shops', 'shops.shop_id', '=', 'whole_sales.shop_id')
            ->select('whole_sales.*', 'whole_sale_categories.category_name_en', 'whole_sale_categories.category_name_bn',  'shops.shop_name')
            ->orderBY('whole_sales.created_at', "DESC");

        if ($product != null) {
            $query->where('whole_sales.product_name', 'like', "%$request->product_name%");
        }

        if ($category_id != null) {
            $query->where('whole_sales.category_id', $request['category_id']);
        }
        if ($shop_id != null) {
            $query->where('whole_sales.shop_id', $request['shop_id']);
        }


        $results = $query->get();

        /*       if (Auth::user()->user_type == 1) {

                   $results = WholeSale::join('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id', '=', 'whole_sales.category_id')
                       ->leftJoin('shops', 'shops.shop_id', '=', 'whole_sales.shop_id')
                       ->orderBY('whole_sales.created_at', "DESC")->get();
                   $shop = Shop::all();

               } else {
                   $results = WholeSale::leftJoin('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id', '=', 'whole_sales.category_id')
                       ->leftJoin('shops', 'shops.shop_id', '=', 'whole_sales.shop_id')
                       ->where('whole_sales.shop_id',Session::get('shop_id'))
                       ->orderBY('whole_sales.created_at', "DESC")->get();

               }*/

        return view('admin.whole_sales.view')
            ->with('results', $results);
    }

    public function MerchantShow(Request $request)
    {
        //return $request->all();

        $category_id = $request['category_id'];
        $product = $request['product_name'];
        $query = WholeSale::join('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id', '=', 'whole_sales.category_id')
            ->leftJoin('shops', 'shops.shop_id', '=', 'whole_sales.shop_id')
            ->where('shops.shop_id', \Illuminate\Support\Facades\Session::get('shop_id'))
            ->select('whole_sales.*', 'whole_sale_categories.category_name_en', 'whole_sale_categories.category_name_bn',  'shops.shop_name')
            ->orderBY('whole_sales.created_at', "DESC");

        if ($product != null) {
            $query->where('whole_sales.product_name', 'like', "%$request->product_name%");
        }

        if ($category_id != null) {
            $query->where('whole_sales.category_id', $request['category_id']);
        }
        $results = $query->get();

        return view('merchant.whole_sales.view')
            ->with('results', $results);
    }

    public function productDetails($id)
    {

        $result = WholeSale::join('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id', '=', 'whole_sales.category_id')
            ->join('shops', 'shops.shop_id', '=', 'whole_sales.shop_id')
            ->join('wholes_sale_sub_categories', 'wholes_sale_sub_categories.whole_sale_sub_category_id', '=', 'whole_sales.sub_category_id')
            ->select('wholes_sale_sub_categories.sub_category_name_en', 'whole_sale_categories.category_name_en', 'whole_sales.*', 'shops.*')
            ->where('whole_sales.whole_sales_product_id', $id)->first();

        return view('admin.whole_sales.details')
            ->with('result', $result);
    }

    public function merchantProductDetails($id)
    {

        $result = WholeSale::join('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id', '=', 'whole_sales.category_id')
            ->join('shops', 'shops.shop_id', '=', 'whole_sales.shop_id')
            ->join('wholes_sale_sub_categories', 'wholes_sale_sub_categories.whole_sale_sub_category_id', '=', 'whole_sales.sub_category_id')
            ->select('wholes_sale_sub_categories.sub_category_name_en', 'whole_sale_categories.category_name_en', 'whole_sales.*', 'shops.*')
            ->where('whole_sales.whole_sales_product_id', $id)->first();
        $result->prices = WholeSalePriceRange::where('whole_sales_product_id', $id)->get();


        return view('merchant.whole_sales.details')
            ->with('result', $result);
    }

    public function featured($id)
    {
        try {
            WholeSale::where('whole_sales_product_id', $id)->update([
                'is_featured' => true
            ]);
            return back()->with('success', "Successfully Featured");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function merchantFeatured($id)
    {
        try {
            WholeSale::where('whole_sales_product_id', $id)->update([
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
            WholeSale::where('whole_sales_product_id', $id)->update([
                'is_featured' => false
            ]);
            return back()->with('success', "Successfully Featured");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function merchantUnfeatured($id)
    {
        try {
            WholeSale::where('whole_sales_product_id', $id)->update([
                'is_featured' => false
            ]);
            return back()->with('success', "Successfully Featured");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
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

        $result = WholeSale::leftJoin('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id', '=', 'whole_sales.category_id')
            ->leftJoin('sub_categories', 'sub_categories.sub_category_id', '=', 'whole_sales.sub_category_id')
            ->leftJoin('shops', 'shops.shop_id', '=', 'whole_sales.shop_id')
            ->where('whole_sales_product_id', $id)->first();
        $result->price_range = WholeSalePriceRange::where('whole_sales_product_id', $result->whole_sales_product_id)->get();
//      return $result;

        //  return$result;


        return view('admin.whole_sales.edit')
            ->with('result', $result)
            ->with('categories', ProductCategory::get())
            ->with('sub_categories', SubCategory::get())
            ->with('shops', Shop::get())
            ->with('shop_id', $shop_id);
    }

    public function MerchantEdit($id)
    {
        $shop_id = Shop::where('shop_id', \Illuminate\Support\Facades\Session::get('shop_id'))->first();
        $result = WholeSale::leftJoin('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id', '=', 'whole_sales.category_id')
            ->leftJoin('sub_categories', 'sub_categories.sub_category_id', '=', 'whole_sales.sub_category_id')
            ->leftJoin('shops', 'shops.shop_id', '=', 'whole_sales.shop_id')
            ->where('whole_sales_product_id', $id)->first();
        $result->price_range = WholeSalePriceRange::where('whole_sales_product_id', $result->whole_sales_product_id)->get();
//      return $result;

        //  return$result;


        return view('merchant.whole_sales.edit')
            ->with('result', $result)
            ->with('categories', ProductCategory::get())
            ->with('sub_categories', SubCategory::get())
            ->with('shop_id', $shop_id);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shop_id' => 'required|numeric',
            'product_name' => 'required',
            'category_id' => 'required|numeric',
            'sub_category_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->with('failed', "There is an error. Please input all field properly.");
        }


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
        $request['product_size'] = json_encode($request['product_size']);
        $request['product_color'] = json_encode($request['product_color']);


        try {

            WholeSale::where('whole_sales_product_id', $request['whole_sales_product_id'])->update($request->except(['image', 'featured', 'certificate', 'min_quantity', 'max_quantity', 'price', '_token']));
            //Insert Price Range
            $i = 0;
            $price_range = array();
            foreach ($request['min_quantity'] as $price) {
                if ($price != null) {
                    $price_range[] = [
                        'min_quantity' => $request['min_quantity'][$i],
                        'max_quantity' => $request['max_quantity'][$i],
                        'price' => $request['price'][$i],
                        'whole_sales_product_id' => $request['whole_sales_product_id'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                $i++;
            }

            try {
                WholeSalePriceRange::where('whole_sales_product_id', $request['whole_sales_product_id'])->delete();
                WholeSalePriceRange::insert($price_range);
            } catch (\Exception $exception) {
                return back()->with('failed', $exception->getMessage());
                //return $exception->getMessage();
            }

            foreach ($image_array as $image) {
                WholeSaleProductImage::create([
                    'product_id' => $request['whole_sales_product_id'],
                    'image' => $image['image']
                ]);
            }
            return \redirect('/admin/whole-sale/product/show')->with('success', "Successfully Product Updated");
        } catch (Exception $exception) {
            //return $exception->getMessage();
            return back()->with('failed', $exception->getMessage());
        }

    }

    public function MerchantUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shop_id' => 'required|numeric',
            'product_name' => 'required',
            'category_id' => 'required|numeric',
            'sub_category_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()->with('failed', "There is an error. Please input all field properly.");
        }

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
        $request['product_size'] = json_encode($request['product_size']);
        $request['product_color'] = json_encode($request['product_color']);
        $request['is_active'] = false;


        try {

            WholeSale::where('whole_sales_product_id', $request['whole_sales_product_id'])->update($request->except(['image', 'featured', 'certificate', 'min_quantity', 'max_quantity', 'price', '_token']));
            //Insert Price Range
            $i = 0;
            $price_range = array();
            foreach ($request['min_quantity'] as $price) {
                if ($price != null) {
                    $price_range[] = [
                        'min_quantity' => $request['min_quantity'][$i],
                        'max_quantity' => $request['max_quantity'][$i],
                        'price' => $request['price'][$i],
                        'whole_sales_product_id' => $request['whole_sales_product_id'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                $i++;
            }

            try {
                WholeSalePriceRange::where('whole_sales_product_id', $request['whole_sales_product_id'])->delete();
                WholeSalePriceRange::insert($price_range);
            } catch (\Exception $exception) {
                return back()->with('failed', $exception->getMessage());
                //return $exception->getMessage();
            }

            foreach ($image_array as $image) {
                WholeSaleProductImage::create([
                    'product_id' => $request['whole_sales_product_id'],
                    'image' => $image['image']
                ]);
            }

            return \redirect('/merchant/whole-sale/product/show')->with('success', "Successfully Product Updated");
        } catch (Exception $exception) {
            //return $exception->getMessage();
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function destroy($id)
    {

        try {
            WholeSale::where('whole_sales_product_id', $id)->delete();
            return back()->with('success', "Successfully Product Deleted");
        } catch (Exception $exception) {
            return $exception->getMessage();
            return back()->with('failed', $exception->getMessage());
        }
    }
    public function active($id)
    {


        try {
            WholeSale::where('whole_sales_product_id', $id)->update([
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
            WholeSale::where('whole_sales_product_id', $id)->update([
                'is_active' => false
            ]);
            return back()->with('success', "successfully Inactive");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }


    }

    public function merchantDestroy($id)
    {

        try {
            WholeSale::where('whole_sales_product_id', $id)->delete();
            return back()->with('success', "Successfully Product Deleted");
        } catch (Exception $exception) {
            return $exception->getMessage();
            return back()->with('failed', $exception->getMessage());
        }
    }
}
