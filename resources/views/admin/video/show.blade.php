@extends('layouts.app')
@section('title', 'Show Video Tutorial')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Video Tutorial</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Video Tutorial</li>
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
                        <div class="col-md-12">
                            <h4 class="card-title">Video Tutorial Info <span><button type="button" class="btn btn-sm btn-primary"
                                                                                     data-toggle="modal" data-target="#video">
                                        +new
                                    </button></span>
                            </h4>
                            <br>
                        </div>


                    </div>


                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Video Name</th>
                            <th>Link</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>


                        <tbody>
                        <?php $i = 1;?>
                        @foreach($results as $result)

                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$result->name}}</td>
                                <td>{{$result->link}}</td>
                                <td><a target="_blank" href="{{$result->link}}">View</a></td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <span >  <button type="button" class="btn btn-sm btn-primary"
                                                                 data-toggle="modal" data-target="#shop{{$result->video_id}}">
                                        Edit
                                    </button> </span>
                                </td>
                                <td>
                                    <div class="btn-group mr-1 mt-2">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <a class="dropdown-item"
                                               href="/admin/video/delete/{{$result->video_id}}">Delete</a>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="shop{{$result->video_id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="{{$result->video_id}}">Video Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="/admin/video/update">
                                            <div class="modal-body">

                                                <input class="form-control" type="text" name="name"
                                                       value="{{$result->name}}">
                                                <input class="form-control mt-3" type="text" name="link"
                                                       value="{{$result->link}}">
                                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                <input type="hidden" name="video_id" value="{{$result->video_id}}">


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- Modal -->
    <div class="modal fade" id="video" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="video">Video Tutorial Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/admin/video/store">
                    <div class="modal-body">

                        <input class="form-control" type="text" name="name"
                               placeholder="Video Name">
                        <input class="form-control mt-3" type="text" name="link"
                               placeholder="Video Link">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@stop
