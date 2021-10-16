@extends('layouts.merchant')
@section('title', 'Create Whole Sales Product')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add Whole Sales Product</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Whole Sales Product</li>
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

                    <form method="post" action="/merchant/whole-sale/product/store" enctype="multipart/form-data">

                            @include('includes.product.whole_sale')

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
                <form method="post" action="/merchant/size/store">
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
                <form method="post" action="/merchant/color/store">
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
                <form method="post" action="/merchant/brand/store">
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
            $scope.sub_category_id = 1;
            $scope.category_id = 1;
            //console.log("Okkkfff"+ $scope.category_id);
            $scope.changeCategory = function () {
                $http.get("/web-api/whole-sale-product/categories/" + $scope.category_id)
                    .then(function (response) {
                        $scope.sub_categories = response.data.results;

                        console.log($scope.sub_categories)

                    })
            };

        });


    </script>



@stop
