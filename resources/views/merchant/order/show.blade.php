@extends('layouts.merchant')
@section('title', 'Order Show')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="get" action="/merchant/order/show" class="ng-pristine ng-valid">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="order_invoice" class="form-control"
                                       placeholder='Order Invoice'>

                            </div>
                            <div class="col-md-3">
                                <input type="text" name="customer_phone" class="form-control"
                                       placeholder='Customer Phone'>

                            </div>
                            <div class="col-md-3">

                                <select class="form-control" name="is_whole_sale">
                                    <option value="">All</option>
                                    <option value="1">Whole Sale</option>
                                    <option value="0">Retail</option>

                                </select>

                            </div>


                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Search
                                </button>

                            </div>


                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <div class="table-responsive">
                        <table class="table table-centered table-nowrap">
                            <thead class="thead-light">
                            <tr>
                                <th style="width: 20px;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Tracking Number</th>
                                <th>Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Payment</th>
                                {{--  <th>Payable Amount</th>--}}
                                <th>Payment Status</th>
                               {{-- <th>Order Status</th>--}}
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $result)
                                <tr class="mx-auto">
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                                            <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="/merchant/order/details/{{$result->order_invoice}}"
                                           class="text-body font-weight-bold">#{{$result->order_invoice}}</a>
                                    </td>
                                    <td>{{$result->customer_name}}</td>
                                    <td>{{$result->customer_phone}}</td>
                                    <td>{{$result->product_price}}</td>
                                    <td>{{$result->discount+$result->coupon}}</td>
                                    <td>
                                        <span class="badge badge-success">{{$result->payment_type}}</span>
                                    </td>

                                    <td>
                                        @if($result->payment_status==0)
                                            <span class="badge badge-pill badge-soft-warning font-size-12">Pending</span>
                                        @elseif($result->payment_status==1)
                                            <span class="badge badge-pill badge-soft-success font-size-12">Success</span>

                                        @else
                                            <span class="badge badge-pill badge-soft-danger font-size-12">Failed</span>
                                        @endif
                                    </td>
                          {{--          <td>

                                        @if($result->order_status==1)
                                            <span class="badge badge-pill badge-soft-success font-size-12">Active</span>
                                        @elseif($result->order_status==0)
                                            <span class="badge badge-pill badge-soft-danger font-size-12">Cancelled</span>
                                        @endif
                                    </td>--}}
                                    <td>

                                        <div class="btn-group mr-1 mt-2">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <a class="dropdown-item" href="/merchant/order/details/{{$result->order_invoice}}">Details</a>
                                               {{-- <a class="dropdown-item" href="#">Cancelled</a>--}}

                                            </div>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                            {{$results->links()}}

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@stop
