@extends('layouts.app')
@section('title', 'Shop Payment Report ')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Shop Payment Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
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
                <div class="col-sm-4">
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

                {{--<div class="col-sm-4">
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
                </div>--}}

              {{--  <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="avatar-xs me-3">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-18">
                                                            <i class="bx bx-purchase-tag-alt"></i>
                                                        </span>
                                </div>
                                <h5 class="font-size-14 mb-0">Total Shops</h5>
                            </div>
                            <div class="text-muted mt-4">
                                <h4>{{$total_shop}} <i class="mdi mdi-chevron-up ms-1 text-success"></i></h4>


                            </div>
                        </div>
                    </div>
                </div>--}}


            </div>
            <!-- end row -->
        </div>
    </div>


    {{--<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title"> Shop Payment Report Info</h4>
                            <br>
                        </div>


                    </div>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Shop Name</th>
                            <th>Total sell</th>
                            <th>Total Commission</th>
                            <th>Action</th>
                            --}}{{--     <th>Action</th>--}}{{--
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=1
                        @endphp

                        @foreach($results as $result)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{$result->shop_name}}</td>
                                <td>{{$result->total_sell}}</td>
                                <td>{{$result->total_commision}}</td>
                                --}}{{--    <td>
                                        @if($result->commission_rate == 0)
                                            <span> 0</span>
                                        @else
                                            {{($result->selling_price * $result->commission_rate)/ 100}}
                                        @endif

                                    </td>--}}{{--
                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" href="/admin/shop-report/show/{{$result->shop_id}}">Details</a>
                                        </div>
                                    </div>

                                </td>
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
    </div> <!-- end row -->--}}


@stop
