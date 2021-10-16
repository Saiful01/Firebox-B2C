@extends('layouts.merchant')
@section('title', 'Show Users')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">User</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/merchant/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                            <h4 class="card-title">User Info <span> <a href="/merchant/user/create"
                                                                        class="btn btn-primary btn-sm pull-right float-right">+New</a></span>
                            </h4>
                            <br>
                        </div>


                    </div>


                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                        {{--    <th>#</th>--}}
                            <th>Name</th>
                            <th>User Type</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Is admin</th>
                            <th>Image</th>

                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                        @foreach($results as $result)

                            <tr>
                             {{--   <td>#</td>--}}
                                <td>{{$result->name}}</td>
                                <td>
                                    @if ($result->user_type==2)
                                        Shop Owner
                                   @else
                                    System Operator
                                    @endif

                                </td>

                                <td>{{$result->phone}}</td>
                                <td>{{$result->email}}</td>
                                <td>
                                    @if($result->user_type==2)
                                        <span class="badge badge-success">Yes</span>

                                    @else
                                        <span class="badge badge-info">No</span>

                                    @endif
                                </td>
                                <td><img src="{{$result->profile_pic}}" width="50px"/></td>

                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" href="/merchant/user/edit/{{$result->id}}">Edit</a>
                                            <a class="dropdown-item"
                                               href="/merchant/user/delete/{{$result->id}}">Delete</a>
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
