@extends('layouts.app')
@section('title', 'Order Details Show')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('includes.message')
                    <div class="invoice-title">
                        <h4 class="float-right font-size-16">Order # {{$order->order_invoice}}</h4>
                        {{--<div class="mb-4">
                            <img src="assets/images/logo-dark.png" alt="logo" height="20">
                        </div>--}}
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">

                            <a href="" class=""><img src="/images/logo.png" width="215" alt="Not image found"></a>

                            {{--  {{$products->shop_name}}<br>
                              {{$products->shop_phone}}<br>
                              {{$products->shop_address}}--}}
                            {{--                                {{$order->customer_name}}<br>--}}
                            {{--                                {{$order->customer_phone}}<br>--}}
                            {{--                                {{$order->customer_address}}--}}


                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <address class="mt-2 mt-sm-0">
                                <strong>Shipped To:</strong><br>
                                @if(!is_null($shipping_address))
                                    <strong>Name: </strong>{{$order->customer_name}}<br>
                                    <strong>Phone: </strong>{{$order->customer_phone}}<br>

                                    <strong>Division: </strong>{{getDivisionNameFromId($shipping_address->division_id)}}
                                    <br>
                                    <strong>District: </strong>{{getDistrictNameFromId($shipping_address->district_id)}}
                                    <br>
                                    <strong>Upazila: </strong>{{getUpazilaNameFromId($shipping_address->upazila_id)}}
                                    <br>
                                    <strong>Address: </strong>{{$shipping_address->customer_address}}
                                @endif
                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <address>
                                <strong>Payment Method:</strong><br>
                                @if(!is_null($payment_data))
                                    {{-- Visa ending **** 4242<br>--}}
                                    {{$payment_data->transaction_id}}
                                @endif
                            </address>
                        </div>
                        {{-- <div class="col-sm-6 mt-3 text-sm-right">
                             <address>
                                 <strong>Order Date:</strong><br>
                                 {{$order->created_at}}<br><br>
                             </address>
                         </div>--}}
                    </div>
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 font-weight-bold">Order summary</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                            <tr>
                                <th style="width:70px;">No.</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Delivery Status</th>
                                <th class="text-right">Total</th>
                                <th class="pr-lg-2">
                                    Status Details
                                </th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->selling_price}}</td>
                                    <td>
                                        {{$product->status}}
                                    </td>
                                    <td class="text-right">৳ {{$product->total_price}}</td>
                                    <td>
                                        <a href="/admin/shop/order-status/history/{{$product->order_item_id}}"
                                           type="button"
                                           class="btn btn-primary btn-sm btn-rounded waves-effect waves-light text-white">
                                            Status Details

                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group mr-1 mt-2">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                           @include('includes.delivery_status.index')
                                        </div>

                                    </td>
                                </tr>

                            @endforeach
                            {{--<tr>
                                <td colspan="2" class="text-right">Sub Total</td>
                                <td class="text-right">৳ {{$order->total}}</td>
                            </tr>--}}
                            <tr>
                                <td colspan="4" class="border-0 text-right">
                                    <strong>Shipping</strong></td>
                                <td class="border-0 text-right">৳ {{$order->shipping_cost}}</td>
                            </tr>

                            <tr>
                                <td colspan="4" class="border-0 text-right">
                                    <strong>Total</strong></td>
                                <td class="border-0 text-right"><h4 class="m-0">
                                        ৳ {{$order->shipping_cost + $product->total_item_price}}</h4></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-print-none">
                        <div class="float-right">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i
                                    class="fa fa-print"></i></a>
                            {{-- <a href="#" class="btn btn-primary w-md waves-effect waves-light">Send</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
