@extends('layouts.app')
@section('title', 'Create Category')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add Category</h4>

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

                    <form action="/admin/category/store" method="post"
                          enctype="multipart/form-data">


                        <div class="form-group row mb-4">
                            <label for="category_name" class="col-sm-3 col-form-label">Category Type <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="select2 form-control select2-multiple" name="parent_category_id"
                                        data-placeholder="Choose ...">
                                    <option>Select</option>
                                    @foreach (getMainType() as $res)
                                        <option value="{{$res->parent_category_id}}">{{$res->parent_category_name_en}}</option>
                                    @endforeach
                                    {{--  @foreach (getMainType() as $key => $value)
                                          <option value="{{ $key}}">{{$value}}</option>
                                      @endforeach--}}
                                </select>

                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="category_name" class="col-sm-3 col-form-label">Category Name (EN) <span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control"  name="category_name_en"
                                       required>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="category_name" class="col-sm-3 col-form-label">Category Name (BN)<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="category_name_bn">

                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="category_address" class="col-sm-3 col-form-label">Image (200*130 PX)<span
                                    class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control"  id="image"   name="image">
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