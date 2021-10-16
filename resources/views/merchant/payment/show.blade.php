@extends('layouts.merchant')
@section('title', 'Show payment Report')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Payment Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/merchant/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">report</li>
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

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Shop Name</th>
                            <th>Payment Amount</th>
                            <th>Payment Medium</th>
                            <th>Transaction Id</th>
                            <th>Notes</th>
                            <th>Merchant Received</th>
                            <th>Admin status </th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php $i = 1;?>
                        @foreach($results as $result)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$result->shop_name}}</td>
                                <td>{{$result->payment_amount}}</td>
                                <td>{{$result->payment_medium}}</td>
                                <td>{{$result->transection_id}}</td>
                                <td>{{$result->notes}}</td>
                                <td> @if($result->is_received== false) <span class="badge-pill badge-danger">No</span>
                                    @else
                                        <span class="badge-pill badge-success">Yes</span>
                                    @endif

                                </td>
                                <td> @if($result->status== 1) <span class="badge-pill badge-success">Send</span>
                                    @else
                                        <span class="badge-pill badge-success">Returned</span>
                                    @endif

                                </td>
                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            @if($result->is_received== false)
                                            <a class="dropdown-item" href="/admin/payment-status/received/{{$result->merchant_payment_id}}">Received</a>
                                            @else
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
