<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
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
        //
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
            Video::create($request->all());
            return back()->with('success',"Successfully Saved");
        }
        catch (\Exception $exception){
            return back()->with('failed',$exception->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        $results= Video::OrderBy('created_at', "DESC")->get();
        return view('admin.video.show')->with('results', $results);
    }
    public function merchantShow(Video $video)
    {
        $results= Video::OrderBy('created_at', "DESC")->get();
        return view('merchant.video.show')->with('results', $results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {

        try {
            Video::where('video_id', $request['video_id'])->update($request->except(['_token']));
            return back()->with('success',"Successfully Updated");
        }
        catch (\Exception $exception){
            return back()->with('failed',$exception->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Video::where('video_id', $id)->delete();
            return back()->with('success',"Successfully Deleted");
        }
        catch (\Exception $exception){
            return back()->with('failed',$exception->getMessage());

        }
    }
}
