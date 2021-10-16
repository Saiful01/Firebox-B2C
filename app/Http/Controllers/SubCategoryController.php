<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\SubCategory;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SubCategoryController extends Controller
{
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.sub_category.create')->with('categories', $categories);
    }


    public function store(Request $request)
    {
        /*  return $request->all();*/

        $request->validate([
            'category_id' => 'required',
            'sub_category_name_en' => 'required',
           /* 'sub_category_name_bn' => 'required',*/
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 130);
            $image_resize->save(public_path('/images/sub_category/' . $image_name));
            $request['featured_image'] = '/images/sub_category/' . $image_name;
        }
        try {
            SubCategory::create($request->except(['_token', 'image']));
            return redirect('/admin/sub-category/show')->with('success', "Successfully Created");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function show(Request $request)
    {
        $query = SubCategory::join('product_categories', 'product_categories.category_id', '=', 'sub_categories.category_id')
            ->select('product_categories.category_name_en', 'sub_categories.*')
            ->orderBy('category_id', 'DESC');
        if ($request->category_id != null) {
            $query->where('sub_categories.category_id', $request->category_id);
        }
        $results = $query->get();
        return view('admin.sub_category.show')->with('results', $results);
    }


    public function edit($id)
    {
        $categories = ProductCategory::all();
        $result = SubCategory::where('sub_category_id', $id)
            ->join('product_categories', 'product_categories.category_id', '=', 'sub_categories.category_id')
            ->select('product_categories.category_name_en', 'sub_categories.*')
            ->first();
        return view('admin.sub_category.edit')
            ->with('result', $result)
            ->with('categories', $categories);
    }

    public function update(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());


            $image_resize->resize(200, 130);

           /* $image_resize->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });*/


            $image_resize->save(public_path('/images/sub_category/' . $image_name));
            $request['featured_image'] = '/images/sub_category/' . $image_name;
        }


       // return $request->except([ '_token', 'image']);
        try {
            SubCategory::where('sub_category_id', $request['sub_category_id'])->update($request->except(['sub_category_id', '_token', 'image']));
            return redirect('/admin/sub-category/show')->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            SubCategory::where('sub_category_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
