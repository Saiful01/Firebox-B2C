<?php

namespace App\Http\Controllers;

use App\MerchantPayment;
use App\OrderItem;
use App\OrderPayment;
use App\OrderStatus;
use App\Shop;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{


    public function dashboard()
    {

        return view('admin.dashboard.index');
    }

    public function report()
    {
        $shops = Shop::select('shop_id', 'shop_name')->get();

        $grand_total_sell=0;
        $grand_total_commission=0;
        $total_shop=0;
        foreach ($shops as $shop) {
            $results = OrderItem::join('order_statuses', 'order_statuses.order_item_id', '=', 'order_items.order_item_id')
            /*    ->where('order_statuses.delivery_status', 4)
                ->where('order_items.shop_id', $shop->shop_id)*/
                ->select('total_price', 'commission_rate')->get();
            $total_commission = 0;
            $total_sell = 0;
            foreach ($results as $res) {
                $commision = ($res->commission_rate * $res->total_price) / 100;
                $total_commission = $total_commission + $commision;
                $total_sell = $total_sell + $res->total_price;
            }
            $shop->total_sell = $total_sell;
            $shop->total_commision = $total_commission;
            $grand_total_sell=$grand_total_sell+$total_sell;
            $grand_total_commission=$grand_total_commission+$total_commission;
            $total_shop++;
        }
        //return "";
        return view('admin.report.report')
            ->with('results', $shops)
            ->with('grand_total_sell', $grand_total_sell)
            ->with('grand_total_commission', $grand_total_commission)
            ->with('total_shop', $total_shop);
    }

    function ShopReport($id)
    {
        $grand_total_sell=0;
        $grand_total_commission=0;
        $results = OrderItem::join('order_statuses', 'order_statuses.order_item_id', '=', 'order_items.order_item_id')
            ->join('shops', 'shops.shop_id', '=', 'order_items.shop_id')
            ->where('order_statuses.delivery_status', 4)
            ->where('order_items.shop_id', $id)
            ->select('order_items.*', 'order_statuses.delivery_status', 'shops.shop_name')
            ->orderBy('order_statuses.created_at', "Desc")
            ->get();
        foreach ($results as $res){
            $commission = ($res->commission_rate * $res->total_price) / 100;
            $grand_total_commission = $grand_total_commission + $commission;
            $grand_total_sell = $grand_total_sell + $res->total_price;
            $res->total_sell= $res->total_price;
            $res->total_commission=$commission;
        }
        $merchant_payment=MerchantPayment::where('shop_id', $id)->sum('payment_amount');
        $paid_amount=$merchant_payment;
        $due=$grand_total_sell-($merchant_payment+$grand_total_commission);

        return view('admin.report.shop_report')
            ->with('results', $results)
            ->with('grand_total_sell', $grand_total_sell)
            ->with('grand_total_commission', $grand_total_commission)
            ->with('due', $due)
            ->with('paid_amount', $paid_amount);
    }
    function MerchantShopReport(Request $request)
    {
        $grand_total_sell=0;
        $grand_total_commission=0;
        $results = OrderItem::join('order_statuses', 'order_statuses.order_item_id', '=', 'order_items.order_item_id')
            ->join('shops', 'shops.shop_id', '=', 'order_items.shop_id')
            ->where('order_statuses.delivery_status', 4)
            ->where('order_items.shop_id', Session::get('shop_id'))
            ->select('order_items.*', 'order_statuses.delivery_status', 'shops.shop_name')
            ->orderBy('order_statuses.created_at', "Desc")
            ->get();
        foreach ($results as $res){
            $commission = ($res->commission_rate * $res->total_price) / 100;
            $grand_total_commission = $grand_total_commission + $commission;
            $grand_total_sell = $grand_total_sell + $res->total_price;
            $res->total_sell= $res->total_price;
            $res->total_commission=$commission;
        }
        $merchant_payment=MerchantPayment::where('shop_id', Session::get('shop_id'))->sum('payment_amount');
        $paid_amount=$merchant_payment;
        $due=$grand_total_sell-($merchant_payment+$grand_total_commission);

        return view('merchant.report.shop_report')
            ->with('results', $results)
            ->with('grand_total_sell', $grand_total_sell)
            ->with('grand_total_commission', $grand_total_commission)
            ->with('due', $due)
            ->with('paid_amount', $paid_amount);
    }

    public function profile()
    {
        return view('admin.profile.edit')->with('result', Auth::user());
    }

    /////profile update


    public function update(Request $request)
    {
        unset($request['_token']); //Remove Token
        $id = $request['id'];
        unset($request['id']); //Remove id


        if ($request['password'] == null) {
            unset($request['password']);
        } else {
            $request['password'] = Hash::make($request['password']);
        }

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/user');
            $image->move($destinationPath, $image_name);
            $request->request->add(['profile_pic' => '/images/user/' . $image_name]);
        }

        //return $request->except(['image']);
        try {
            User::where('id', $id)->update($request->except(['image']));
            return back()->with('success', "Profile Updated");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
