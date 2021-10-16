@extends('layouts.app')
@section('title', 'Show Color')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Color</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Color</li>
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
                            <h4 class="card-title"> Color Info <span> <a href="/admin/color/create"
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

                            <th>Name</th>

                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                            <@php
                                $i=1
                            @endphp

                        @foreach($results as $result)


                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{$result->color_name}}</td>
                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item" href="/admin/color/edit/{{$result->color_id}}">Edit</a>
                                            <a class="dropdown-item" href="/admin/color/delete/{{$result->color_id}}">Delete</a>
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
    </div> <!-- end row -->


@stop
