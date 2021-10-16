@extends('layouts.app')
@section('title', 'Create Company')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add Company</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Company</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <h4 class="card-title mb-4">Company Info</h4>

                    <form action="/company/shop/store" method="post"
                          enctype="multipart/form-data">
                        <div class="form-group row mb-4">
                            <label for="shop_name" class="col-sm-3 col-form-label">Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="shop_name" name="shop_name" required>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="shop_phone" class="col-sm-3 col-form-label">Phone<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="shop_phone" name="shop_phone" required>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="shop_email" class="col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="shop_email" name="shop_email" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="shop_address" class="col-sm-3 col-form-label">Address<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="shop_address" name="shop_address" required>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="shop_details" class="col-sm-3 col-form-label">Details</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="shop_details"
                                          name="shop_details"></textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="shop_address" class="col-sm-3 col-form-label">Shop Type</label>
                            <div class="col-sm-9">
                                <label for="">Shop Type</label>
                                <select class="form-control " name="shop_type">
                                    <option>Select</option>
                                    @foreach (getEntity() as $key => $value)
                                        <option value="{{ $key}}">{{$value}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4" style="display: none">
                            <label for="shop_address" class="col-sm-3 col-form-label">Admin</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                            </div>
                        </div>


                        <div class="form-group row mb-4">
                            <label for="shop_address" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="shop_image" name="image">
                            </div>
                        </div>


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
