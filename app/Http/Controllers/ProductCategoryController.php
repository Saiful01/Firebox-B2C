<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class ProductCategoryController extends Controller
{
    public function create()
    {
        return view('admin.category.create');
    }


    public function store(Request $request)
    {

        /*return $request->all();*/
        $request->validate([
            'parent_category_id' => 'required',
            'category_name_en' => 'required',
        /*    'category_name_bn' => 'required',
            'image' => 'required',*/
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 130);
            $image_resize->save(public_path('/images/category/' . $image_name));
            $request['category_image'] = '/images/category/' . $image_name;
        }

        // return $request->except(['_token', 'image']);
        try {
            ProductCategory::create($request->except(['_token', 'image']));
            return redirect('/admin/category/show')->with('success', "Successfully Created");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function show(ProductCategory $coupon)
    {
        $results = ProductCategory::join('parent_categories', 'parent_categories.parent_category_id',
            '=', 'product_categories.parent_category_id')
            ->orderBy('product_categories.created_at', 'DESC')
            ->select('product_categories.*', 'parent_categories.parent_category_name_en')
            ->get();
        return view('admin.category.show')->with('results', $results);
    }


    public function edit($id)
    {
        $result = ProductCategory::join('parent_categories', 'parent_categories.parent_category_id',
            '=', 'product_categories.parent_category_id')->where('category_id', $id)->first();
        return view('admin.category.edit')
            ->with('result', $result);
    }

    public function update(Request $request)
    {
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 130);
            $image_resize->save(public_path('/images/category/' . $image_name));
            $request['category_image'] = '/images/category/' . $image_name;
        }

        try {
            ProductCategory::where('category_id', $request['category_id'])->update($request->except(['category_id', '_token', 'image']));
            return redirect('/admin/category/show')->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            ProductCategory::where('category_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
