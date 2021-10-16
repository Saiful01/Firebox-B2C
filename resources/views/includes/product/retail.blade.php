<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="productname">Product Name<span class="text-danger">*</span> </label>
            <input id="productname" name="product_name" type="text" class="form-control"
                   required>
            <input name="_token" type="hidden" class="form-control" value="{{csrf_token()}}">
        </div>
        <div class="form-group">
            <label for="product_color">Parent category<span
                    class="text-danger">*</span></label>

            <select class="form-control" name="parent_category_id" ng-model="parent_category_id"
                    ng-change="changeParentCategory()">
                @foreach (getMainType() as $res)
                    <option
                        value="{{ $res->parent_category_id}}">{{ $res->parent_category_name_en}}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label class="control-label">Category<span
                        class="text-danger">*</span></label>
                <select class="form-control " name="category_id"
                        id="category_id" ng-model="category_id"
                        ng-change="changeProductCategory(category_id)" required>

                    <option ng-repeat="category in category_list"
                            value="@{{ category.category_id }}">@{{ category.category_name_en }}
                    </option>

                </select>
            </div>

        </div>
        <div class="form-group">
            <div class="form-group">
                <label class="control-label">Sub-category <span
                        class="text-danger">*</span></label>
                <select class="form-control " name="sub_category_id"
                        ng-model="sub_category_id" required>

                    <option ng-repeat="category in sub_category_list"
                            value="@{{ category.sub_category_id }}">@{{
                        category.sub_category_name_en }}
                    </option>

                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="price">Size

                <span class="">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#size">+new</button>
                    </span>

            </label>
            <select class="select2 form-control select2-multiple" name="product_size[]"
                    multiple="multiple" multiple data-placeholder="Choose ...">
                <optgroup label="Size">
                    @foreach (getSize() as $size)
                        <option value="{{ $size->size_id}}">{{$size->size_name}}</option>
                    @endforeach
                </optgroup>

            </select>
        </div>


    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-md-6">
                <label for="price">Weight</label>
                <input id="price" name="weight" type="text" class="form-control"
                       required>

            </div>
            <div class="col-md-6">
                <label for="price">Color

                    <span class="">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#color">+new</button>
                    </span>

                </label>
                <select class="select2 form-control select2-multiple" name="product_color[]"
                        multiple="multiple" multiple data-placeholder="Choose ...">
                    <optgroup label="Color">
                        @foreach (getColor() as $color)
                            <option value="{{$color->color_id}}">{{$color->color_name}}</option>
                        @endforeach
                    </optgroup>

                </select>
            </div>
            <div class="col-md-6">
                <label for="price">Brand Name

                    <span class="">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#brand">+new</button>
                    </span>

                </label>
                <select class="select2 form-control select2-multiple"

                        name="brand_id" data-placeholder="Choose ...">
                    <option value=""> None</option>
                    @foreach (getBrand() as $res)
                        <option
                            value="{{ $res->brand_id}}">{{ $res->brand_name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Shop<span class="text-danger">*</span></label>


                    @if(Auth::user()->user_type!=1)
                        <select class="form-control" name="shop_id">
                            <option
                                value="{{ \Illuminate\Support\Facades\Session::get('shop_id')}}">{{getShopNameFromId( \Illuminate\Support\Facades\Session::get('shop_id'))}}</option>
                        </select>
                    @else
                        <select class="form-control select2" name="shop_id">
                            @foreach($shops as $shop)
                                <option value="{{$shop->shop_id}}">{{$shop->shop_name}}</option>
                            @endforeach

                        </select>
                    @endif

                </div>
            </div>

            <div class="col-md-6">
                <label for="manufacturerbrand">Stock Status<span class="text-danger">*</span>
                </label>
                <select class="form-control " name="stock_status">
                    @foreach (getStockStatus() as $key => $value)
                        <option value="{{ $key}}"
                                @if($key==1)selected @endif>{{$value}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Display category<span
                        class="text-danger">*</span> </label>
                <select class="form-control " name="product_type">

                    @foreach (gettingProductType() as $key => $value)
                        <option value="{{ $key}}">{{$value}}</option>
                    @endforeach

                </select>

            </div>
            <div class="col-md-6">
                <label for="price">Regular Price<span class="text-danger">*</span></label>
                <input id="price" name="regular_price" type="number" ng-model="regular_price"
                       class="form-control"
                       required>

            </div>
            <div class="col-md-6">
                <label for="price">Discount Rate<span class="text-danger">*</span></label>
                <input id="price" name="discount_rate" type="text" ng-model="discount_rate"
                       ng-change="discountRate()" class="form-control"
                       required>

            </div>
            <div class="col-md-6">
                <label for="price">Selling Price<span class="text-danger">*</span></label>
                <input id="price" name="selling_price" ng-model="selling_price" type="number"
                       class="form-control"
                       readonly required>

            </div>
            <div class="col-md-6">
                <label for="qr_code">Product Code</label>
                <input id="qr_code" name="qr_code" type="text"
                       class="form-control" value="{{getQrCode()}}">

            </div>
            {{--    <div class="col-md-6">
                    <label for="manufacturerbrand">Order Quantity<span class="text-danger">*</span>
                    </label>
                    <input id="quantity" name="minimum_order_quantity" type="number"
                           class="form-control"
                           required>

                </div>--}}
           {{-- <div class="col-md-6">
                <label data-toggle="tooltip" data-placement="top" title="{{getDeliveryChargeText()}}">Delivery
                    Charge<span
                        class="text-danger">*</span></label>
                <input type="number" name="delivery_charge" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label data-toggle="tooltip" data-placement="top" title="{{getDeliverableQuantityText()}}">Deliverable
                    Quantity<span
                        class="text-danger">*</span>
                </label>
                <input type="number" name="deliverable_quantity" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label data-toggle="tooltip" data-placement="top" title="{{getExtraDeliveryChargeText()}}">Extra
                    Delivery Charge<span
                        class="text-danger">*</span>
                </label>
                <input type="number" name="extra_delivery_charge" class="form-control" required>
            </div>--}}

        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="productdesc">Product Description<span
                    class="text-danger">*</span></label>
            <textarea id="elm1" class="form-control summernote"
                      name="product_details" required></textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="productdesc">Product Specification<span
                    class="text-danger">*</span></label>
            <textarea class="form-control summernote" id="productdesc"
                      name="product_specification" required>
                                    </textarea>
        </div>

    </div>


</div>
<div class="row">
    <div class="col-sm-4">

        <div class="form-group">
            <label for="productdesc">Meta Title</label>
            <textarea class="form-control" id="productdesc" name="meta_title"
                      rows="5"></textarea>
        </div>
    </div>
    <div class="col-sm-4">

        <div class="form-group">
            <label for="productdesc">Meta Keywords</label>
            <textarea class="form-control" id="productdesc" name="meta_keywords"
                      rows="5"></textarea>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="productdesc">Meta Description</label>
            <textarea class="form-control" id="productdesc" name="meta_description"
                      rows="5"></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="product_color">Featured Image (800px X 900px)<span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="featured" required>
    </div>
    <div class="col-md-6">
        <div class="input-group mt-4">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Youtube Link :</span>
            </div>
            <input type="text" class="form-control" name="video" id="video"
                   aria-describedby="basic-addon3">
        </div>
    </div>

</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Product Images
                </h4>

                <div>
                    <div{{-- action="#" class="dropzone"--}}>
                        <div class="fallback">
                            <input name="image[]" type="file" multiple="multiple">
                        </div>
                        <div class="dz-message needsclick">
                            <div class="mb-3">
                                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                            </div>

                            <h4>Drop files here or click to upload.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
