@extends('layouts.app')
@section('title', 'Create Company')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add Shop</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Shop</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <h4 class="card-title mb-4">Shop Information</h4>
                    <h4 class="card-title mb-4" style="float: right;margin-top: -50px;">Shop Owner Information</h4>

                    <form action="/admin/shop/store" method="post"
                          enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row mb-4">
                                    <label for="shop_name" class="col-sm-3 col-form-label">Name<span
                                            class="text-danger">*</span> </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="shop_name" name="shop_name"
                                               required>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    </div>
                                </div>



                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">Division </label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="division_id">
                                            @foreach(\Devfaysal\BangladeshGeocode\Models\Division::all() as $division)

                                                <option value="{{$division->id}}" selected>{{$division->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">District </label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="district_id">
                                            @foreach(\Devfaysal\BangladeshGeocode\Models\District::all() as $district)

                                                <option value="{{$district->id}}" selected>{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">Upazila </label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="upazila_id">
                                            @foreach(\Devfaysal\BangladeshGeocode\Models\Upazila::all() as $upazila)

                                                <option value="{{$upazila->id}}" selected>{{$upazila->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_address" class="col-sm-3 col-form-label">Address<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                            <textarea type="text" class="form-control" id="shop_address"
                                                      name="shop_address" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">Trade Lisence </label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="trade_licence" name="image">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">Commission Rate </label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="commission_rate"
                                               name="commission_rate">
                                    </div>
                                </div>

                            </div>


                            <div class="col-lg-6">
                                <div class="form-group row mb-4">
                                    <label for="user_title" class="col-sm-3 col-form-label">Owner Name<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="user_name" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="shop_phone" class="col-sm-3 col-form-label">Phone<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="user_phone" name="user_phone"
                                               required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="user_email" name="user_email"
                                               required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">NID<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nid" name="user_nid" required>
                                    </div>
                                </div>


                                <div class="form-group row mb-4">
                                    <label for="user_url" class="col-sm-3 col-form-label">Password<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="user_url" name="user_password"
                                               required>
                                    </div>
                                </div>


                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                        </div>
                                    </div>
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
