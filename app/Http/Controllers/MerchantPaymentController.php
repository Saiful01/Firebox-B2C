<?php

namespace App\Http\Controllers;

use App\MerchantPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MerchantPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        $results= MerchantPayment::where('shop_id',  Session::get('shop_id'))->get();

        return view('merchant.report.index')->with('results',$results);
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
        //return $request->all();
        try {
            MerchantPayment::create( $request->except(['_token']));
            return back()->with('success', "Successfully Created");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
    public function MerchantReceivedStatus($id )
    {

        try {
            MerchantPayment::where('merchant_payment_id', $id)->update([
                'is_received'=> true
            ]);
            return back()->with('success', "Successfully received");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MerchantPayment  $merchantPayment
     * @return \Illuminate\Http\Response
     */
    public function show(MerchantPayment $merchantPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MerchantPayment  $merchantPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(MerchantPayment $merchantPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MerchantPayment  $merchantPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MerchantPayment $merchantPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MerchantPayment  $merchantPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(MerchantPayment $merchantPayment)
    {
        //
    }
}
