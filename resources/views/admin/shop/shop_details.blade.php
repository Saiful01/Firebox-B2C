@extends('layouts.app')
@section('title', 'Shop Details')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Shop Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Shop Details</li>
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

                <!-- end Specifications -->
                    <div class="mt-5">
                        <h5 class="mb-3">Shop Details :</h5>

                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <tbody>
                                <tr>
                                    <th scope="row" style="width: 400px;">Shop Name</th>
                                    <td>{{$result->shop_name}}</td>
                                </tr>

                                {{-- <tr>
                                     <th scope="row">Brand</th>
                                     <td>JBL</td>
                                 </tr>--}}
                                <tr>
                                    <th scope="row">Phone</th>
                                    <td>{{$result->shop_phone}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Division</th>
                                    <td>{{ getDivisionNameFromId($result->division_id)}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">District</th>
                                    <td>{{ getDistrictNameFromId($result->district_id)}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Upazila</th>
                                    <td>{{ getUpazilaNameFromId($result->upazila_id)}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{$result->shop_address}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 400px;">Image</th>
                                    <td><img src="{{$result->shop_image}}" class="img-thumbnail" width="100px">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 400px;">Trade License</th>
                                    <td><img src="{{$result->trade_licence}}" class="img-thumbnail" width="100px">
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Commission Rate</th>
                                    <td>{{$result->commission_rate}}</td>
                                </tr>

                                {{-- <tr>
                                     <th scope="row">Warranty Summary</th>
                                     <td>1 Year</td>
                                 </tr>--}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h5 class="mb-3">Owner Details :</h5>
                        @foreach($operators as $result)

                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <tbody>
                                <tr>
                                    <th scope="row" style="width: 400px;"> Name</th>
                                    <td>{{$result->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Phone</th>
                                    <td>{{$result->phone}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 400px;">Email</th>
                                    <td>{{$result->email}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 400px;">NID No</th>
                                    <td>{{$result->nid}}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Address</th>
                                    <td>{{$result->address}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 400px;">Profile Image</th>
                                    <td><img src="{{$result->profile_pic}}" class="img-thumbnail" width="100px">
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@stop
