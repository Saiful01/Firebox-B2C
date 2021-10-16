@extends('layouts.app')
@section('title', 'Update Company')

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Add Company</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Company</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">

                    @include('includes.message')

                    <h4 class="card-title mb-4">Shop Information</h4>

                    <form action="/admin/shop/update" method="post"
                          enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="form-group row mb-4">
                                    <label for="shop_name" class="col-sm-3 col-form-label">Name<span
                                            class="text-danger">*</span> </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="shop_name" name="shop_name"
                                               value="{{$result->shop_name}}" required>
                                        <input type="hidden" class="form-control" id="shop_name" name="shop_id"
                                               value="{{$result->shop_id}}" required>
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="shop_phone" class="col-sm-3 col-form-label">Phone<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="shop_phone" name="shop_phone"
                                               value="{{$result->shop_phone}}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="shop_email" name="shop_email"
                                               value="{{$result->shop_email}}" required>
                                    </div>
                                </div>
                                {{-- <div class="form-group row mb-4">
                                     <label for="shop_email" class="col-sm-3 col-form-label">Trade Lisence<span class="text-danger">*</span></label>
                                     <div class="col-sm-9">
                                         <input type="file" class="form-control" id="trade_licence" name="trade_licence" value="{{$result->trade_licence}}" required>
                                     </div>
                                 </div>--}}

                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">Commission Rate<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="commission_rate"
                                               name="commission_rate" value="{{$result->commission_rate}}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">Division </label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="division_id">
                                            @foreach(\Devfaysal\BangladeshGeocode\Models\Division::all() as $division)

                                                <option value="{{$division->id}}"
                                                        @if($result->division_id== $division->id) selected @endif>{{$division->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">District </label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="district_id">
                                            @foreach(\Devfaysal\BangladeshGeocode\Models\District::all() as $district)

                                                <option value="{{$district->id}}"
                                                        @if($result->district_id== $district->id) selected @endif>{{$district->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_email" class="col-sm-3 col-form-label">Upazila </label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2" name="upazila_id">
                                            @foreach(\Devfaysal\BangladeshGeocode\Models\Upazila::all() as $upazila)

                                                <option value="{{$upazila->id}}"
                                                        @if($result->upazila_id== $upazila->id) selected @endif>{{$upazila->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label for="shop_details" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="shop_address"
                                              name="shop_address"> {{$result->shop_address}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="shop_details" class="col-sm-3 col-form-label">Details</label>
                                    <div class="col-sm-9">
                                    <textarea type="text" class="form-control" id="shop_details"
                                              name="shop_details">{{$result->shop_details}}</textarea>
                                    </div>
                                </div>

                                {{--<div class="form-group row mb-4">
                                    <label for="shop_address" class="col-sm-3 col-form-label">Image</label>
                                    <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image" >
                                    </div>
                                </div>--}}

                                <div class="form-group row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{--   <div class="col-lg-6">
                                   <div class="form-group row mb-4">
                                        <label for="user_title" class="col-sm-3 col-form-label">Owner Name<span class="text-danger">*</span></label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control" id="name" name="user_name" value="{{$result->name}}"  required>
                                       <input type="hidden" class="form-control" id="name" name="user_id" value="{{$result->id}}"  required>
                                       </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                       <label for="shop_phone" class="col-sm-3 col-form-label">Phone<span class="text-danger">*</span></label>
                                       <div class="col-sm-9">
                                           <input type="text" class="form-control" id="user_phone" name="user_phone" value="{{$result->phone}}" required>
                                       </div>
                                   </div>

                                   <div class="form-group row mb-4">
                                       <label for="shop_email" class="col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
                                       <div class="col-sm-9">
                                           <input type="text" class="form-control" id="user_email" name="user_email" value="{{$result->email}}" required>
                                       </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                       <label for="shop_email" class="col-sm-3 col-form-label">NID<span class="text-danger">*</span></label>
                                       <div class="col-sm-9">
                                           <input type="text" class="form-control" id="user_nid" name="user_nid" value="{{$result->nid}}" required>
                                       </div>
                                   </div>
                                   <div class="form-group row mb-4">
                                       <label for="shop_email" class="col-sm-3 col-form-label">Date Of Birth<span class="text-danger">*</span></label>
                                       <div class="col-sm-9">
                                           <input type="text" class="form-control" id="user_dob" name="user_dob" value="{{$result->dob}}" required>
                                       </div>
                                   </div>
                                <div class="form-group row mb-4">
                                   <label for="user_url" class="col-sm-3 col-form-label">Type</label>
                                   <div class="col-sm-9">
                                       <select class="form-control select2" name="user_type">
                                           <option value="2"selected>Shop Admin</option>
                                       </select>
                                   </div>
                               </div>

                               <div class="form-group row mb-4">
                                   <label for="image" class="col-sm-3 col-form-label">Image</label>
                                   <div class="col-sm-9">
                                       <input type="file" class="form-control"  name="user_image" >
                                   </div>
                               </div>

                               <div class="form-group row mb-4">
                                   <label for="user_url" class="col-sm-3 col-form-label">Password</label>
                                   <div class="col-sm-9">
                                       <input type="password" class="form-control" id="user_url" name="user_password" >
                                   </div>
                               </div>


                                   <div class="form-group row justify-content-end">
                                       <div class="col-sm-9">
                                           <div>
                                               <button type="submit" class="btn btn-primary w-md">Submit</button>
                                           </div>
                                       </div>
                                   </div>
                               </div>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->

@stop
