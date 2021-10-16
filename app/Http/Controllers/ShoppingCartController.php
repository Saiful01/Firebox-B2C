<?php

namespace App\Http\Controllers;

use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShoppingCartController extends Controller
{

    public function addItem(Request $request)
    {

        //return $request->all();
        $item = Cart::content()->count();
        if ($item != 0) {
            foreach (Cart::content() as $row) {
                if ($row->options['product_type'] != $request['product_type']) {
                    Cart::destroy();
                    break;
                }
            }
        }

        $data = array();
        if ($request['product_type'] == "whole_sale") {

            //return $request['product_quantity']."---";
            $price = getPriceForWholeSale($request['product_id'], $request['product_quantity']);
            $data =
                [
                    'id' => $request['product_id'],
                    'name' => $request['product_name'],
                    'qty' => $request['product_quantity'],
                    'price' => $price,
                    'weight' => 4,
                    'options' => [
                        'size' => $request['product_size'],
                        'color' => $request['product_color'],
                        'delivery_charge' => "",
                        'deliverable_quantity' => "",
                        'extra_delivery_charge' => "",
                        'image' => $request['product_image'],
                        'product_type' => $request['product_type'],
                        'shop_id' => $request['shop_id'],
                        'shop_name' => $request['shop_name'],
                        'minimum_order_quantity' => $request['minimum_order_quantity'],
                    ]
                ];

            Cart::add($data);

        } else {

            $data = [
                'id' => $request['product_id'],
                'name' => $request['product_name'],
                'qty' => $request['product_quantity'],
                'price' => $request['selling_price'],
                'weight' => 4,
                'options' => [
                    'size' => $request['product_size'],
                    'color' => $request['product_color'],
                    'delivery_charge' => $request['delivery_charge'],
                    'deliverable_quantity' => $request['deliverable_quantity'],
                    'extra_delivery_charge' => $request['extra_delivery_charge'],
                    'image' => $request['product_image'],
                    'product_type' => $request['product_type'],
                    'shop_id' => $request['shop_id'],
                    'shop_name' => $request['shop_name'],
                    'minimum_order_quantity' => $request['minimum_order_quantity'],
                ]
            ];
            Cart::add($data);
        }


        //$data = Cart::content();
        return [
            'status_code' => 200,
            'message' => "Successfully Retrieved",
            'results' => $data
        ];
    }

    public function updateQuantity(Request $request)
    {
        $rowId = $request['row_id'];
        $quantity = $request['quantity'];
        if (Cart::get($rowId)->options->product_type == "whole_sale") {
            $product_id = Cart::get($rowId)->id;
            $price = getPriceForWholeSale($product_id, $quantity);

            Cart::update($rowId, array(
                'price' => $price,
                'qty' => $quantity,
            ));
        } else {
            Cart::update($rowId, $quantity);
        }

        return [
            'status_code' => 200,
            'message' => "Successfully Retrieved",
            'results' => []
        ];
    }

    public function removeAllItem()
    {

        Cart::destroy();
        $status_code = 200;
        return [
            'status_code' => $status_code,
            'message' => "Successfully Removed Item",
            'results' => []
        ];
    }

    public function removeItem($id)
    {

        try {
            Cart::remove($id);
            $status_code = 200;
        } catch (Exception $exception) {
            $status_code = $exception->getCode();
        }

        return [
            'status_code' => $status_code,
            'message' => "Successfully Removed Item",
            'results' => []
        ];
    }

    public function allItem()
    {
        $data = Cart::content();
        $status_code = 200;

        return [
            'status_code' => $status_code,
            'message' => "Successfully Retrieved",
            'results' => $data
        ];
    }

    public function getTotalWeight()
    {
        $data = Cart::weight();
        $status_code = 200;

        return [
            'status_code' => $status_code,
            'message' => "Successfully Retrieved",
            'results' => $data
        ];
    }

    public function getTotalItem()
    {
        $data = Cart::content()->count();
        //$data = Cart::count();
        $status_code = 200;

        return [
            'status_code' => $status_code,
            'message' => "Successfully Retrieved",
            'results' => $data
        ];
    }

    public function getSubTotal(Request $request)
    {
        $data = Cart::priceTotal();
        $status_code = 200;

        return [
            'status_code' => $status_code,
            'message' => "Successfully Retrieved",
            'result' => $data
        ];
    }

    public function getTotalDiscount()
    {
        $data = Cart::discount();
        $status_code = 200;

        return [
            'status_code' => $status_code,
            'message' => "Successfully Retrieved",
            'results' => $data
        ];
    }

    public function getTotalSet()
    {


        $group_by_data = Cart::content()->groupBy('options.shop_id');
       /* foreach ($group_by_data as $item) {
            $item['vouchers'] = getShopVoucherFromId($item[0]->options->shop_id);
        }*/


       /* foreach ($group_by_data as $item) {
            return$item;
        }*/


        $total_delivery_charge = 0;
        $total_price = 0;
        $coupon = 0;
        $voucher = 0;

        foreach (Cart::content() as $item) {
            $total_price = $total_price + ($item->price * $item->qty);
        }

        $total_delivery_charge = getTotalDeliveryCharge();
        $status_code = 200;
        if (Session::get("promo")) {
            $coupon = Session::get("promo")->discount_rate;
        }
        return [
            'status_code' => $status_code,
            'message' => "Successfully Retrieved",
            'total_price' => Cart::priceTotal(),
            'total_product' => Cart::content()->count(),
            'group_by_data' => $group_by_data,
            'total_products' => Cart::content(),
            'total_delivery_charge' => $total_delivery_charge,
            'coupon' => $coupon,
            'voucher' => $voucher,
            'grand_total' => $total_delivery_charge + $total_price - ($coupon + $voucher)

        ];
    }

    public function getAll()
    {

        return Cart::content();

        $status_code = 200;
        return [
            'status_code' => $status_code,
            'message' => "Successfully Retrieved",
            'total_products' => Cart::content(),
        ];
    }
}


/*https://github.com/bumbummen99/LaravelShoppingcart*/
