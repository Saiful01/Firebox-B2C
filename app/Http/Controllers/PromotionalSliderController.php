<?php

namespace App\Http\Controllers;

use App\PromotionalSlider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\ImageManagerStatic as Image;

class PromotionalSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }


    public function create()
    {
        return view('admin.promotional_slider.create');
    }


    public function store(Request $request)
    {

        // return $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());

            if ($request['section_id'] == 1) {
                $image_resize->resizeCanvas(730, 510);
            } elseif ($request['section_id'] == 2) {
                $image_resize->resizeCanvas(330, 245);
            } elseif ($request['section_id'] == 3) {
                $image_resize->resizeCanvas(1366, 200);
            } else {
                $image_resize->resizeCanvas(680, 180);
            }
            $image_resize->save(public_path('/images/promotional_slider/' . $image_name));
            $request['slider_image'] = '/images/promotional_slider/' . $image_name;
        }

        if ($request->hasFile('image2')) {
            $image = $request->file('image2');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());

            if ($request['section_id'] == 1) {
                $image_resize->resizeCanvas(730, 510);
            } elseif ($request['section_id'] == 2) {
                $image_resize->resizeCanvas(330, 245);
            } elseif ($request['section_id'] == 3) {
                $image_resize->resizeCanvas(1366, 200);
            } else {
                $image_resize->resizeCanvas(680, 180);
            }
            $image_resize->save(public_path('/images/promotional_slider/' . $image_name));
            $request['slider_mobile_image'] = '/images/promotional_slider/' . $image_name;
        } else {
            $request['slider_mobile_image'] = $request['slider_image'];
        }
        //return $request->except(['_token', 'image']);


        try {
            PromotionalSlider::create($request->except(['_token', 'image', 'image2']));
            return back()->with('success', "Successfully Created");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function show(PromotionalSlider $promotionalSlider)
    {
        $results = PromotionalSlider::orderBy('created_at', 'DESC')->get();
        return view('admin.promotional_slider.show')->with('results', $results);
    }


    public function edit($id)
    {
        $result = PromotionalSlider::where('promotional_slider_id', $id)->first();
        return view('admin.promotional_slider.edit')
            ->with('result', $result);
    }

    public function update(Request $request)
    {

        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());

                if ($request['section_id'] == 1) {
                    $image_resize->resizeCanvas(730, 510);
                } elseif ($request['section_id'] == 2) {
                    $image_resize->resizeCanvas(330, 245);
                } elseif ($request['section_id'] == 3) {
                    $image_resize->resizeCanvas(1366, 200);
                } else {
                    $image_resize->resizeCanvas(680, 180);
                }

                $image_resize->save(public_path('/images/promotional_slider/' . $image_name));
                $request['slider_image'] = '/images/promotional_slider/' . $image_name;
            }

            if ($request->hasFile('image2')) {
                $image = $request->file('image2');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $image_resize = Image::make($image->getRealPath());

                if ($request['section_id'] == 1) {
                    $image_resize->resizeCanvas(730, 510);
                } elseif ($request['section_id'] == 2) {
                    $image_resize->resizeCanvas(330, 245);
                } elseif ($request['section_id'] == 3) {
                    $image_resize->resizeCanvas(1366, 200);
                } else {
                    $image_resize->resizeCanvas(680, 180);
                }

                $image_resize->save(public_path('/images/promotional_slider/' . $image_name));
                $request['slider_mobile_image'] = '/images/promotional_slider/' . $image_name;
            } else {
                $request['slider_mobile_image'] = $request['slider_image'];
            }

            PromotionalSlider::where('promotional_slider_id', $request['promotional_slider_id'])->update($request->except(['promotional_slider_id', 'image', 'image2', '_token']));
            return back()->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            PromotionalSlider::where('promotional_slider_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
