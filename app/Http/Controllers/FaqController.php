<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
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
        return view('admin.faq.create');
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
            Faq::create($request->except('_token'));
            return back()->with('success', "Successfully Saved");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        $results= Faq::OrderBy('created_at', "DESC")->get();
        return view('admin.faq.view')->with('results',$results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result= Faq::where('id', $id)->first();
        return view('admin.faq.edit')->with('result',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        //return $request->all();
        try {
            Faq::where('id', $request['id'])->update($request->except('_token'));
            return back()->with('success', "Successfully Updated");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
    public function active($id)
    {
        try {
            Faq::where('id', $id)->update([
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
            Faq::where('id', $id)->update([
                'is_active' => false
            ]);
            return back()->with('success', "successfully Inactive");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Faq::where('id', $id)->delete();
            return back()->with('success', "Successfully Deleted");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
