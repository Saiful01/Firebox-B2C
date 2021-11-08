@extends('layouts.common')
@section('title', "Profile")
@section('content')


    <main class="main">
        <!-- Start of Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title mb-0">My Account</h1>
            </div>
        </div>
        <!-- End of Page Header -->

        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="/">Home</a></li>
                    <li>My account</li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->
    @include('includes.message')

    <!-- Start of PageContent -->
        <div class="page-content pt-2">
            <div class="container">
                <div class="tab tab-vertical row gutter-lg">
                    <ul class="nav nav-tabs mb-6" role="tablist">
                        <li class="nav-item">
                            <a href="#account-dashboard" class="nav-link active">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="#account-orders" class="nav-link">Orders</a>
                        </li>

                        <li class="nav-item">
                            <a href="#account-addresses" class="nav-link">Addresses</a>
                        </li>
                        <li class="nav-item">
                            <a href="#account-details" class="nav-link">Account details</a>
                        </li>

                    </ul>

                    <div class="tab-content mb-6">
                        <div class="tab-pane active in" id="account-dashboard">
                            <p class="greeting">
                                Hello
                                <span class="text-dark font-weight-bold">{{$result->customer_name}}</span>
                            </p>

                            <p class="mb-4">
                                From your account dashboard you can view your <a href="#account-orders"
                                                                                 class="text-primary link-to-tab">recent
                                    orders</a>,
                                manage your <a href="#account-addresses" class="text-primary link-to-tab">shipping
                                    and billing
                                    addresses</a>, and
                                <a href="#account-details" class="text-primary link-to-tab">edit your password and
                                    account details.</a>
                            </p>

                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-orders" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-orders">
                                                    <i class="w-icon-orders"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Orders</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-addresses" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-address">
                                                    <i class="w-icon-map-marker"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Addresses</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="#account-details" class="link-to-tab">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-account">
                                                    <i class="w-icon-user"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Account Details</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                    <a href="/customer/logout">
                                        <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-logout">
                                                    <i class="w-icon-logout"></i>
                                                </span>
                                            <div class="icon-box-content">
                                                <p class="text-uppercase mb-0">Logout</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane mb-4" id="account-orders">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                                </div>
                            </div>

                            <table class="shop-table account-orders-table mb-6">
                                <thead>
                                <tr>
                                    <th class="order-id">Order Invoice</th>
                                    <th class="order-date">Date</th>
                                    <th class="order-status">Status</th>
                                    <th class="order-total">Total</th>
                                    <th class="order-total">Shipping</th>

                                </tr>
                                </thead>

                                <tbody>
                                @foreach($orders as $res)
                                    <tr>
                                        <td class="order-id">#{{$res->order_invoice}}</td>
                                        <td class="order-date">{{getDateFormat($res->created_at) }}</td>
                                        <td class="order-status">
                                            @if($res->status== "Previous Order")
                                                <span
                                                    class="badge badge-pill badge-soft-dark font-size-12">Previous Order</span>
                                            @elseif($res->status=="Pending")
                                                <span
                                                    class="badge badge-pill badge-soft-Primary font-size-12">Pending</span>
                                            @elseif($res->status=="Accepted")
                                                <span class="badge badge-pill badge-soft-info font-size-12">Accepted</span>
                                            @elseif($res->status=="Ready For Pickup")
                                                <span class="badge badge-pill badge-soft-warning font-size-12">Ready For Pickup</span>
                                            @elseif($res->status=="On The Way")
                                                <span
                                                    class="badge badge-pill badge-soft-secondary font-size-12">On The Way</span>
                                            @elseif($res->status=="Delivered")
                                                <span
                                                    class="badge badge-pill badge-soft-success font-size-12">Delivered</span>
                                            @elseif($res->status=="Returned")
                                                <span
                                                    class="badge badge-pill badge-soft-danger font-size-12">Returned</span>
                                            @else


                                            @endif


                                        </td>
                                        <td class="order-total">
                                            <span class="order-price">{{$res->total}}</span> for
                                            <span
                                                class="order-quantity">{{getOrderItemCount($res->order_invoice)}}</span>
                                            item
                                        </td>
                                        <td class="order-total">
                                        <span class="order-price">{{$res->shipping_cost}} TK
                                        </span>
                                        </td>

                                    </tr>

                                @endforeach
                                </tbody>
                            </table>

                            <a href="/" class="btn btn-dark btn-rounded btn-icon-right">Go
                                Shop<i class="w-icon-long-arrow-right"></i></a>
                        </div>


                        <div class="tab-pane" id="account-addresses">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-map-marker">
                                        <i class="w-icon-map-marker"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">Addresses</h4>
                                </div>
                            </div>
                            <p>The following addresses will be used on the checkout page
                                by default.</p>
                            @foreach($address as $res)
                                <div class="">
                                    <form class="form account-details-form" action="/customer/address/update"
                                          method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$res->id}}">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Address Type*</label>
                                                    <input type="text" name="customer_address_type"
                                                           placeholder="Home/ Office/ Other"
                                                           class="form-control form-control-md"
                                                           value="{{$res->customer_address_type}}">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group mb-6">
                                                    <label for="email_1">Address *</label>
                                                    <input type="text" name="customer_address"
                                                           class="form-control form-control-md"
                                                           value="{{$res->customer_address}}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4 mt-5">Save
                                                    Changes
                                                </button>
                                            </div>

                                        </div>


                                    </form>
                                </div>
                            @endforeach


                            <div class="icon-box-content">
                                <h4 class="icon-box-title mb-0 ls-normal"> New Address Create</h4>
                            </div>
                            <div class="">
                                <form class="form account-details-form" action="/customer/address/update"
                                      method="post">
                                    <input type="hidden" name="customer_id" value="{{$result->customer_id}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Address Type*</label>
                                                <input type="text" name="customer_address_type"
                                                       placeholder="Home/ Office/ Other"
                                                       class="form-control form-control-md">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-6">
                                                <label for="email_1">Address *</label>
                                                <input type="text" name="customer_address"
                                                       class="form-control form-control-md"
                                                >
                                            </div>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save

                                    </button>
                                </form>
                            </div>

                        </div>

                        <div class="tab-pane" id="account-details">
                            <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-account mr-2">
                                        <i class="w-icon-user"></i>
                                    </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
                                </div>
                            </div>
                            <form class="form account-details-form" action="/customer/profile/update" method="post">
                                @csrf
                                <input type="hidden" name="customer_id" value="{{$result->customer_id}}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First name *</label>
                                            <input type="text" name="customer_name" placeholder="John"
                                                   class="form-control form-control-md"
                                                   value="{{$result->customer_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-6">
                                            <label for="email_1">Phone *</label>
                                            <input type="number" name="customer_phone"
                                                   class="form-control form-control-md"
                                                   value="{{$result->customer_phone}}">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-6">
                                            <label>Email</label>
                                            <input type="email" name="customer_email"
                                                   class="form-control form-control-md"
                                                   value="{{$result->customer_email}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-6">
                                            <label for="email_1">Profile Pic</label>
                                            <input type="file" id="email_1" name="customer_image"
                                                   class="form-control form-control-md">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes</button>
                            </form>


                            <div class="">
                                <form class="form account-details-form" action="/customer/password/update"
                                      method="post">
                                    @csrf
                                    <input type="hidden" name="customer_id" value="{{$result->customer_id}}">
                                    <h4 class="title title-password ls-25 font-weight-bold">Password change</h4>
                                    <div class="form-group">
                                        <label class="text-dark" for="cur-password">Current Password </label>
                                        <input type="password" class="form-control form-control-md" id="cur-password"
                                               name="cur_password">
                                    </div>
                                    <div class="form-group">
                                        <label class="text-dark" for="new-password">New Password </label>
                                        <input type="password" class="form-control form-control-md" id="new-password"
                                               name="new_password">
                                    </div>
                                    <div class="form-group mb-10">
                                        <label class="text-dark" for="conf-password">Confirm Password</label>
                                        <input type="password" class="form-control form-control-md" id="conf-password"
                                               name="new_confirm_password">
                                    </div>
                                    <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Save Changes
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>

@endsection
