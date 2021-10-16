@extends('layouts.app')
@section('title', 'Create Product')

@section('content')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Product Detail</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Product Detail</li>
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
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="product-detai-imgs">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-3 col-4">
                                            <div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist"
                                                 aria-orientation="vertical">
                                                @foreach($images as $image)
                                                    <a class="nav-link active" id="product-1-tab" data-toggle="pill"
                                                       href="#product-1" role="tab" aria-controls="product-1"
                                                       aria-selected="true">
                                                        <img src="{{$image->image}}" width="100%" alt=""
                                                             class="img-fluid img-thumbnail mx-auto d-block rounded">
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-7 offset-md-1 col-sm-9 col-8">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="product-1" role="tabpanel"
                                                     aria-labelledby="product-1-tab">
                                                    <div>
                                                        <img src="{{$result->featured_image}}" alt=""
                                                             class="img-fluid img-thumbnail mx-auto d-block">
                                                    </div>
                                                </div>
                                            </div>
                                            {{--  <div class="text-center">
                                                  <button type="button"
                                                          class="btn btn-primary waves-effect waves-light mt-2 mr-1">
                                                      <i class="bx bx-cart mr-2"></i> Add to cart
                                                  </button>
                                                  <button type="button"
                                                          class="btn btn-success waves-effect  mt-2 waves-light">
                                                      <i class="bx bx-shopping-bag mr-2"></i>Buy now
                                                  </button>
                                              </div>--}}

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="mt-4 mt-xl-3">
                                    <a href="#" class="text-primary">{{$result->category_name_en}}</a>
                                    <h4 class="mt-1 mb-3">{{$result->product_name}}</h4>
                                    {{--
                                                                        <p class="text-muted float-left mr-3">
                                                                            <span class="bx bx-star text-warning"></span>
                                                                            <span class="bx bx-star text-warning"></span>
                                                                            <span class="bx bx-star text-warning"></span>
                                                                            <span class="bx bx-star text-warning"></span>
                                                                            <span class="bx bx-star"></span>
                                                                        </p>--}}
                                    {{--<p class="text-muted mb-4">( 152 Customers Review )</p>--}}

                                    <h6 class="text-success text-uppercase">{{$result->discount_rate}} % Off</h6>
                                    <h5 class="mb-4">Price : <span class="text-muted mr-2"><del>{{$result->regular_price}}
                                                TK</del></span>
                                        <b>{{$result->selling_price}}TK</b></h5>
                                    <p class="text-muted mb-4">{!!  $result->product_details !!}</p>
                                    {{--   <div class="row mb-3">
                                           <div class="col-md-6">
                                               <div>
                                                   <p class="text-muted"><i
                                                           class="bx bx-unlink font-size-16 align-middle text-primary mr-1"></i>
                                                       Wireless</p>
                                                   <p class="text-muted"><i
                                                           class="bx bx-shape-triangle font-size-16 align-middle text-primary mr-1"></i>
                                                       Wireless Range : 10m</p>
                                                   <p class="text-muted"><i
                                                           class="bx bx-battery font-size-16 align-middle text-primary mr-1"></i>
                                                       Battery life : 6hrs</p>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div>
                                                   <p class="text-muted"><i
                                                           class="bx bx-user-voice font-size-16 align-middle text-primary mr-1"></i>
                                                       Bass</p>
                                                   <p class="text-muted"><i
                                                           class="bx bx-cog font-size-16 align-middle text-primary mr-1"></i>
                                                       Warranty : 1 Year</p>
                                               </div>
                                           </div>
                                       </div>--}}

                                    {{--<div class="product-color">
                                        <h5 class="font-size-15">Color :</h5>
                                        <a href="#" class="active">
                                            <div class="product-color-item border rounded">
                                                <img src="assets/images/product/img-7.png" alt="" class="avatar-md">
                                            </div>
                                            <p>Black</p>
                                        </a>
                                        <a href="#">
                                            <div class="product-color-item border rounded">
                                                <img src="assets/images/product/img-7.png" alt="" class="avatar-md">
                                            </div>
                                            <p>Blue</p>
                                        </a>
                                        <a href="#">
                                            <div class="product-color-item border rounded">
                                                <img src="assets/images/product/img-7.png" alt="" class="avatar-md">
                                            </div>
                                            <p>Gray</p>
                                        </a>
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="mt-5">
                            <h5 class="mb-3">Video :</h5>
                            @if($result->video==null)

                                Video is not available

                            @else
                                <video width="320" height="240" controls>
                                    <source src="{{$result->video}}" type="video/mp4">
                                </video>

                            @endif


                        </div>

                        <div class="mt-5">
                            <h5 class="mb-3">Specifications :</h5>

                            <div class="table-responsive">
                                <table class="table mb-0 table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Parent Category</th>
                                        <td>{{$result->parent_category_name_en}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Category</th>
                                        <td>{{$result->category_name_en}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Sub Category</th>
                                        <td>{{$result->sub_category_name_en}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Name</th>
                                        <td>{{$result->product_name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Details</th>
                                        <td>{!! $result->product_details !!}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Specification</th>
                                        <td> {!! $result->product_specification !!}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Brand Name</th>
                                        <td>{{$result->brand_name}}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Weight</th>
                                        <td>{{$result->weight}} {{--({{getWeightClassValueFromId($result->weight_class)}})--}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Stock status</th>
                                        <td>{{ getStockStatusValueFromId($result->stock_status)}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Color</th>
                                        <td>
                                            @if($result->product_color!=null AND $result->product_color!='null')
                                                @foreach(json_decode($result->product_color) as $item)

                                                    {{getColorFromId($item)}},
                                                @endforeach
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Size</th>
                                        <td>
                                            @if($result->product_size!=null AND $result->product_size!='null')
                                                @foreach(json_decode($result->product_size) as $item)

                                                    {{getSizeFromId($item)}},
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Delivery charge</th>
                                        <td>{{$result->delivery_charge}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Deliverable quantity</th>
                                        <td>{{$result->deliverable_quantity}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Extra delivery charge</th>
                                        <td>{{$result->extra_delivery_charge}}</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end Specifications -->
                        {{--<div class="mt-5">
                            <h5 class="mb-3">Shop Details :</h5>

                            <div class="table-responsive">
                                <table class="table mb-0 table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Shop Name</th>
                                        <td>{{$result->shop_name}}</td>
                                    </tr>

                                    --}}{{-- <tr>
                                         <th scope="row">Brand</th>
                                         <td>JBL</td>
                                     </tr>--}}{{--
                                    <tr>
                                        <th scope="row">Phone</th>
                                        <td>{{$result->shop_phone}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td>{{$result->address}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Image</th>
                                        <td><img src="{{$result->shop_image}}" class="img-thumbnail" width="100px">
                                        </td>
                                    </tr>

                                    --}}{{-- <tr>
                                         <th scope="row">Warranty Summary</th>
                                         <td>1 Year</td>
                                     </tr>--}}{{--
                                    </tbody>
                                </table>
                            </div>
                        </div>--}}

                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->


    </div>
@stop
