<?php

namespace App\Http\Controllers;

use App\CustomerNotification;
use Illuminate\Http\Request;

class CustomerNotificationController extends Controller
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
            CustomerNotification::create($request->except(['_token']));
            return back()->with('success', "Successfully Notification send");
        }
        catch (\Exception $exception){
            return back()->with('failed', $exception->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerNotification  $customerNotification
     * @return \Illuminate\Http\Response
     */
    public function show($id )
    {
        $results= CustomerNotification::where('customer_id', $id)->get();
        return view('admin.notification.show')
            ->with('id', $id)
            ->with('results', $results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerNotification  $customerNotification
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerNotification $customerNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerNotification  $customerNotification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerNotification $customerNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerNotification  $customerNotification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id )
    {
        try {
            CustomerNotification::where('id', $id)->delete();
            return back()->with('success', "Successfully Notification send");
        }
        catch (\Exception $exception){
            return back()->with('failed', $exception->getMessage());

        }
    }
}
