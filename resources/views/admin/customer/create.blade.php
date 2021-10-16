@extends('layouts.app')
@section('title', 'Create Customer')

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

                    <h4 class="card-title">Basic Information</h4>
                    {{-- <p class="card-title-desc">Fill all information below</p>--}}

                    <form class="form-horizontal" action="/admin/customer/store" method="post"
                          enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="customer_name"> Name <span class="text-danger">*</span></label>
                                    <input id="customer_name" name="customer_name" type="text" class="form-control"
                                           required>
                                    <input name="_token" type="hidden" value="{{csrf_token()}}">
                                </div>
                                <div class="form-group">
                                    <label for="customer_phone"> Phone<span class="text-danger">*</span></label>
                                    <input id="customer_phone" name="customer_phone" type="text" class="form-control"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="customer_email">Email<span class="text-danger">*</span></label>
                                    <input id="customer_email" name="customer_email" type="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="customer_password">Password</label>
                                    <input id="customer_password" name="customer_password" type="password"
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <select class="form-control select2" name="customer_city">
                                        <option>Select</option>
                                        <option>Dhaka</option>
                                        <option>Outside Dhaka</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Newsletter</label>
                                    <select class="form-control" name="is_newsletter_enable">
                                        <option value="1">Enable</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address">Personal Address</label>
                                    <textarea class="form-control" id="personal_address" name="customer_personal_address" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address">Billing Address</label>
                                    <textarea class="form-control" id="billing_address" name="customer_billing_address" rows="5"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address">Shipping Address</label>
                                    <textarea class="form-control" id="shipping_address" name="customer_shipping_address" rows="5"></textarea>
                                </div>

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Save Changes
                        </button>
                     {{--   <button type="submit" class="btn btn-secondary waves-effect">Cancel</button>--}}
                    </form>

                </div>
            </div>


        </div>
    </div>
    <!-- end row -->

@stop
