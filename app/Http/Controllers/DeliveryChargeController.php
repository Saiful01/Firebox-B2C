<?php

namespace App\Http\Controllers;

use App\DeliveryCharge;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DeliveryChargeController extends Controller
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
        $data=DeliveryCharge::all()->first();
        return view('admin.delivery_charge.create')->with('result', $data);
    }

    public function store(Request $request)
    {

        try {
            DeliveryCharge::where('id',1)->update($request->except(['_token']));
            return back()->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }



    }

    public function show(DeliveryCharge $deliveryCharge)
    {
        //
    }


    public function edit(DeliveryCharge $deliveryCharge)
    {
        //
    }


    public function update(Request $request, DeliveryCharge $deliveryCharge)
    {
        //
    }


    public function destroy(DeliveryCharge $deliveryCharge)
    {
        //
    }
}
