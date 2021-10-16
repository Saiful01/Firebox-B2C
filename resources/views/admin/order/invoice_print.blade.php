@extends('layouts.app')
@section('title', 'Invoice Print')

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
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 font-weight-bold">Order summary</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                            <tr>
                                <th style="width:70px;">No.</th>
                                <th>Item</th>
                                <th>Shop Name</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->shop_name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->selling_price}}</td>
                                    <td>৳ {{$product->total_price}}</td>
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
                                        ৳ {{$order->total+$order->shipping_cost}}</h4></td>
                            </tr>

                            <tr>
                                <td colspan="4" class="border-0 text-right">
                                    <strong>Discount</strong></td>
                                <td class="border-0 text-right">৳ {{$order->discount}}</td>
                            </tr>

                            <tr>
                                <td colspan="4" class="border-0 text-right">
                                    <strong>Grand Total</strong></td>
                                <td class="border-0 text-right"><h4 class="m-0">৳ {{$order->sub_total}}</h4></td>
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
