@extends('layouts.merchant')
@section('title', 'Edit Voucher')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Edit Voucher</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/merchant/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Voucher</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <h4 class="card-title mb-4">Voucher Info</h4>

                    <form action="/merchant/voucher/update" method="post"
                          enctype="multipart/form-data">
                        <div class="form-group row mb-4">
                            <label for="expire_date" class="col-sm-3 col-form-label">Min Amount(TK)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" value="{{$result->min_value}}" name="min_value" required>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="voucher_id" value="{{$result->voucher_id}}">
                            </div>
                        </div>
                   {{--     <div class="form-group row mb-4">
                            <label for="coupon_code" class="col-sm-3 col-form-label">Max Amount</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control"  value="{{$result->max_value}}"  name="max_value" required>

                            </div>
                        </div>--}}
                        <div class="form-group row mb-4">
                            <label for="discount_rate" class="col-sm-3 col-form-label">Discount(TK) </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" value="{{$result->discount}}" name="discount" required>
                            </div>
                        </div>


                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

@stop
