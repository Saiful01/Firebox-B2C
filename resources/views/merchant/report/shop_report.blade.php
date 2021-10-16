@extends('layouts.merchant')
@section('title', 'Shop Payment Report ')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Shop Payment Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/merchant/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Shop Payment Report</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-copy-alt"></i>
                                                        </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Total Sell <small></small></h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{$grand_total_sell}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"> All Time</span> <span class="ms-2 text-truncate"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-archive-in"></i>
                                                        </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Total Commission</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{$grand_total_commission}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"> All Time</span> <span class="ms-2 text-truncate"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

{{--
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-archive-in"></i>
                                                        </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Total Orders</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{count($results)}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"> All Time</span> <span class="ms-2 text-truncate"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
--}}

                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-archive-in"></i>
                                                        </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Paid Amount</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{$paid_amount}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"> All Time</span> <span class="ms-2 text-truncate"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-archive-in"></i>
                                                        </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Total Due</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{$due}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>
                                <div class="d-flex">
                                    <span class="badge badge-soft-success font-size-12"> All Time</span> <span class="ms-2 text-truncate"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end row -->
        </div>
    </div>



    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title"> Shop Payment Report Info <small>(Total Orders: <span class="badge badge-info">{{count($results)}}</span>)</small></h4>
                            <br>
                        </div>


                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Order Invoice</th>
                            <th>Price</th>
                            <th>Commission Rate</th>
                            <th>Commission</th>
                           {{-- <th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=1
                        @endphp

                        @foreach($results as $result)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>#{{$result->order_invoice}}</td>
                                <td>{{$result->selling_price}}</td>
                                <td>{{$result->commission_rate}}</td>
                                <td>{{$result->total_commission}}</td>

                          {{--      <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" href="/admin/payment/send/{{$result->shop_id}}">Send</a>
                                        </div>
                                    </div>

                                </td>--}}
                            </tr>

                            @php
                                $i++
                            @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@stop
