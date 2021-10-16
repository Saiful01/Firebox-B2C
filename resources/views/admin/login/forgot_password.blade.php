<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8"/>
    <title>Password Reset | Mart Venue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>

</head>

<body ng-app="MartVenueApp" ng-controller="productController">
<div class="home-btn d-none d-sm-block">
    <a href="#" class="text-dark"><i class="fas fa-home h2"></i></a>
</div>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">


                <div class="card overflow-hidden">

                    @include('includes.message')
                    <div class="bg-soft-primary">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-4">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p>Reset Your Password.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="/assets/images/profile-img.png" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div>
                            <a href="#">
                                <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="/assets/images/logo.svg" alt="" class="rounded-circle"
                                                     height="34">
                                            </span>
                                </div>
                            </a>
                        </div>
                        <div class="p-2">
                            <form class="form-horizontal" action="/admin/reset-password" method="post"
                                  enctype="multipart/form-data">


                                    <input type="hidden" class="form-control" value="{{csrf_token()}}" name="_token">

                                <div class="row">
                                    <div class="col-8 col-md-9">
                                        <input class="form-control"  type="phone" name="phone" placeholder="Phone"
                                               ng-model="phone_number" required=""
                                               class="">
                                    </div>

                                    <div class="col-4 col-md-3" id="otp_button">
                                        <button class="btn btn-dark current-btn btn-block" class="form-control"  type="button"
                                                ng-click="passResetOtpSend()"><span>Send OTP</span>
                                        </button>
                                    </div>

                                    <div class="col-4 col-md-3" id="otp_counter" style="display: none">
                                        Sent(<span id="timer">0</span>)
                                    </div>
                                </div>
                                <input class="form-control mt-2" name="otp" placeholder="OTP" ng-model="otp" type="text" required="">
                                <input class="form-control mt-2"  name="new_password" placeholder="New Password"  type="text" required="">

                                <div class="mt-3">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Save
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="mt-5 text-center">

                    <div>
                        {{-- <p>Don't have an account ? <a href="customer-register.html" class="font-weight-medium text-primary">
                                 Signup now </a></p>--}}
                        <p>© 2020 Developed <i class="mdi mdi-heart text-danger"></i> by PLab</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>

<!-- App js -->
<script src="/assets/js/app.js"></script>
<script src="/js/cart.js"></script>
</body>
</html>
