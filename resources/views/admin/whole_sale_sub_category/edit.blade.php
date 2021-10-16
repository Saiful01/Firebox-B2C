@extends('layouts.app')
@section('title', 'Update Sub Category')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Update Whole Sale Sub Category</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Whole Sale Sub Category</li>
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

                    <h4 class="card-title mb-4">Whole Sale Sub Category Info</h4>

                    <form action="/admin/whole-sale/sub-category/update" method="post"
                          enctype="multipart/form-data">
                          <div class="form-group row mb-4">
                            <label for="category_name" class="col-sm-3 col-form-label">Category</label>
                         <div class="col-sm-9">
                            <select class="form-control select2" name="category_id">
                                <option>Select</option>
                                @foreach(getWholeSaleCategory() as $category)
                                    <option
                                    @if($category->whole_sale_category_id == $result->category_id) selected
                                            @endif
                                            value="{{$category->whole_sale_category_id}}">{{$category->category_name_en}}</option>
                                @endforeach

                            </select>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="category_name_en" class="col-sm-3 col-form-label">Sub Category Name (EN)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="sub_category_name_en" name="sub_category_name_en" value="{{$result->sub_category_name_en}}">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="whole_sale_sub_category_id" value="{{$result->whole_sale_sub_category_id}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="category_name_bn" class="col-sm-3 col-form-label">Sub Category Name(BN)</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="category_name_bn" name="sub_category_name_bn" value="{{$result->sub_category_name_bn}}">

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
