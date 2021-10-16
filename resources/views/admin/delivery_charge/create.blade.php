@extends('layouts.app')
@section('title', 'Create Category')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Delivery</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Delivery</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->







    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <h4 class="card-title mb-4">Delivery Info</h4>

                    <form enctype="multipart/form-data" action="/admin/delivery-charge/store" method="POST">
                        <input type="hidden" name="id" value="{{$result->id}}">

                        <div class="form-group row mb-4 ml-5" ng-controller="multipleInputsCtrl">
                            <section ng-repeat="input in inputs">
                                <div class="row ">
                                    <div class="form-group row justify-content-end">
                                        <div class="col-md-5">
                                            <label for="category_name" class=" col-form-label">Product Quantity
                                                :</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="min_weight"
                                                   name="product_quantity" value="{{$result->product_quantity}}">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        </div>
                                    </div>

                                    <div class="form-group row justify-content-end">
                                        <div class="col-md-5">
                                            <label for="category_name" class="col-form-label">Delivery Charge :</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="max_weight"
                                                   name="delivery_charge" value="{{$result->delivery_charge}}">
                                        </div>


                                    </div>


                                    <div class="form-group row justify-content-end">
                                        <div class="col-md-5">
                                            <label for="category_name" class="col-form-label">Extra Charge:</label>
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" id="max_weight"
                                                   name="extra_charge" value="{{$result->extra_charge}}">
                                        </div>
                                    </div>

                                    <div class="form-group row justify-content-end">
                                        <div class="col-sm-9">
                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </section>


                        </div>


                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        // var app = angular.module('multipleInputs',[]);


        app.controller('multipleInputsCtrl', function ($scope) {
            $scope.rate = "";
            $scope.min_weight = "";
            $scope.max_weight = "";
            $scope.inputs = [
                {}
            ];

            $scope.addInputLines = function () {
                var newInput = {};
                $scope.inputs.push(newInput);
            }

            $scope.removeInputlines = function (input) {
                var index = $scope.inputs.indexOf(input);
                $scope.inputs.splice(index, 1);
            }


        });
        app.controller('submitCtrl', function ($scope) {

            $scope.allSubmit() = function () {
                console.log('jhjyhbjuvbujh');

            };
        });


    </script>


    <!-- end row -->

@stop

