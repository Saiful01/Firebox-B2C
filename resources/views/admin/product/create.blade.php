@extends('layouts.app')
@section('title', 'Create Product')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
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

                    <form method="post" action="/admin/product/store" enctype="multipart/form-data">
                        @include('includes.product.retail')

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Save
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
    {{--modal size--}}
    <div class="modal fade" id="size" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Size Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/admin/size/store">
                    <div class="modal-body">

                        <input class="form-control" placeholder="Size Name" type="text" name="size_name">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--modal color--}}
    <div class="modal fade" id="color" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Color Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/admin/color/store">
                    <div class="modal-body">

                        <input class="form-control" placeholder="Color Name" type="text" name="color_name">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{--modal brand--}}
    <div class="modal fade" id="brand" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Brand Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/admin/brand/store">
                    <div class="modal-body">

                        <input class="form-control" placeholder="Brand Name" type="text" name="brand_name">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>









    <!-- end row -->

    <script>


        app.controller('productController', function ($scope, $http) {

            $scope.changeParentCategory = function () {

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
                //$scope.selling_price=(Math.round($scope.selling_price * 100) / 100).toFixed( 2);
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
