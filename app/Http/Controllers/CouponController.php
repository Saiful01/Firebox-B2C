<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Customer;
use Exception;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        return view('admin.coupon.create')->with('customers', Customer::get());
    }


    public function store(Request $request)
    {

        // return $request->all();
        try {
            Coupon::create($request->except('_token'));
            return back()->with('success', "Successfully Created");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function show(Coupon $coupon)
    {
        $results = Coupon::orderBy('created_at', 'DESC')->get();
        return view('admin.coupon.show')->with('results', $results);
    }


    public function edit($id)
    {
        $result = Coupon::where('coupon_id', $id)->first();
        return view('admin.coupon.edit')
            ->with('customers', Customer::get())
            ->with('result', $result);
    }

    public function update(Request $request)
    {

        try {
            Coupon::where('coupon_id', $request['coupon_id'])->update($request->except(['coupon_id', '_token']));
            return back()->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            Coupon::where('coupon_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
