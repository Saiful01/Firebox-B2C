@extends('layouts.merchant')
@section('title', 'Show Whole sale Product')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Whole sale Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/merchant/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Show Whole sale Product</li>
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
                    <form method="get" action="/merchant/whole-sale/product/show">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="product_name" class="form-control" placeholder="Product Name"/>

                            </div>
                            <div class="col-md-3">

                                <select class="form-control select2" name="category_id">
                                    <option value="">All Category</option>
                                    @foreach(getWholeSaleCategory() as $category)
                                        <option
                                            value="{{$category->whole_sale_category_id}}">{{$category->category_name_en}}</option>
                                    @endforeach
                                </select>


                            </div>
                            {{--   <div class="col-md-3">
                                  <select class="form-control" name="shop_id" aria-placeholder="Select shop">
                                     <option  value="">Search Shop</option>
                                     @foreach(getShops() as $shop)
                                     <option value="{{$shop->shop_id}}">{{$shop->shop_name}}</option>
                                     @endforeach
                                  </select>

                              </div>--}}


                            @if(Auth::user()->user_type==1)

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{-- <label class="control-label">Entity<span class="text-danger">*</span></label> --}}


                                        <select class="form-control select2" name="shop_id">
                                            <option value="">All Shop</option>
                                            @foreach(getShops() as $shop)
                                                <option value="{{$shop->shop_id}}">{{$shop->shop_name}}</option>
                                            @endforeach

                                        </select>


                                    </div>

                                </div>
                            @endif

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
                    <a href="/merchant/whole-sale/product/create"
                       class="btn btn-primary btn-sm pull-right float-right">+New</a>
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>

                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Category EN</th>
                            <th>Category BN</th>
                            <th>Start From</th>
                            <th>Featured</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                        @foreach($results as $result)

                            <tr>
                                <td>{{$result->product_name}}</td>
                                <td>{{$result->qr_code}}</td>
                                <td>{{$result->category_name_en}}</td>
                                <td>{{$result->category_name_bn}}</td>
                                <td>{{getWholeSaleStartFromPrice($result->whole_sales_product_id)}}</td>
                                <td>
                                    @if($result->is_featured==1)
                                        <span class="badge badge-pill badge-info">Yes</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">No</span>

                                    @endif
                                </td>
                                <td>
                                    @if($result->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td><img src="{{$result->featured_image}}" width="50"/></td>
                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item"
                                               href="/merchant/whole-sale/product/edit/{{$result->whole_sales_product_id}}">Edit</a>
                                           {{-- <a class="dropdown-item"
                                               href="/merchant/whole-sale/product/delete/{{$result->whole_sales_product_id}}">Delete</a>--}}
                                            <a class="dropdown-item"
                                               href="/merchant/whole-sale/product/details/{{$result->whole_sales_product_id}}">Details</a>
                                            <a class="dropdown-item"
                                               href="/merchant/whole-sale/product/featured/{{$result->whole_sales_product_id}}">Featured</a>
                                            <a class="dropdown-item"
                                               href="/merchant/whole-sale/product/unfeatured/{{$result->whole_sales_product_id}}">UnFeatured</a>
                                        {{--    @if($result->is_active)
                                                <a class="dropdown-item" href="/merchant/shop/update-status/{{$result->shop_id}}/{{0}}">Inactivate</a>
                                            @else
                                                <a class="dropdown-item" href="/merchant/shop/update-status/{{$result->shop_id}}/{{1}}">Activate</a>
                                            @endif--}}
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
