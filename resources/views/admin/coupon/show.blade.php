@extends('layouts.app')
@section('title', 'Show Customer')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add Customer</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Customer</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Customer Info <span> <a href="/admin/coupon/create"
                                                                           class="btn btn-primary btn-sm pull-right float-right">+New</a></span>
                            </h4>
                            <br>
                        </div>


                    </div>


                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Discount</th>
                           {{-- <th>Max Discount</th>--}}
                            <th>Expire</th>
                        {{--    <th>Customer</th>--}}
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                        @foreach($results as $result)

                            <tr>
                                <td>#</td>
                                <td>{{$result->coupon_code}}</td>
                                <td>{{$result->discount_rate}}</td>
                              {{--  <td>{{$result->max_discount}}</td>--}}
                                <td>{{$result->expire_date}}</td>
                               {{-- <td>{{getCustomerFromId($result->customer_id)}}</td>--}}
                                <td>@if($result->active_status) <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Inactive</span>@endif</td>

                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" href="/admin/coupon/edit/{{$result->coupon_id}}">Edit</a>
                                            <a class="dropdown-item" href="/admin/coupon/delete/{{$result->coupon_id}}">Delete</a>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@stop
