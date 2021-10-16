<?php

namespace App\Http\Controllers;

use App\ParentCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\ImageManagerStatic as Image;

class ParentCategoryController extends Controller
{

    public function index()
    {
        return view('admin.parent_category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'parent_category_name_en' => 'required',
        ]);
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 200);
            $image_resize->save(public_path('/images/parent_category/' . $image_name));
            $request['featured_image'] = '/images/parent_category/' . $image_name;
        }
        try {
            ParentCategory::create($request->except(['_token', 'image']));
            return redirect('/admin/parent-category/show')->with('success', "Successfully Created");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function show(ParentCategory $parentCategory)
    {
        $results = ParentCategory::orderBy('created_at', 'DESC')->get();
        return view('admin.parent_category.show')->with('results', $results);
    }

    public function edit($id)
    {
        $result = ParentCategory::where('parent_category_id', $id)->first();
        return view('admin.parent_category.edit')->with('result', $result);
    }


    public function update(Request $request, ParentCategory $parentCategory)
    {
        $request->validate([
            'parent_category_name_en' => 'required',
        ]);
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 200);
            $image_resize->save(public_path('/images/parent_category/' . $image_name));
            $request['featured_image'] = '/images/parent_category/' . $image_name;

        }
        try {
            ParentCategory::where('parent_category_id', $request['parent_category_id'])->update($request->except(['_token', 'image']));
            return redirect('/admin/parent-category/show')->with('success', "Successfully Updated");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            ParentCategory::where('parent_category_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }
}
