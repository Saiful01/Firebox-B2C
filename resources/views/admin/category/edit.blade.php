@extends('layouts.app')
@section('title', 'Update Category')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Update Category</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <h4 class="card-title mb-4">Category Info</h4>

                    <form action="/admin/category/update" method="post"
                          enctype="multipart/form-data">
                        <div class="form-group row mb-4">
                            <label for="category_name" class="col-sm-3 col-form-label">Category Type</label>
                            <div class="col-sm-9">
                                <select class="select2 form-control select2-multiple"
                                        name="parent_category_id" data-placeholder="Choose ...">
                                    @foreach (getMainType() as $res)
                                        <option
                                            value="{{$res->parent_category_id}}"
                                            @if($res->parent_category_id == $result->parent_category_id)
                                            selected
                                            @endif>{{$res->parent_category_name_en}}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="category_name" class="col-sm-3 col-form-label">Category Name (EN)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="category_name" name="category_name_en"
                                       value="{{$result->category_name_en}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="category_id" value="{{$result->category_id}}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="category_name" class="col-sm-3 col-form-label">Category Name (BN)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="category_name" name="category_name_bn"
                                       value="{{$result->category_name_bn}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="category_id" value="{{$result->category_id}}">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="category_address" class="col-sm-3 col-form-label">Image (200*130 PX)</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
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
