<?php

namespace App\Http\Controllers;

use App\WholesSaleSubCategory;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class WholesSaleSubCategoryController extends Controller
{

    public function index()
    {
        return view('admin.whole_sale_sub_category.create');
    }

    public function store(Request $request)
    {
        /* return $request->all();*/
        $request->validate([
            'category_id' => 'required',
            'sub_category_name_en' => 'required',
            'sub_category_name_bn' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 130);
            $image_resize->save(public_path('/images/whole_sales/sub_category/' . $image_name));
            $request['featured_image'] = '/images/whole_sales/sub_category/' . $image_name;

        }
        try {
            WholesSaleSubCategory::create($request->except(['_token', 'image']));
            return redirect('/admin/whole-sale/sub-category/show')->with('success', "Successfully Created");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function show(Request $request)
    {
        $query = WholesSaleSubCategory::join('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id',
            '=', 'wholes_sale_sub_categories.category_id')
            ->select('whole_sale_categories.category_name_en', 'wholes_sale_sub_categories.*')
            ->orderBy('wholes_sale_sub_categories.created_at', 'DESC');
        if ($request->category_id != null) {
            $query->where('category_id', $request->category_id);
        }
        $results = $query->get();
        return view('admin.whole_sale_sub_category.show')->with('results', $results);
    }

    public function edit($id)
    {
        $result = WholesSaleSubCategory::where('whole_sale_sub_category_id', $id)
            ->join('whole_sale_categories', 'whole_sale_categories.whole_sale_category_id', '=', 'wholes_sale_sub_categories.category_id')
            ->select('whole_sale_categories.category_name_en', 'wholes_sale_sub_categories.*')
            ->first();
        return view('admin.whole_sale_sub_category.edit')
            ->with('result', $result);
    }

    public function update(Request $request, WholesSaleSubCategory $wholesSaleSubCategory)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 130);
            $image_resize->save(public_path('/images/whole_sales/sub_category/' . $image_name));
            $request['featured_image'] = '/images/whole_sales/sub_category/' . $image_name;
        }
        try {
            WholesSaleSubCategory::where('whole_sale_sub_category_id', $request['whole_sale_sub_category_id'])->update($request->except(['_token', 'image']));
            return redirect('/admin/whole-sale/sub-category/show')->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            WholesSaleSubCategory::where('whole_sale_sub_category_id', $id)->delete();
            return redirect('/admin/whole-sale/sub-category/show')->with('success', "Successfully Deleted");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
