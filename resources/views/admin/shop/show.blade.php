@extends('layouts.app')
@section('title', 'Show Customer')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Shops</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Shops</li>
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
                            <h4 class="card-title">Shops Info <span> <a href="/admin/shop/create"
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
                            <th>Shop Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Trade Licence</th>
                            <th>Commission Rate</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php $i = 1;?>
                        @foreach($results as $result)



                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$result->shop_name}}</td>
                                <td>{{$result->shop_phone}}</td>
                                <td>{{$result->shop_email}}</td>
                                <td>
                                    <a target="_blank" href="{{$result->trade_licence}}">
                                        <img src="{{$result->trade_licence}}" alt="Trade License" style="width:100px">
                                    </a>
                                </td>
                                <td>{{$result->commission_rate}}%
                                    <!-- Button trigger modal -->
                                    <span class="ml-3">  <button type="button" class="btn btn-sm btn-primary"
                                                                 data-toggle="modal" data-target="#shop{{$result->shop_id}}">
                                        Edit
                                    </button> </span>
                                </td>
                                <td>{{$result->shop_address}}</td>
                                <td>
                                    @if($result->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item"
                                               href="/admin/shop/edit/{{$result->shop_id}}">Edit</a>
                                            <a class="dropdown-item"
                                               href="/admin/shop/delete/{{$result->shop_id}}">Delete</a>

                                            @if($result->is_active)
                                                <a class="dropdown-item"
                                                   href="/admin/shop/update-status/{{$result->shop_id}}/{{0}}">Inactivate</a>
                                            @else
                                                <a class="dropdown-item"
                                                   href="/admin/shop/update-status/{{$result->shop_id}}/{{1}}">Activate</a>
                                            @endif


                                            <a class="dropdown-item"
                                               href="/admin/shop/order/{{$result->shop_id}}">Order Details</a>
                                            <a class="dropdown-item"
                                               href="/admin/shop/payment-details/{{$result->shop_id}}">Payment
                                                Details</a>
                                            <a class="dropdown-item"
                                               href="/admin/shop-details/{{$result->shop_id}}">Shop
                                                Details</a>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="shop{{$result->shop_id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="{{$result->shop_id}}">Commission Rate</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="/admin/commission-rate/update">
                                            <div class="modal-body">

                                                <input class="form-control" type="text" name="commission_rate"
                                                       value="{{$result->commission_rate}}">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="shop_id" value="{{$result->shop_id}}">


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@stop
