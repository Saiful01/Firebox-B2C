@extends('layouts.merchant')
@section('title', 'Whole Sale Product')

@section('content')

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Whole Sale Product Details</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Whole Sale Product Details</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>

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
                                                @foreach(getWholeSaleProductImages($result->whole_sales_product_id) as $image)
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
                                    <h5 class="mb-4">Starting Price : <span class="text-muted mr-2"><b>{{getWholeSaleStartFromPrice($result->whole_sales_product_id)}}TK</b></span>
                                    </h5>
                                    <p class="text-muted mb-4">{!! $result->product_details !!}</p>

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
                                        <th scope="row">Brand</th>
                                        <td>{{$result->brand_name}}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">Stock status</th>
                                        <td>{{ getStockStatusValueFromId($result->stock_status)}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Color</th>
                                        <td>
                                            @if($result->product_color !=null AND $result->product_color!='null')

                                                @foreach(json_decode($result->product_color) as $item)

                                                    {{getColorFromId($item)}},
                                                @endforeach
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Size</th>
                                        <td>
                                            @if($result->product_size !=null AND $result->product_size!='null')

                                                @foreach(json_decode($result->product_size) as $item)

                                                    {{getSizeFromId($item)}},
                                                @endforeach
                                            @endif

                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Materials</th>
                                        <td>{{$result->materials}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Yarn Type</th>
                                        <td>{{$result->yarn_type}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Yarn Count</th>
                                        <td>{{$result->yarn_count}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Density</th>
                                        <td>{{$result->density}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Weaving Machine</th>
                                        <td>{{$result->weaving_machine}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Design</th>
                                        <td>{{$result->design}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Color Quality</th>
                                        <td>{{$result->color_quality}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Wash Process</th>
                                        <td>{{$result->wash_process}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Customized Fold</th>
                                        <td>{{$result->customized_fold}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Packing</th>
                                        <td>{{$result->packing}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Bundle Packing</th>
                                        <td>{{$result->bundle_packing}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Supply Ability</th>
                                        <td>{{$result->supply_ability}}</td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end Specifications -->
                        <div class="mt-5">
                            <h5 class="mb-3">Shop Details :</h5>

                            <div class="table-responsive">
                                <table class="table mb-0 table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="row" style="width: 400px;">Shop Name</th>
                                        <td>{{$result->shop_name}}</td>
                                    </tr>

                                    {{-- <tr>
                                         <th scope="row">Brand</th>
                                         <td>JBL</td>
                                     </tr>--}}
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

                                    {{-- <tr>
                                         <th scope="row">Warranty Summary</th>
                                         <td>1 Year</td>
                                     </tr>--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{--   <div class="mt-5">
                               <h5 class="mb-3">Owner Details :</h5>

                               <div class="table-responsive">
                                   <table class="table mb-0 table-bordered">
                                       <tbody>
                                       <tr>
                                           <th scope="row" style="width: 400px;">Name</th>
                                           <td>{{$result->name}}</td>
                                       </tr>
                                       <tr>
                                           <th scope="row" style="width: 400px;">Email</th>
                                           <td>{{$result->email}}</td>
                                       </tr>
                                       --}}{{-- <tr>
                                            <th scope="row">Brand</th>
                                            <td>JBL</td>
                                        </tr>--}}{{--
                                       <tr>
                                           <th scope="row">Phone</th>
                                           <td>{{$result->phone}}</td>
                                       </tr>
                                       <tr>
                                           <th scope="row">Address</th>
                                           <td>{{$result->address}}</td>
                                       </tr>
                                       --}}{{-- <tr>
                                           <th scope="row">Location</th>
                                           <td>{{getDivisionNameFromId($result->division_id)}}
                                               ,{{getDistrictNameFromId($result->district_id)}}
                                               ,{{getUpazilaNameFromId($result->upazila_id)}}
                                               ,{{getUnionNameFromId($result->union_id)}}
                                           </td>
                                       </tr> --}}{{--





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
