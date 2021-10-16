@extends('layouts.app')
@section('title', 'Show Sub Category')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Sub Category</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sub Category</li>
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
                    <form method="get" action="/admin/sub-category/show" class="ng-pristine ng-valid">
                        <div class="row">
                            <div class="col-md-3">

                                <select class="form-control" name="category_id">
                                    <option value="">All</option>
                                    @foreach(getProductCategory() as $item)
                                        <option value="{{$item->category_id}}">{{$item->category_name_en}}</option>
                                    @endforeach

                                </select>

                            </div>


                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Search
                                </button>

                            </div>


                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">Sub Category Info <span> <a href="/admin/sub-category/create"
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
                            <th> Category Name</th>
                            <th>Sub Category Name (en)</th>
                            <th>Sub Category Name (bn)</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php $i = 1;?>
                        @foreach($results as $result)

                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$result->category_name_en}}</td>
                                <td>{{$result->sub_category_name_en}}</td>
                                <td>{{$result->sub_category_name_bn}}</td>
                                <td>
                                    <img src="{{$result->featured_image}}" width="50px">

                                </td>
                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item"
                                               href="/admin/sub-category/edit/{{$result->sub_category_id}}">Edit</a>
                                            <a class="dropdown-item"
                                               href="/admin/sub-category/delete/{{$result->sub_category_id}}">Delete</a>
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
