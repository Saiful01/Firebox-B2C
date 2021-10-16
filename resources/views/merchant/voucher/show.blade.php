@extends('layouts.merchant')
@section('title', 'Show Voucher')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add Voucher</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/merchant/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Show Voucher</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Voucher Info <span> <a href="/merchant/voucher/create"
                                                                           class="btn btn-primary btn-sm pull-right float-right">+New</a></span>
                            </h4>
                            <br>
                        </div>


                    </div>


                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Min Amount</th>
                        {{--    <th>Max Amount</th>--}}
                            <th>Discount</th>
                    {{--        <th>Expire</th>--}}
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                        @foreach($results as $result)

                            <tr>
                                <td>#</td>
                                <td>{{$result->min_value}}</td>
                             {{--   <td>{{$result->max_value}}</td>--}}
                                <td>{{$result->discount}}(TK)</td>
                             {{--   <td>{{$result->expire_date}}</td>--}}
                                <td>@if($result->is_active == true) <span class="badge badge-success">Active</span>
                                    @else <span class="badge badge-danger">Inactive</span>@endif</td>

                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" href="/merchant/voucher/edit/{{$result->voucher_id}}">Edit</a>
                                            <a class="dropdown-item" href="/merchant/voucher/delete/{{$result->voucher_id}}">Delete</a>
                                            @if($result->is_active == true)
                                                <a class="dropdown-item" href="/merchant/voucher/inactive/{{$result->voucher_id}}">Inactive</a>
                                            @else
                                                <a class="dropdown-item" href="/merchant/voucher/active/{{$result->voucher_id}}">Active</a>
                                            @endif

                                        </div>
                                    </div>

                                </td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@stop
