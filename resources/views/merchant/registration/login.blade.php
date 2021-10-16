@extends('layouts.common')
@section('title', 'Login')



@section('content')

    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <ul class="nav">
                            <li><a href="/">Home</a></li>
                            <li>Merchant Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="login-register-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active" data-toggle="tab" href="#lg1">
                                <h4>Merchant Login</h4>
                            </a>
                            <a data-toggle="tab" href="#lg2" class="">
                                <h4>Register</h4>
                            </a>
                        </div>
                        @include('includes.message')
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form class="form-horizontal" action="/admin/login-check" method="post"
                                              enctype="multipart/form-data">
                                            <input type="hidden" name="_token" placeholder="Phone Number"
                                                   value="{{csrf_token()}}">
                                            {{--  <input type="hidden" name="last_page" placeholder="Phone Number"
                                                     value="{{$callback_page}}">--}}
                                            <input type="number" name="phone" placeholder="Phone Number" required>
                                            <input type="password" name="password" placeholder="Password" required>
                                            <div class="button-box">

                                                <div class="login-toggle-btn">

                                                    <a href="/merchant/forget-password">Forgot Password?</a>
                                                </div>


                                                <button type="submit"><span>Login</span></button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8 mx-auto">
                                            <p> Don't have any account? <a data-toggle="tab" href="#lg2">Sign Up</a></p>

                                        </div>


                                    </div>

                                </div>
                            </div>


                            <div id="lg2" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="/merchant/registration/store" method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <h4>Your Shop Details</h4><br>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Shop Name <span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="shop_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Shop Address<span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                    <textarea class="form-control" type="text" name="shop_address"
                                                              required>
                                                    </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Division<span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <select class="form-control" name="division_id"
                                                                        ng-model="division_id"
                                                                        ng-change="changeDivision()"
                                                                        ng-init="getDivisions()" required>

                                                                    <option value="@{{division.id}}"
                                                                            ng-repeat="division in division_list">
                                                                        @{{division.name}}
                                                                    </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            District<span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <select class="form-control" name="district_id"
                                                                        ng-model="district_id"
                                                                        ng-change="changeDistrict()" required>

                                                                    <option value="@{{district.id}}"
                                                                            ng-repeat="district in district_list">
                                                                        @{{district.name}}
                                                                    </option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Police Station<span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <select class="form-control" name="upazila_id" required>
                                                                    <option value="@{{upazila.id}}"
                                                                            ng-repeat="upazila in upazila_list">
                                                                        @{{upazila.name}}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Trade License<span class="text-danger"></span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="file" name="image">
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- <input type="phone" name="shop_phone" placeholder="Shop phone">
                                                     <input type="text" name="shop_address" placeholder="Address" required>--}}


                                                </div>
                                                <div class="col-md-6">

                                                    <h4>Your Personal Details</h4><br>
                                                    <input name="_token" value="{{csrf_token()}}" type="hidden"/>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Name<span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Phone<span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="phone" name="phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Email<span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input name="email" type="Email" required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Password<span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="password" name="password" id="pass"
                                                                   onkeyup='check();'
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Confirm Password<span class="text-danger">*</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="password"
                                                                   name="confirm_password" id="confirm_password"
                                                                   onkeyup='check();'
                                                                   required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <span id='message'></span>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            NID NO<span class="text-danger"></span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" name="nid">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="button-box ">
                                                                <button type="submit" class=""><span>Register</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <input type="password" name="customer_confirm_password"
                                                            placeholder=" Confirm Password" required>

                                                     <input type="date" name="dob" placeholder="Date Of Birth" required>--}}
                                                </div>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection


