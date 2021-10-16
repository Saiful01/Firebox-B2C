@extends('layouts.app')
@section('title', 'Show Customer')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Shop-Payment Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Shop-Payment Details</li>
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
                            <h4 class="card-title">Shop-Payment Details Info <span> <span>
                                    <button type="button" class="btn btn-sm btn-primary pull-right float-right" data-toggle="modal" data-target="#shop">
                                        +New
                                    </button></span></span>
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
                            <th>Payment Amount</th>
                            <th>Payment Medium</th>
                            <th>Transaction id</th>
                            <th>Notes</th>
                            <th>Merchant  Received</th>
                            <th>Admin  status </th>
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
                                 <td>{{$result->transaction_id}}</td>
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
                             </tr>

                         @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <!-- Modal -->
    <div class="modal fade" id="shop" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Payment Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/admin/shop-payment/save">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="shop_id" value="{{$shop_id}}">
                    <div class="modal-body">
                        <div class="form-group row mb-4">
                            <label for="slider_url" class="col-sm-3 col-form-label">Payment Amount</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="payment_amount" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="slider_url" class="col-sm-3 col-form-label">Payment Medium</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="payment_medium" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="slider_url" class="col-sm-3 col-form-label">Transaction Id</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="transaction_id" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="slider_url" class="col-sm-3 col-form-label">Notes</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="notes" required>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@stop
