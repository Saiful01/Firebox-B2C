@extends('layouts.common')
@section('title', 'Merchant Password Reset')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <ul class="nav">
                            <li><a href="/">Home</a></li>
                            <li>Password Recovery</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="login-register-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active" data-toggle="tab" href="#lg1">
                                <h4>Forgot your password?</h4>
                            </a>
                        </div>
                        @include('includes.message')
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <form action="/merchant/reset-password" method="post">
                                            <input type="hidden" name="_token" placeholder="Phone Number"
                                                   value="{{csrf_token()}}">
                                            <div class="row">
                                                <div class="col-8 col-md-9">
                                                    <input type="phone" name="phone" placeholder="Phone"
                                                           ng-model="phone_number" required=""
                                                           class="">
                                                </div>

                                                <div class="col-4 col-md-3" id="otp_button">
                                                    <button class="btn btn-dark current-btn btn-block" type="button"
                                                            ng-click="passResetOtpSend()"><span>Send OTP</span>
                                                    </button>
                                                </div>

                                                <div class="col-4 col-md-3" id="otp_counter" style="display: none">
                                                    Sent(<span id="timer">0</span>)
                                                </div>
                                            </div>
                                            <input name="otp" placeholder="OTP" ng-model="otp" type="text" required="">
                                            <input name="new_password" placeholder="New Password" id="pass"  type="password" required="" onkeyup='check();'>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <input type="password" name="confirm_password"
                                                           id="confirm_password" placeholder="Confirm Password" onkeyup='check();'>

                                                </div>
                                                <div class="col-md-2">
                                                    <span id='message'></span>
                                                </div>
                                            </div>
                                            <div class="button-box">
                                                <button type="submit"><span>Submit</span></button>
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


