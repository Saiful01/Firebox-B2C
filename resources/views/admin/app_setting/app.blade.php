@extends('layouts.app')
@section('title', 'Show Brand')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Brand</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Brand</li>
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

                    @include('includes.message')
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

{{--                                    @include('includes.message')--}}

                                    <h4 class="card-title mb-4">App Version</h4>

                                    <form action="/admin/app/update/" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row mb-4">
                                                    <label for="shop_name" class="col-sm-3 col-form-label">App Version<span
                                                            class="text-danger">*</span> </label>

                                                    @foreach($results as $result)
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" value="{{$result->app_version}}" i name="app_version"
                                                               required>
                                                        <input type="hidden" class="form-control" value="{{$result->id}}" name="id">
                                                    </div>
                                                    @endforeach
                                                </div>

                                            </div>


                                            <div class="btn-group mb-5 pb-lg-2">

                                                    <button class="btn p-lg-2 btn-secondary btn-sm " type="submit">Edit</button>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


@stop
