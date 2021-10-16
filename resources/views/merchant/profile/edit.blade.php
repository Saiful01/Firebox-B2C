@extends('layouts.merchant')
@section('title', 'Update Profile')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Profile</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
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

                    <h4 class="card-title mb-4">Profile Info</h4>

                    <form action="/merchant/profile/update" method="post"
                          enctype="multipart/form-data">
                        <div class="form-group row mb-4">
                            <label for="coupon_code" class="col-sm-3 col-form-label">Name</label>
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="coupon_code" name="name"
                                       value="{{$result->name}}">
                                <input type="hidden" name="id" value="{{$result->id}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="discount_rate" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="discount_rate" name="phone"
                                       value="{{$result->phone}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{$result->email}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">NID No</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="nid"
                                       value="{{$result->nid}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">Date Of Birth</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="email" name="dob"
                                       value="{{$result->dob}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>


                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if(!\Illuminate\Support\Facades\Auth::user()->user_type == 2)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">

                        @include('includes.message')

                        <h4 class="card-title mb-4">Shop Info</h4>

                        <form action="/merchant/shop/update" method="post"
                              enctype="multipart/form-data">
                            <div class="form-group row mb-4">
                                <label for="shop_name" class="col-sm-3 col-form-label">Name<span
                                        class="text-danger">*</span> </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="shop_name" name="shop_name"
                                           value="{{$shop->shop_name}}" required>
                                    <input type="hidden" class="form-control" id="shop_name" name="shop_id"
                                           value="{{$shop->shop_id}}" required>
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="shop_phone" class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="shop_phone" name="shop_phone"
                                           value="{{$shop->shop_phone}}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="shop_email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="shop_email" name="shop_email"
                                           value="{{$shop->shop_email}}" required>
                                </div>
                            </div>


                            <div class="form-group row mb-4">
                                <label for="shop_email" class="col-sm-3 col-form-label">Commission Rate<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input readonly type="number" class="form-control " id="commission_rate"
                                           name="commission_rate" value="{{$shop->commission_rate}}">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="shop_address" class="col-sm-3 col-form-label">Address<span
                                        class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="shop_address" name="shop_address"
                                           value="{{$shop->shop_address}}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="shop_details" class="col-sm-3 col-form-label">Details</label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="shop_details"
                                              name="shop_details">{{$shop->shop_details}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="shop_email" class="col-sm-3 col-form-label">Trade Licence</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="licence">
                                </div>
                            </div>

                            <div class="form-group row mb-4">
                                <label for="shop_address" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>


                            <div class="form-group row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

    </div>
    <!-- end row -->

@stop
