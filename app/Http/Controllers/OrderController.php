<?php

namespace App\Http\Controllers;

use App\CustomerAddress;
use App\Order;
use App\OrderItem;
use App\OrderPayment;
use App\OrderStatus;
use App\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{


    public function show(Request $request)
    {

        $from = $request['from'];
        $to = $request['to'];
        $status = $request['order_status'];

        $query = Order:: leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->leftJoin('order_statuses', 'order_statuses.order_invoice', '=', 'orders.order_invoice')
            ->orderBy('orders.created_at', 'DESC')
            ->select('orders.*', 'customers.customer_name', 'customers.customer_phone', 'order_statuses.delivery_status');
        if ($status != null) {
            $query = $query->where('order_statuses.delivery_status', $status);
        }
        if ($request->customer_phone != null) {
            $query = $query->where('customers.customer_phone', $request['customer_phone']);
        }
        if ($request->order_invoice != null) {
            $query = $query->where('orders.order_invoice', $request['order_invoice']);
        }

        if ($from != null) {

            $query = $query->whereBetween('orders.created_at', [$from, $to]);

        }
        $results = $query->paginate(50);
        foreach ($results as $product) {
            $status = OrderStatus::where('order_invoice', $product->order_invoice)
                ->orderBy('id', 'DESC')->first();
            if (is_null($status)) {
                $product->status = "Previous Order";
            } else {
                $product->status = getDeliveryStatus($status->delivery_status);
            }

        }
        //return $results;


        return view('admin.order.show')
            ->with('results', $results);
        /*  ->with('products',$products);*/
    }

    public function cashPaymentStore(Request $request)
    {

        try {

            OrderPayment::create([
                'tran_id' => $request['tran_id'],
                'amount' => $request['amount'],
                'payment_method' => $request['payment_method'],
            ]);
            Order::where('order_id', $request['order_id'])->update([
                'payment_type' => 'online',
                'payment_status' => 1,

            ]);
            return back()->with('success', "Successfully Payment");
        } catch (\Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function orderDetails($invoice_number)
    {
        /*     $results = Order:: leftjoin('order_items', 'order_items.order_invoice', '=', 'orders.order_invoice')
                 ->leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
                 ->paginate(15);*/

        $order = Order::leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->where('orders.order_invoice', $invoice_number)
            ->select('orders.*', 'customers.customer_name', 'customers.customer_phone')
            ->first();


        $order_item = OrderItem::leftJoin('products', 'products.product_id', '=', 'order_items.product_id')
            ->leftJoin('shops', 'shops.shop_id', '=', 'products.shop_id')
            ->where('order_items.order_invoice', $invoice_number)
            ->orderBy('order_items.shop_id')
            ->select('shops.shop_name', 'order_items.*', 'products.product_name', 'products.featured_image')
            ->get();


        /*  foreach ($order_item as $product) {
              $status = OrderStatus::where('order_invoice', $invoice_number)
                  ->orderBy('id', 'DESC')->first();
              if (is_null($status)) {
                  $product->status = "Pending";
              } else {
                  $product->status = getDeliveryStatus($status->delivery_status);
              }


              $product->commission = ($product->total_price * $product->commission_rate) / 100;


          }*/

        $shipping_address = CustomerAddress::where('customer_id', $order->customer_id)->first();
        $payment_data = OrderPayment::where('tran_id', $invoice_number)->first();
        return view('admin.order.details')
            ->with('products', $order_item)
            ->with('payment_data', $payment_data)
            ->with('shipping_address', $shipping_address)
            ->with('order', $order);
        /*  ->with('products',$products);*/
    }

    public function InvoicePrint($invoice_number)
    {
        /*     $results = Order:: leftjoin('order_items', 'order_items.order_invoice', '=', 'orders.order_invoice')
                 ->leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
                 ->paginate(15);*/

        $order = Order::leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->where('orders.order_invoice', $invoice_number)
            ->select('orders.*', 'customers.customer_name', 'customers.customer_phone')
            ->first();
        $order_item = OrderItem::join('products', 'products.product_id', '=', 'order_items.product_id')
            ->leftJoin('shops', 'shops.shop_id', '=', 'products.shop_id')
            ->where('order_items.order_invoice', $invoice_number)
            ->orderBy('order_items.shop_id')
            ->select('shops.shop_name', 'order_items.*', 'products.product_name')
            ->get();
        foreach ($order_item as $product) {
            $status = OrderStatus::where('order_invoice', $invoice_number)
                ->orderBy('id', 'DESC')->first();
            if (is_null($status)) {
                $product->status = "Pending";
            } else {
                $product->status = getDeliveryStatus($status->delivery_status);
            }


            $product->commission = ($product->total_price * $product->commission_rate) / 100;


        }

        $shipping_address = CustomerAddress::where('customer_id', $order->customer_id)->first();
        $payment_data = OrderPayment::where('tran_id', $invoice_number)->first();
        return view('admin.order.invoice_print')
            ->with('products', $order_item)
            ->with('payment_data', $payment_data)
            ->with('shipping_address', $shipping_address)
            ->with('order', $order);
        /*  ->with('products',$products);*/
    }


    public function merchantShow(Request $request)
    {

        if (Session::get('shop_id') == null) {
            return Redirect::to('/logout');
        }

        $query = Order:: leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->whereJsonContains('shops', Session::get('shop_id'))
            ->orderBy('orders.created_at', 'DESC');
        if ($request->customer_phone != null) {
            $query = $query->where('customers.customer_phone', $request['customer_phone']);
        }
        if ($request->order_invoice != null) {
            $query = $query->where('orders.order_invoice', $request['order_invoice']);
        }
        if ($request->is_whole_sale != null) {

            $query = $query->where('orders.is_whole_sale', $request['is_whole_sale']);
        }
        $results = $query->paginate(50);

        //return Session::get("shop_id");
        foreach ($results as $item) {
            $price = OrderItem::where('shop_id', Session::get("shop_id"))
                ->where('order_invoice', $item->order_invoice)
                ->sum('total_price');
            $item->product_price = $price;
        }

        return view('merchant.order.show')
            ->with('results', $results);
        /*  ->with('products',$products);*/
    }

    public function merchantOrderDetails($invoice_number)
    {
        $voucher_value = 0;
        $order = Order::leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->where('orders.order_invoice', $invoice_number)
            ->whereJsonContains('shops', Session::get('shop_id'))
            ->first();

        foreach (json_decode($order->vouchers) as $item) {
            if ($item->shop_id == Session::get('shop_id')) {
                $voucher_value = $item->voucher;
                break;
            }
        }

        if (is_null($order)) {
            return back()->with('failed', "You dont have have permission to do this action");
        }


        if ($order->is_whole_sale == 1) {

            $order_item = OrderItem::leftJoin('whole_sales', 'whole_sales.whole_sales_product_id', '=', 'order_items.product_id')
                ->where('order_items.order_invoice', $invoice_number)
                ->where('order_items.shop_id', Session::get('shop_id'))
                ->get();


        } else {
            $order_item = OrderItem::leftJoin('products', 'products.product_id', '=', 'order_items.product_id')
                ->where('order_items.order_invoice', $invoice_number)
                ->where('order_items.shop_id', Session::get('shop_id'))
                ->get();
        }


        foreach ($order_item as $product) {
            $status = OrderStatus::where('order_invoice', $invoice_number)
                ->orderBy('id', 'DESC')
                ->first();
            if (is_null($status)) {
                $product->status = "Pending";
            } else {
                $product->status = getDeliveryStatus($status->delivery_status);
            }
        }


        $shipping_address = CustomerAddress::where('customer_id', $order->customer_id)->first();
        $payment_data = OrderPayment::where('tran_id', $invoice_number)->first();
        return view('merchant.order.details')
            ->with('products', $order_item)
            ->with('payment_data', $payment_data)
            ->with('shipping_address', $shipping_address)
            ->with('voucher_value', $voucher_value)
            ->with('order', $order);
        /*  ->with('products',$products);*/
    }

    public function merchantOrderPrint($invoice_number)
    {
        $voucher_value = 0;
        $order = Order::leftJoin('customers', 'customers.customer_id', '=', 'orders.customer_id')
            ->where('orders.order_invoice', $invoice_number)
            ->whereJsonContains('shops', Session::get('shop_id'))
            ->first();

        foreach (json_decode($order->vouchers) as $item) {
            if ($item->shop_id == Session::get('shop_id')) {
                $voucher_value = $item->voucher;
                break;
            }
        }

        if (is_null($order)) {
            return back()->with('failed', "You dont have have permission to do this action");
        }
        $order_item = OrderItem::join('products', 'products.product_id', '=', 'order_items.product_id')
            ->where('order_items.order_invoice', $invoice_number)
            ->where('order_items.shop_id', Session::get('shop_id'))
            ->get();


        $shipping_address = CustomerAddress::where('customer_id', $order->customer_id)->first();
        $payment_data = OrderPayment::where('tran_id', $invoice_number)->first();
        return view('merchant.order.invoice_print')
            ->with('products', $order_item)
            ->with('payment_data', $payment_data)
            ->with('shipping_address', $shipping_address)
            ->with('voucher_value', $voucher_value)
            ->with('order', $order);
        /*  ->with('products',$products);*/
    }


    public function orderDeliveryStatus($invoice_number)
    {
        $status = OrderStatus::where('order_invoice', $invoice_number)->get();
        return view('admin.shop.order_delivered')->with('status', $status);
    }

    public function merchantOrderDeliveryStatus($invoice_number)
    {
        $status = OrderStatus::where('order_invoice', $invoice_number)->get();
        return view('merchant.order.order_delivered')->with('status', $status);
    }

}
