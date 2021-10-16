@extends('layouts.app')
@section('title', 'Create Sub Category')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add Sub Category</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Sub Category</li>
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

                    <h4 class="card-title mb-4">Sub Category Info</h4>

                    <form action="/admin/sub-category/store" method="post"
                          enctype="multipart/form-data">
                        <div class="form-group row mb-4">
                            <label for="product_category_id" class="col-sm-3 col-form-label"> Category <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="category_id">
                                    @foreach($categories as $category)
                                        <option
                                                value="{{$category->category_id}}">{{$category->category_name_en}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="sub_category_name_en" class="col-sm-3 col-form-label">Sub Category Name (EN) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sub_category_name" name="sub_category_name_en" required>
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="sub_category_name_bn" class="col-sm-3 col-form-label">Sub Category Name (BN) <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sub_category_name" name="sub_category_name_bn" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="category_address" class="col-sm-3 col-form-label">Image (20*130) <span
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
