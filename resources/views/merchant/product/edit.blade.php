@extends('layouts.merchant')
@section('title', 'Create Product')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Edit Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
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
                    <form method="post" action="/merchant/product/update" enctype="multipart/form-data">
                        @include('includes.product.edit_retail')

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
            $scope.regular_price = {{$result->regular_price}}
                $scope.discount_rate = {{$result->discount_rate}}
                $scope.selling_price = {{$result->selling_price}}

                $scope.changeParentCategory = function () {
                // console.log($scope.parent_category_id)

                $http.get("/web-api/product/parent-category/" + $scope.parent_category_id)
                    .then(function (response) {
                        $scope.category_list = response.data.results;
                        console.log($scope.category_list)

                    })
                //console.log( $scope.categories);
                //$scope.total = $scope.delivery_charge+quantity * $scope.height * $scope.width * rate;
            };


            $scope.changeCategory = function (quantity) {
                console.log("loll" + quantity);
                //$scope.total = $scope.delivery_charge+quantity * $scope.height * $scope.width * rate;
            };
            $scope.discountRate = function () {
                console.log("loll" + $scope.discountRate);
                $scope.selling_price = $scope.regular_price - (($scope.regular_price * $scope.discount_rate) / 100);
                //$scope.total = $scope.delivery_charge+quantity * $scope.height * $scope.width * rate;
            };

            $scope.changeProductCategory = function (category_id) {

                $http.get("/web-api/product/category/" + $scope.category_id)
                    .then(function (response) {
                        $scope.sub_category_list = response.data.results;
                        console.log($scope.sub_category_list)

                    })
            }


        });


    </script>


@stop
