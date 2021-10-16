@extends('layouts.app')
@section('title', 'Edit Customer')

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

                    <form class="form-horizontal" action="/admin/customer/update" method="post"
                          enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="customer_name"> Name</label>
                                    <input id="customer_name" name="customer_name" type="text" class="form-control" value="{{$result->customer_name}}"
                                           required>
                                    <input name="_token" type="hidden" value="{{csrf_token()}}">
                                    <input name="customer_id" type="hidden" value="{{$result->customer_id}}">
                                </div>
                                <div class="form-group">
                                    <label for="customer_phone"> Phone</label>
                                    <input id="customer_phone" name="customer_phone" type="text" class="form-control" value="{{$result->customer_phone}}"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="customer_email">Email</label>
                                    <input id="customer_email" name="customer_email" type="email" class="form-control" value="{{$result->customer_email}}">
                                </div>
                                <div class="form-group">
                                    <label for="customer_password">Password</label>
                                    <input id="customer_password" name="customer_password" type="password"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <select class="form-control select2" name="customer_city">
                                        <option>Select</option>
                                        <option @if($result->customer_city=="Dhaka") selected @endif>Dhaka</option>
                                        <option @if($result->customer_city=="Outside Dhaka") selected @endif>Outside Dhaka</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Newsletter</label>
                                    <select class="form-control" name="is_newsletter_enable">
                                        <option value="1" @if($result->is_newsletter_enable==1) selected @endif>Enable</option>
                                        <option value="0" @if($result->is_newsletter_enable==0) selected @endif>Disable</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="address">Personal Address</label>
                                    <textarea class="form-control" id="personal_address" name="customer_personal_address" rows="5">{{$result->customer_personal_address}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address">Billing Address</label>
                                    <textarea class="form-control" id="billing_address" name="customer_billing_address" rows="5">{{$result->customer_billing_address}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address">Shipping Address</label>
                                    <textarea class="form-control" id="shipping_address" name="customer_shipping_address" rows="5">{{$result->customer_shipping_address}}</textarea>
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