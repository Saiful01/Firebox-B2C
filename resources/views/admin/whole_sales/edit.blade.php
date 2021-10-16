@extends('layouts.app')
@section('title', 'Create Whole Sales Product')

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Edit Whole Sales Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Whole Sales Product</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row" ng-controller="productController">
        <div class="col-12">
            @include('includes.message')

            <div class="card">
                <div class="card-body">

                    <form method="post" action="/admin/whole-sale/product/update" enctype="multipart/form-data">

                        @include('includes.product.edit_whole_sale')

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">
                                        Save
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
            $scope.category_id = "{{$result->category_id}}";
            $scope.sub_category_id = "{{$result->sub_category_id}}";

            $scope.changeCategory = function () {
                $http.get("/web-api/whole-sale-product/categories/" + $scope.category_id)
                    .then(function (response) {
                        $scope.sub_categories = response.data.results;

                        console.log($scope.sub_categories)

                    })
            };

            $scope.changeCategory();
        });

    </script>


@stop
