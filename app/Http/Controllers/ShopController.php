<?php

namespace App\Http\Controllers;

use App\CustomerAddress;
use App\MerchantPayment;
use App\Order;
use App\OrderItem;
use App\OrderPayment;
use App\OrderStatus;
use App\Product;
use App\Shop;
use App\ShopOperator;
use App\User;
use App\WholeSale;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function create()
    {
        return view('admin.shop.create')->with('users', User::get());
    }


    public function store(Request $request)
    {
        //return $request->all();


        $validator = Validator::make($request->all(), [
            'user_name' => 'required',
            'user_phone' => 'required',
            'user_email' => 'required',
            'user_nid' => 'required',
            'shop_name' => 'required',
            'user_password' => 'required|min:4',
            // 'confirm_user_password' => 'required|same:user_password'
        ]);
        if ($validator->fails()) {

            return back()->with('failed', $validator->errors());
        }


        //return $request->all();

        if ($request->hasFile('image')) {
            /*  $this->validate($request, [
                  'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
              ]);*/
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/shop');
            $image->move($destinationPath, $image_name);
            $request->request->add(['trade_licence' => '/images/shop/' . $image_name]);

        }

        if ($request->hasFile('user_image')) {
            $uimage = $request->file('user_image');
            $user_image_name = time() . '.' . $uimage->getClientOriginalExtension();
            $destinationPath = public_path('/users');
            $uimage->move($destinationPath, $user_image_name);

            $request['profile_pic'] = $user_image_name;
        }
        unset($request['_token']);
        unset($request['image']);
        unset($request['user_image']);


        // return $request->except(['_token', 'image']);
        try {

            $shopUser = [
                'name' => $request['user_name'],
                'phone' => $request['user_phone'],
                'email' => $request['user_email'],
                'nid' => $request['user_nid'],
                'dob' => $request['user_dob'],
                'user_type' => 2,
                'password' => Hash::make($request['user_password']),
                'profile_pic' => $request['profile_pic'],

            ];
            $r = $user_id = User::insertGetId($shopUser);

            $shop = [
                'shop_name' => $request['shop_name'],
                'shop_phone' => $request['shop_phone'],
                'shop_email' => $request['shop_email'],
                'shop_address' => $request['shop_address'],
                'shop_details' => $request['shop_details'],
                'commission_rate' => $request['commission_rate'],
                'trade_licence' => $request['trade_licence'],
                'shop_image' => $request['shop_image'],
                'user_id' => $r,

            ];
            $shop_id = Shop::insertGetId($shop);

            $shopOperator = [
                'shop_id' => $shop_id,
                'user_id' => $user_id,
                'user_type' => 1,
            ];
            ShopOperator::create($shopOperator);
            return back()->with('success', "Successfully Created");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function show(Shop $coupon)
    {
        $results = Shop::orderBy('shop_id', 'DESC')->get();
        return view('admin.shop.show')->with('results', $results);
    }


    public function edit($id)
    {
        $result = Shop::where('shop_id', $id)->first();
        return view('admin.shop.edit')
            ->with('result', $result)->with('users', User::get());
    }

    public function commisionUpdate(Request $request)
    {
        // return $request->all();
        $id = $request['shop_id'];

        try {
            Shop::where('shop_id', $id)->update([
                'commission_rate' => $request['commission_rate']
            ]);
            return back()->with('success', "successfully updated");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }


    }

    public function updateStatus($id, $status)
    {


        if ($status == 0) {
            $status = false;
            $products = Product::where('shop_id', $id)->get();
            foreach ($products as $res) {
                Product::where('product_id', $res->product_id)->update([
                    'is_active' => false
                ]);

            }
            $whole_sale = WholeSale::where('shop_id', $id)->get();
            foreach ($whole_sale as $res) {
                WholeSale::where('whole_sales_product_id', $res->whole_sales_product_id)->update([
                    'is_active' => false
                ]);

            }

        } elseif ($status == 1) {
            $status = true;
            $products = Product::where('shop_id', $id)->get();
            foreach ($products as $res) {
                Product::where('product_id', $res->product_id)->update([
                    'is_active' => true
                ]);

            }
            $whole_sale = WholeSale::where('shop_id', $id)->get();
            foreach ($whole_sale as $res) {
                WholeSale::where('whole_sales_product_id', $res->whole_sales_product_id)->update([
                    'is_active' => true
                ]);

            }

        }
        try {
            Shop::where('shop_id', $id)->update([
                'is_active' => $status
            ]);
            return back()->with('success', "successfully Shop updated");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }


    }

    public function update(Request $request)
    {
        unset($request['_token']);
        // return $request->all();
        /*
                 $shop = [
                    'shop_name' => $request['shop_name'],
                    'shop_phone' => $request['shop_phone'],
                    'shop_email' => $request['shop_email'],
                    'shop_address' => $request['shop_address'],
                    'shop_details' => $request['shop_details'],
                    'shop_details' => $request['shop_details'],
                    'commission_rate' => $request['commission_rate'],
                    'trade_licence' => $request['trade_licence'],
                ];*/

        try {
            Shop::where('shop_id', $request['shop_id'])->update($request->all());
            //User::where('id', $request['user_id'])->update($shopUser);
            return back()->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }


    }


    public function destroy($id)
    {

        $products = Product::where('shop_id', $id)->get();
        if ($products != null) {
            return back()->with('failed', "This shop cannot be deleted");
        }


        $whole_sale = WholeSale::where('shop_id', $id)->get();
        if ($whole_sale != null) {
            return back()->with('failed', "This shop cannot be deleted");
        }
        try {
            Shop::where('shop_id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


    public function ShopOrder($shop_id, Request $request)
    {

        $shop_id = intval($shop_id);
        $query = Order:: leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->whereJsonContains('shops', $shop_id)
            ->orderBy('orders.created_at', 'DESC');
        if ($request->customer_phone != null) {
            $query = $query->where('customers.customer_phone', $request['customer_phone']);
        }
        if ($request->is_whole_sale != null) {

            $query = $query->where('orders.is_whole_sale', $request['is_whole_sale']);
        }
        $results = $query->paginate(50);

        //return Session::get("shop_id");
        foreach ($results as $item) {
            $price = OrderItem::where('shop_id', $shop_id)
                ->where('order_invoice', $item->order_invoice)
                ->sum('total_price');
            $item->product_price = $price;
        }

        return view('admin.shop.shop_order')
            ->with('results', $results)
            ->with('shop_id', $shop_id);
    }

    public function ShopOrderDetails($invoice_number)
    {
        $shop = OrderItem::where('order_invoice', $invoice_number)->first();
        $voucher_value = 0;
        $order = Order::leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->where('orders.order_invoice', $invoice_number)
            ->whereJsonContains('shops', $shop->shop_id)
            ->first();

        foreach (json_decode($order->vouchers) as $item) {
            if ($item->shop_id == $shop->shop_id) {
                $voucher_value = $item->voucher;
                break;
            }
        }

        if (is_null($order)) {
            return back()->with('failed', "You dont have have permission to do this action");
        }
        $order_item = OrderItem::join('products', 'products.product_id', '=', 'order_items.product_id')
            ->where('order_items.order_invoice', $invoice_number)
            ->where('order_items.shop_id', $shop->shop_id)
            ->get();

        foreach ($order_item as $product) {
            $status = OrderStatus::where('order_item_id', $product->order_item_id)
                ->orderBy('id', 'DESC')
                ->first();
            if (is_null($status)) {
                $product->status = "Pending";
            } else {
                $product->status = getDeliveryStatus($status->delivery_status);
            }
        }
        foreach ($order_item as $item) {
            $price = OrderItem::where('shop_id', $shop->shop_id)
                ->where('order_invoice', $item->order_invoice)
                ->sum('total_price');
            $item->total_item_price = $price;
        }


        $shipping_address = CustomerAddress::where('customer_id', $order->customer_id)->first();
        $payment_data = OrderPayment::where('tran_id', $invoice_number)->first();
        return view('admin.shop.shop_order_details')
            ->with('products', $order_item)
            ->with('payment_data', $payment_data)
            ->with('shipping_address', $shipping_address)
            ->with('voucher_value', $voucher_value)
            ->with('order', $order);
        /*  ->with('products',$products);*/
    }

    public function ShopOrderDeliveryHistory($id)
    {
        $status = OrderStatus::where('order_item_id', $id)->get();
        return view('merchant.order.order_delivered')->with('status', $status);
    }


    public function paymentDetails($id)
    {
        $results = MerchantPayment::join('shops', 'shops.shop_id', '=', 'merchant_payments.shop_id')
            ->where('merchant_payments.shop_id', $id)
            ->orderBy('merchant_payments.created_at', "DESC")
            ->select('merchant_payments.*', 'shops.shop_name')
            ->get();

        return view('admin.shop.payment_details')
            ->with('shop_id', $id)
            ->with('results', $results);


    }
    public function shopDetails($id)
    {
       $result =Shop::where('shops.shop_id', $id)
            ->first();

      $operators= ShopOperator::join('shops', 'shops.shop_id', '=', 'shop_operators.shop_id')
          ->join('users', 'users.id', '=', 'shop_operators.user_id')
        ->where('shops.shop_id', $result->shop_id)->get();

        return view('admin.shop.shop_details')
            ->with('shop_id', $id)
            ->with('result', $result)
            ->with('operators', $operators);


    }
}
