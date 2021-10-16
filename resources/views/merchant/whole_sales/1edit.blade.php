@extends('layouts.app')
@section('title', 'Edit Whole sales Product')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Edit Whole sales Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Edit Whole sales Product</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    @include('includes.message')

    <div class="row" ng-controller="productController">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="/admin/whole-sale/product/update" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="productname">Product Name</label>
                                    <input id="productname" name="product_name" type="text" class="form-control"
                                           value="{{$result->product_name}}">
                                    <input name="_token" type="hidden" class="form-control" value="{{csrf_token()}}">
                                    <input name="whole_sales_product_id" type="hidden" class="form-control"
                                           value="{{$result->whole_sales_product_id}}">
                                </div>
                                <div class="form-group">
                                    <label for="productdesc">Product Description</label>
                                    <textarea class="form-control" id="productdesc" name="product_details"
                                              rows="5">{{$result->product_details}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="productdesc">Product Specification</label>
                                    <textarea class="form-control" id="productdesc" name="product_specification"
                                              rows="5">{{$result->product_specification}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="manufacturername"> Length<span class="text-danger">*</span></label>
                                    <input id="manufacturername" value="{{$result->length}}" name="length" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="manufacturerbrand">Length Class<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control " name="length_class">
                                        @foreach (getLengthClass() as $key => $value)
                                            <option value="{{$key}}" @if($key== $result->length_class) selected @endif>{{$value}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="manufacturername"> Height<span class="text-danger">*</span></label>
                                    <input id="manufacturername" value="{{$result->height}}" name="height" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="manufacturerbrand">Height Class<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control " name="height_class">
                                        @foreach (getLengthClass() as $key => $value)
                                            <option value="{{ $key}}" @if($key== $result->length_class) selected @endif>{{$value}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="product_color">Size<span class="text-danger">*</span></label>
                                    <select class="select2 form-control select2-multiple" name="product_size[]"
                                            multiple="multiple" multiple data-placeholder="Choose ...">
                                        <optgroup label="Size">
                                            @foreach (getSize() as $key => $value)
                                                @if($result->product_size !=null)
                                                    <option value="{{ $key}}"
                                                            @foreach(json_decode($result->product_size) as $item)
                                                            @if($key==$item)
                                                            selected @endif
                                                        @endforeach>{{$value}}
                                                    </option>
                                                @else
                                                    <option value="{{ $key}}"> {{$value}}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>

                                    </select>

                                </div>


                            </div>

                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <select class="form-control select2" name="category_id">
                                                <option>Select</option>
                                                @foreach(getWholeSaleCategory() as $category)
                                                    <option
                                                        @if($category->whole_sale_category_id ==  $result->category_id) selected
                                                        @endif
                                                        value="{{$category->whole_sale_category_id}}">{{$category->category_name_en}}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="product_color">Sub Category</label>
                                        <select class="select2 form-control select2-multiple"

                                                name="sub_category_id" data-placeholder="Choose ...">
                                            @foreach(getWholeSaleSubCategory() as $sub_category)
                                                <option
                                                    @if($sub_category->whole_sale_sub_category_id ==  $result->sub_category_id) selected
                                                    @endif
                                                    value="{{$sub_category->whole_sale_sub_category_id}}">{{$sub_category->sub_category_name_en}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price">Brand Name<span class="text-danger">*</span></label>
                                        <select class="select2 form-control select2-multiple"

                                                name="brand_id" data-placeholder="Choose ...">
                                            <option>Select</option>
                                            @foreach (getBrand() as $res)
                                                <option
                                                    value="{{$res->brand_id}}"  @if($result->brand_id==$res->brand_id) selected @endif>{{ $res->brand_name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Shop</label>

                                            @if(Auth::user()->user_type!=1)
                                                <select class="form-control" name="shop_id">
                                                    <option
                                                        value="{{$shop_id}}">{{getShopNameFromId($shop_id)}}</option>
                                                </select>
                                            @else
                                                <select class="form-control select2" name="shop_id">
                                                    @foreach($shops as $shop)
                                                        <option value="{{$shop->shop_id}}">{{$shop->shop_name}}</option>
                                                    @endforeach

                                                </select>
                                            @endif


                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Stock Status </label>
                                        <select class="form-control " name="stock_status">
                                            <option>Select</option>
                                            @foreach (getStockStatus() as $key => $value)
                                                <option value="{{ $key}}"
                                                        @if($result->stock_status==$key) selected @endif>{{$value}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Display Category</label>
                                        <select class="form-control " name="product_type">
                                            <option>Select</option>
                                            @foreach (gettingProductType() as $key => $value)
                                                <option value="{{ $key}}"
                                                        @if($result->product_type==$key) selected @endif>{{$value}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="price">Regular Price</label>
                                        <input id="price" name="regular_price" type="number" class="form-control"
                                               value="{{$result->regular_price}}">

                                    </div>
                                    <div class="col-md-6">
                                        <label for="price">Selling Price</label>
                                        <input id="price" name="selling_price" type="number" class="form-control"
                                               value="{{$result->selling_price}}">

                                    </div>
                                    <div class="col-md-6">
                                        <label for="price">Discount Rate<span class="text-danger">*</span></label>
                                        <input id="price" name="discount_rate" type="number" class="form-control"
                                               value="{{$result->discount_rate}}"     required>

                                    </div>
                                    <div class="col-md-6">
                                        <label for="qr_code">Qr Code</label>
                                        <input id="qr_code" name="qr_code" type="text" class="form-control"
                                               value="{{$result->qr_code}}">

                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Order Quantity<span
                                                class="text-danger">*</span> </label>
                                        <input id="quantity" name="minimum_order_quantity" type="number"
                                               class="form-control"
                                               value="{{$result->minimum_order_quantity}}">

                                    </div>
                                    <div class="col-md-6">
                                        <label for="product_color">Color<span class="text-danger">*</span></label>
                                        <select class="select2 form-control select2-multiple" name="product_color[]"
                                                multiple="multiple" multiple data-placeholder="Choose ...">
                                            <optgroup label="Color">
                                                @foreach (getColor() as $key => $value)
                                                    <option value="{{ $key}}"
                                                            @foreach(json_decode($result->product_color) as $item)
                                                            @if($key==$item)
                                                            selected @endif
                                                        @endforeach>{{$value}}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Color Quality<span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->color_quality}}" name="color_quality" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Materials<span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->materials}}" name="materials" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Yarn Type<span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->yarn_type}}" name="yarn_type" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Yarn Count<span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->yarn_count}}" name="yarn_count" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Density <span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->density}}" name="density" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Weaving Machine <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->weaving_machine}}" name="weaving_machine" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Design<span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->design}}" name="design" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Wash Process<span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->wash_process}}" name="wash_process" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Customized Fold<span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->customized_fold}}" name="customized_fold" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Packing<span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->packing}}" name="packing" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Bundle packing <span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->bundle_packing}}" name="bundle_packing" type="text"
                                               class="form-control"
                                               required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="manufacturerbrand">Supply Ability<span class="text-danger">*</span>
                                        </label>
                                        <input id="quantity" value="{{$result->supply_ability}}" name="supply_ability" type="text"
                                               class="form-control"
                                               required>
                                    </div>


                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="productdesc">Product Description</label>
                                        <textarea id="elm1" class="form-control summernote" name="product_details">
                                        {!! $result->product_details !!}
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="productdesc">Product Specification</label>
                                        <textarea class="form-control summernote" id="productdesc"
                                                  name="product_specification">
                                         {!! $result->product_specification !!}
                                    </textarea>
                                    </div>

                                </div>


                            </div>
                            <div class="col-sm-4">

                                <div class="form-group">
                                    <label for="productdesc">Meta Title</label>
                                    <textarea class="form-control" id="productdesc" name="meta_title"
                                              rows="5">{{$result->meta_title}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">

                                <div class="form-group">
                                    <label for="productdesc">Meta Kywords</label>
                                    <textarea class="form-control" id="productdesc" name="meta_keywords"
                                              rows="5">{{$result->meta_keywords}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="productdesc">Meta Description</label>
                                    <textarea class="form-control" id="productdesc" name="meta_description"
                                              rows="5">{{$result->meta_description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="product_color">Featured Image<span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="featured" >
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title mb-3">Product Images</h4>
                                        <div class="fallback">
                                            <input name="image[]" type="file" multiple/>
                                        </div>

                                        <div class="dz-message needsclick">
                                            <div class="mb-3">
                                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                            </div>

                                            <h4>Drop files here or click to upload.</h4>
                                        </div>
                                    </div>


                                </div>


                            </div>

                        </div>
                        <!-- end card-->


                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Save
                                        Changes
                                    </button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>


    </div>
    <!-- end row -->
    <script>


        app.controller('productController', function ($scope, $http) {

            console.log("Okkkfff");
            $scope.coverage_depth = "Division";
            $scope.division = "";
            $scope.union_id = "";
            coverage_depth = "Union";

            $scope.changeDivision = function (division_id) {


                $http.get("/district/" + division_id)

                    .then(function (response) {


                        $scope.districts = response.data.results;

                        console.log($scope.districts);

                    });
            };

            $scope.changeDistrict = function (district) {
                console.log(district);

                $http.get("/upazila/" + district)

                    .then(function (response) {


                        $scope.upazilas = response.data.results;

                        console.log($scope.upazilas);

                    });
            };

            $scope.changeUpazila = function (upazila) {


                $http.get("/union/" + upazila)

                    .then(function (response) {


                        $scope.unions = response.data.results;

                        console.log($scope.unions);

                    });
            };


            //Getting Divisions

            $http.get("/division")

                .then(function (response) {


                    $scope.divisions = response.data.results;

                    console.log($scope.divisions);

                });
        });


    </script>

@stop
