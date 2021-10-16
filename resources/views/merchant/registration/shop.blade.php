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
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="login-register-area mtb-60px">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active">
                                <h4>Merchant Register</h4>
                            </a>
                        </div>
                        @include('includes.message')

                        <div class="login-form-container">
                            <div class="login-register-form">
                                <form action="/merchant/register/shop/store" method="post">
                                    @csrf
                                    <h4>Your Shop Details</h4><br>
                                    <input type="text" name="name" placeholder="Shop Name">
                                    <input type="hidden" name="user_id"  value="{{$user_id}}">
                                    <input type="phone" name="phone" placeholder="Shop Phone">
                                    <input name="email" placeholder="Email" type="Shop Email">
                                    <textarea class="form-control mb-2" rows="5" type="text" name="shop_address" placeholder="Shop Address">Shop Address
                                    </textarea>
                                    <textarea class="form-control mb-2" rows="5" type="text" name="shop_details" placeholder="Shop details"> Shop details
                                    </textarea>
                                    <input type="text" name="trade_licence" placeholder="Trade License">
                                    <h6>Division</h6><br>
                                    <select class="form-control select2" name="division">
                                        @foreach(\Devfaysal\BangladeshGeocode\Models\Division::all() as $division)

                                            <option value="{{$division->id}}" selected>{{$division->name}}</option>
                                        @endforeach
                                    </select><br>
                                    <h6>District</h6><br>
                                    <select class="form-control select2" name="district">
                                        @foreach(\Devfaysal\BangladeshGeocode\Models\District::all() as $division)

                                            <option value="{{$division->id}}" selected>{{$division->name}}</option>
                                        @endforeach
                                    </select><br>
                                    <h6>Upazila</h6><br>
                                    <select class="form-control select2" name="upazila">
                                        @foreach(\Devfaysal\BangladeshGeocode\Models\Upazila::all() as $division)

                                            <option value="{{$division->id}}" selected>{{$division->name}}</option>
                                        @endforeach
                                    </select><br>

                                    <div class="button-box">
                                        <button type="submit"><span>Register</span></button>
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

@endsection


