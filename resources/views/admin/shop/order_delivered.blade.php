@extends('layouts.app')
@section('title', 'Order Show')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Timeline</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard
                            </a></li>
                        <li class="breadcrumb-item active">Timeline</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-5">Order Timeline</h4>
                    <div class="">
                        <ul class="verti-timeline list-unstyled">
                            @foreach($status as $res)
                            <li class="event-list">
                                <div class="event-timeline-dot">
                                    <i class="bx bx-right-arrow-circle"></i>
                                </div>
                                <div class="media">
                                    <div class="mr-3">
                                        <i class="bx bx-copy-alt h2 text-primary"></i>
                                    </div>
                                    <div class="media-body">
                                        <div>
                                            <h5>{{ getDeliveryStatus($res->delivery_status)}}</h5>
                                            <p class="text-muted">{{getDateFormat($res->created_at)}}</p>

                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
