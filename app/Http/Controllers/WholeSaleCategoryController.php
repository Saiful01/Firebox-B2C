<?php

namespace App\Http\Controllers;

use App\WholeSaleCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\ImageManagerStatic as Image;

class WholeSaleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.whole_sales_category.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        /*return $request->all();*/
        $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 130);
            $image_resize->save(public_path('/images/whole_sales/category/' . $image_name));
            $request['category_image'] = '/images/whole_sales/category/' . $image_name;


        }

        // return $request->except(['_token', 'image']);
        try {
            WholeSaleCategory::create($request->except(['_token', 'image']));
            return redirect('/admin/whole-sale/category/show')->with('success', "Successfully Created");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function show(WholeSaleCategory $wholeSaleCategory)
    {
        $results = WholeSaleCategory::orderBy('created_at', 'DESC')->get();
        return view('admin.whole_sales_category.show')->with('results', $results);
    }

    public function edit($id)
    {
        $result = WholeSaleCategory::where('whole_sale_category_id', $id)->first();
        return view('admin.whole_sales_category.edit')
            ->with('result', $result);
    }


    public function update(Request $request, WholeSaleCategory $wholeSaleCategory)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(200, 130);
            $image_resize->save(public_path('/images/whole_sales/category/' . $image_name));
            $request['category_image'] = '/images/whole_sales/category/' . $image_name;

        }
        try {
            WholeSaleCategory::where('whole_sale_category_id', $request['whole_sale_category_id'])->update($request->except(['_token', 'image']));
            return redirect('/admin/whole-sale/category/show')->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            WholeSaleCategory::where('whole_sale_category_id', $id)->delete();
            return redirect('/admin/whole-sale/category/show')->with('success', "Successfully Deleted");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
