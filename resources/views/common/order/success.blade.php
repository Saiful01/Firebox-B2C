@extends('layouts.common')
@section('title', "Cart")
@section('content')

    <main class="main order">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="passed"><a href="#">Shopping Cart</a></li>
                    <li class="active"><a href="#">Order Complete</a></li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content mb-10 pb-2">
            <div class="container">
                <div class="order-success text-center font-weight-bolder text-dark">
                    <i class="fas fa-check"></i>
                    Thank you. Your order has been received.
                </div>
                <!-- End of Order Success -->

                <ul class="order-view list-style-none">
                    <li>
                        <label>Order number</label>
                        <strong>{{$order->order_invoice}}</strong>
                    </li>
                    <li>
                        <label>Status</label>
                        <strong>Pending</strong>
                    </li>
                    <li>
                        <label>Date</label>
                        <strong>{{getDateFormat($order->created_at)}}</strong>
                    </li>
                    <li>
                        <label>Total</label>
                        <strong>{{$order->sub_total}} BDT</strong>
                    </li>
                    <li>
                        <label>Payment method</label>
                        <strong>{{$order->payment_type}}</strong>
                    </li>
                </ul>
                <!-- End of Order View -->


                <div id="account-addresses">
                    <div class="row">
                        <div class="col-sm-6 mb-8">
                            <div class="ecommerce-address billing-address">
                                <h4 class="title title-underline ls-25 font-weight-bold">Billing Address</h4>
                                <address class="mb-4">
                                    <table class="address-table">
                                        <tbody>

                                        <tr>
                                            <td>{{$order->customer_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{$order->customer_address}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{$order->customer_email}}</td>
                                        </tr>
                                        <tr>
                                            <td>{{$order->customer_phone}}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </address>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End of Account Address -->

                <a href="/" class="btn btn-dark btn-rounded btn-icon-left btn-back mt-6"><i class="w-icon-long-arrow-left"></i>Back To Home</a>
            </div>
        </div>
        <!-- End of PageContent -->
        <script type="text/javascript">
            localStorage.clear();
        </script>

    </main>

@endsection
