@extends('layouts.app')
@section('title', 'Create Coupon')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add Coupon</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Coupon</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <h4 class="card-title mb-4">Coupon Info</h4>

                    <form action="/admin/coupon/store" method="post"
                          enctype="multipart/form-data">
                        <div class="form-group row mb-4">
                            <label for="coupon_code" class="col-sm-3 col-form-label">Coupon Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="coupon_code" name="coupon_code" required>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="discount_rate" class="col-sm-3 col-form-label">Discount Amount</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="discount_rate" name="discount_rate" required>
                            </div>
                        </div>
                       {{-- <div class="form-group row mb-4">
                            <label for="expire_date" class="col-sm-3 col-form-label">Max Discount</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="max_discount" name="max_discount" required>
                            </div>
                        </div>--}}
                        <div class="form-group row mb-4">
                            <label for="expire_date" class="col-sm-3 col-form-label">Expire Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="expire_date" name="expire_date" required>
                            </div>
                        </div>

                        {{--<div class="form-group row mb-4">
                            <label for="expire_date" class="col-sm-3 col-form-label">Customer</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="customer_id">
                                    <option value="">For All</option>
                                    @foreach($customers as $customer)
                                        <option value="{{$customer->customer_id}}">{{$customer->customer_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>--}}


                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

@stop
