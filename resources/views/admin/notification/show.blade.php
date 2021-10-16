@extends('layouts.app')
@section('title', 'Show Customer Notification')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Notification</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Notification</li>
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
                            <h4 class="card-title">Notification Info <span> <span>
                                    <button type="button" class="btn btn-sm btn-primary pull-right float-right" data-toggle="modal" data-target="#shop">
                                        +New
                                    </button></span></span>
                            </h4>
                            <br>
                        </div>


                    </div>


                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Notification</th>
                            <th>Action</th>

                        </tr>
                        </thead>


                        <tbody>
                        <?php $i = 1;?>
                         @foreach($results as $result)
                             <tr>
                                 <td>{{$i++}}</td>
                                 <td>{{$result->details}}</td>
                                 <td>
                                     <div class="btn-group mr-1 mt-2">
                                         <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                 data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                             Action <i class="mdi mdi-chevron-down"></i>
                                         </button>
                                         <div class="dropdown-menu" style="">
                                             <a class="dropdown-item" href="/admin/notification/delete/{{$result->id}}">Delete</a>

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
    <!-- Modal -->
    <div class="modal fade" id="shop" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Notification Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/admin/notification/save">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="customer_id" value="{{$id}}">
                    <div class="modal-body">
                        <div class="form-group row mb-4">
                            <label for="slider_url" class="col-sm-3 col-form-label">Notification</label>
                            <div class="col-sm-9">
                                <textarea rows="5" type="text" class="form-control" name="details" required>
                                </textarea>
                            </div>
                        </div>

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
