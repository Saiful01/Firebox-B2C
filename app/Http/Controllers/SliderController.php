<?php

namespace App\Http\Controllers;

use App\Slider;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class SliderController extends Controller
{

    public function create()
    {
        return view('admin.slider.create');
    }


    public function store(Request $request)
    {

        // return $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resizeCanvas(800, 450);
            $image_resize->save(public_path('/images/slider_image/' . $image_name));
            $request['slider_image'] = "/images/slider_image/" . $image_name;
        }

        try {
            Slider::create($request->except(['_token', 'image']));
            return back()->with('success', "Successfully Created");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function show(Slider $coupon)
    {
        $results = Slider::orderBy('created_at', 'DESC')->get();
        return view('admin.slider.show')->with('results', $results);
    }


    public function edit($id)
    {
        $result = Slider::where('slider_id', $id)->first();
        return view('admin.slider.edit')
            ->with('result', $result);
    }

    public function update(Request $request)
    {

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resizeCanvas(800, 450);
                $image_resize->save(public_path('/images/slider_image/' . $image_name));
                $request['slider_image'] = "/images/slider_image/" . $image_name;
            }
            Slider::where('slider_id', $request['slider_id'])->update($request->except(['slider_id', 'image', '_token']));
            return back()->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Slider::where('slider_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
