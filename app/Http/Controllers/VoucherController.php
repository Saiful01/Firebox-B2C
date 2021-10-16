<?php

namespace App\Http\Controllers;

use App\ShopOperator;
use App\Voucher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{

    public function index()
    {
        return view('merchant.voucher.create');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $shop_id = ShopOperator::where('user_id', Auth::user()->id)->first()->shop_id;

        $request->validate([
           /* 'max_value' => 'required|numeric',*/
            'min_value' => 'required|numeric',
            'discount' => 'required|numeric',

        ]);
        $request['shop_id'] = $shop_id;
        try {
            Voucher::create($request->except('_token'));
            return redirect('/merchant/voucher/show')->with('success', "Successfully Saved");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


    public function show(Voucher $voucher)
    {
        $shop_id = ShopOperator::where('user_id', Auth::user()->id)->first()->shop_id;
        $results = Voucher::orderBy('created_at', 'DESC')->where('shop_id', $shop_id)->get();

        return view('merchant.voucher.show')->with('results', $results);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Voucher $voucher
     * @return Response
     */
    public function edit($id)
    {
        $result = Voucher::where('voucher_id', $id)->first();

        return view('merchant.voucher.edit')->with('result', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Voucher $voucher
     * @return Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        try {
            Voucher::where('voucher_id', $request['voucher_id'])->update($request->except('_token'));
            return redirect('/merchant/voucher/show')->with('success', "Successfully Updated");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function active($id)
    {
        try {
            Voucher::where('voucher_id', $id)->update([
                'is_active' => true
            ]);
            return back()->with('success', "Successfully Active");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    public function inactive($id)
    {
        try {
            Voucher::where('voucher_id', $id)->update([
                'is_active' => false
            ]);
            return back()->with('success', "Successfully InActive");
        } catch (Exception $exception) {

            return back()->with('success', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Voucher $voucher
     * @return Response
     */
    public function destroy($id)
    {
        try {
            Voucher::where('voucher_id', $id)->delete();
            return redirect('/merchant/voucher/show')->with('success', "Successfully Deleted");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
