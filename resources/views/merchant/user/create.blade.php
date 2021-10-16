@extends('layouts.merchant')
@section('title', 'Create User')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add User</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/merchant/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add User</li>
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

                    <h4 class="card-title mb-4">User Info</h4>

                    <form action="/merchant/user/store" method="post"
                          enctype="multipart/form-data">
                        <div class="form-group row mb-4">
                            <label for="user_title" class="col-sm-3 col-form-label">User Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" required>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="user_sub_title" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone" required/>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="user_url" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="user_url" name="email" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">NID No</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="nid">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="email" class="col-sm-3 col-form-label">Date Of Birth</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="email" name="dob">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="user_url" class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="user_type">
                                    <option value="2">Shop owner</option>
                                    <option value="3">System Operator</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="user_url" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="user_url" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Save</button>
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
