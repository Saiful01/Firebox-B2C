<?php

namespace App\Http\Controllers;

use App\Product;
use App\Shop;
use App\ShopOperator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CompanyAdminController extends Controller
{


    public function orders()
    {

        $is_exist = Shop::where('user_id', Auth::user()->id)->first();
        if (is_null($is_exist)) {
            return back()->with('failed', "You don't have a shop");
        }
        $results = Product::where('shop_id', $is_exist->shop_id)->paginate();
        /*
                leftjoin('order_items', 'order_items.order_invoice', '=', 'orders.order_invoice')
                    ->leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
                    ->paginate(15);*/
        return view('admin.order.show')
            ->with('results', $results);
    }

    public function createShop()
    {
        $is_exist = ShopOperator::where('user_id', Auth::user()->id)->first();
        if (!is_null($is_exist)) {
            return ShopOperator::join('shops', 'shop_operators.shop_id', '=', 'shops.shop_id')
                ->where('shop_operators.user_id', Auth::user()->id)->get();

            return Redirect::to('/admin/profile');
        }
        return view('admin.company_admin.create_shop');
    }

    public function storeShop(Request $request)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/shop/');
            $image->move($destinationPath, $image_name);

            $request['shop_image'] = "/images/shop/" . $image_name;
        }


        try {

            Shop::create($request->except(['_token', 'image']));

            return Redirect::to('/admin/dashboard')->with('success', "Shop Created");
        } catch (Exception $exception) {


            return $exception->getMessage();

            return back()->with('failed', "There is a problem");
        }
    }

    public function qrDownload($qr_code)
    {
        return view('admin.product.qr_code')->with('qr_code', $qr_code);
    }

}
