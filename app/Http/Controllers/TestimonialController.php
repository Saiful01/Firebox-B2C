<?php

namespace App\Http\Controllers;

use App\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Testimonial::create($request->except('_token'));
            return back()->with('success', "Successfully Saved");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(testimonial $testimonial)
    {
        $results= Testimonial::OrderBy('created_at', "DESC")->get();
        return view('admin.testimonial.view')->with('results',$results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit($id )
    {
        $result= Testimonial::where('id', $id)->first();
        return view('admin.testimonial.edit')->with('result',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, testimonial $testimonial)
    {
        try {
            Testimonial::where('id', $request['id'])->update($request->except('_token'));
            return back()->with('success', "Successfully Updated");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function active($id)
    {
        try {
            Testimonial::where('id', $id)->update([
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
            Testimonial::where('id', $id)->update([
                'is_active' => false
            ]);
            return back()->with('success', "successfully Inactive");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }
    public function destroy($id )
    {
        try {
            Testimonial::where('id', $id)->delete();
            return back()->with('success', "Successfully Deleted");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
