@extends('layouts.app')
@section('title', 'Order Show')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('includes.message')
                    <div class="invoice-title">
                        <h4 class="float-right font-size-16">Order invoice # {{$order->order_invoice}}</h4>
                        <br>
                        {{--<div class="mb-4">
                            <img src="assets/images/logo-dark.png" alt="logo" height="20">
                        </div>--}}
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">

                            <a href="" class=""><img src="/images/logo.png" width="215" alt="Not image found"></a>

                            {{--  {{$products->shop_name}}<br>
                              {{$products->shop_phone}}<br>
                              {{$products->shop_address}}--}}
                            {{--                                {{$order->customer_name}}<br>--}}
                            {{--                                {{$order->customer_phone}}<br>--}}
                            {{--                                {{$order->customer_address}}--}}


                        </div>
                        <div class="col-sm-4 text-sm-right">
                            <address class="mt-2 mt-sm-0">
                                <strong>Payment Details:</strong><br>
                                @if($order->payment_status==0)
                                    <strong>Payment Method: </strong>Cash<br>
                                    <strong>Payment status:</strong> Unpaid<br>
                                    <strong>Delivery Option:</strong> Courier<br>
                                    <strong>Order Date:</strong> {{ getDateFormat($order->created_at)}}

                                @else
                                    <strong>Payment Method: </strong>SSL COMMERZ<br>
                                    <strong>Payment status:</strong> paid<br>
                                    <strong>Delivery Option:</strong> Courier<br>
                                    <strong>Order Date:</strong> {{ getDateFormat($order->created_at)}}
                                    <strong>Payment Date:</strong> {{ getDateFormat($order->created_at)}}
                                @endif
                            </address>
                        </div>
                        <div class="col-sm-4 text-sm-right">
                            <address class="mt-2 mt-sm-0">
                                <strong>Shipped To:</strong><br>
                                @if(!is_null($shipping_address))
                                    <strong>Name: </strong>{{$order->customer_name}}<br>
                                    <strong>Phone: </strong>{{$order->customer_phone}}<br>

                                  {{--  <strong>Division: </strong>{{getDivisionNameFromId($shipping_address->division_id)}}
                                    <br>
                                    <strong>District: </strong>{{getDistrictNameFromId($shipping_address->district_id)}}
                                    <br>
                                    <strong>Upazila: </strong>{{getUpazilaNameFromId($shipping_address->upazila_id)}}
                                    <br>--}}
                                    <strong>Address: </strong>{{$shipping_address->customer_address}}
                                @endif
                            </address>
                        </div>
                    </div>
                    <div class="row">
                   {{--     <div class="col-sm-6 mt-3">
                            <address>
                                <strong>Payment Method: <span><small
                                            class="text-danger">{{$order->payment_type}}</small></span></strong><br>

                            </address>
                        </div>--}}
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
                                <th>Image</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                           {{--     <th>Delivery Status</th>--}}
                                <th>Total</th>
                            {{--    <th class="text-right">Commission</th>--}}
                                {{--<th>Status Details</th>--}}
                                {{--<th>Action</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td><a href="/admin/product/details/{{$product->product_id}}">{{$product->product_name}}</a></td>
                                    <td><img src="{{$product->featured_image}}" width="50px"/></td>
                                    <td>{{ getSizeFromId($product->size)}}</td>
                                    <td>{{ getColorFromId($product->color)}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->selling_price}}</td>
                                   {{-- <td>
                                        {{$product->status}}
                                    </td>--}}
                                    <td>৳ {{$product->total_price}}</td>
                                  {{--  <td class="text-right">{{$product->commission}}</td>--}}


                                  {{--  <td>
                                        <a href="/admin/order-status/history/{{$product->order_item_id}}" type="button"
                                           class="btn btn-primary btn-sm btn-rounded waves-effect waves-light text-white">
                                            Status Details
                                        </a>
                                    </td>--}}
                               {{--     <td>
                                        <div class="btn-group mr-1 mt-2">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            @include('includes.delivery_status.index')
                                        </div>

                                    </td>--}}
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
                                        ৳ {{$order->sub_total}}</h4></td>
                            </tr>

                            <tr>
                                <td colspan="4" class="border-0 text-right">
                                    <strong>Discount</strong></td>
                                <td class="border-0 text-right">৳ {{$order->discount}}</td>
                            </tr>

                            <tr>
                                <td colspan="4" class="border-0 text-right">
                                    <strong>Grand Total</strong></td>
                                <td class="border-0 text-right"><h4 class="m-0">৳ {{($order->sub_total - $order->discount)}}</h4></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-print-none mt-2">
                        <div class="float-right">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i
                                    class="fa fa-print"></i></a>
                             {{--<a href="/admin/order-invoice/print/{{$order->order_invoice}}" class="btn btn-primary w-md waves-effect waves-light">Print Invoice</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
