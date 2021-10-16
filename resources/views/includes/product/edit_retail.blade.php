<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="productname">Product Name</label>
            <input id="productname" name="product_name" type="text" class="form-control"
                   value="{{$result->product_name}}">
            <input name="_token" type="hidden" class="form-control" value="{{csrf_token()}}">
            <input name="product_id" type="hidden" class="form-control"
                   value="{{$result->product_id}}">
        </div>
        <div class="form-group">
            <label for="product_color">Parent category ({{getParentCategoryName($result->parent_category_id)}})<span
                    class="text-danger">*</span></label>

            <select class="form-control" name="parent_category_id" ng-model="parent_category_id"
                    ng-change="changeParentCategory()" required>
                @foreach (getMainType() as $res)
                    <option value="{{ $res->parent_category_id}}">{{ $res->parent_category_name_en}}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label class="control-label">Category ({{getCategoryName($result->category_id)}})<span
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
                <label class="control-label">Sub-category ({{getSubCategoryName($result->sub_category_id)}}) <span
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
            <label for="product_color">Size</label>
            <select class="select2 form-control select2-multiple" name="product_size[]"
                    multiple="multiple" multiple data-placeholder="Choose ...">
                <optgroup label="Size">
                    @foreach (getSize() as $size)
                        @if($result->product_size !=null AND $result->product_size!='null')
                            <option value="{{ $size->size_id}}"
                                    @foreach(json_decode($result->product_size) as $item)
                                    @if($size->size_id ==$item)
                                    selected @endif
                                @endforeach>{{$size->size_name}}
                            </option>
                        @else
                            <option value="{{ $size->size_id}}">{{$size->size_name}}</option>
                        @endif

                    @endforeach

                </optgroup>

            </select>
        </div>

    </div>

    <div class="col-sm-6">
        <div class="row">
            <div class="col-md-6">
                <label for="price">Weight</label>
                <input id="price" name="weight" type="text" class="form-control" value="{{$result->weight}}">

            </div>

            <div class="col-md-6">
                <label for="product_color">Color</label>
                <select class="select2 form-control select2-multiple" name="product_color[]"
                        multiple="multiple" multiple data-placeholder="Choose ...">
                    <optgroup label="Size">
                        @foreach (getColor() as $color)
                            @if($result->product_color !=null AND $result->product_color!='null')
                                <option value="{{ $color->color_id}}"
                                        @foreach(json_decode($result->product_color) as $item)
                                        @if($color->color_id ==$item)
                                        selected @endif
                                    @endforeach>{{$color->color_name}}
                                </option>
                            @else
                                <option value="{{ $color->color_id}}">{{$color->color_name}}</option>
                            @endif

                        @endforeach

                    </optgroup>

                </select>
            </div>
            <div class="col-md-6">
                <label for="price">Brand Name<span class="text-danger">*</span></label>
                <select class="select2 form-control select2-multiple"

                        name="brand_id" data-placeholder="Choose ...">
                    <option value="0">Other</option>
                    @foreach (getBrand() as $res)
                        <option
                            value="{{$res->brand_id}}"
                            @if($result->brand_id==$res->brand_id) selected @endif>{{ $res->brand_name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Shop</label>

                    @if(Auth::user()->user_type!=1)
                        <select class="form-control" name="shop_id">
                            <option
                                value="{{$result->shop_id}}">{{getShopNameFromId($result->shop_id)}}</option>
                        </select>
                    @else
                        <select class="form-control select2" name="shop_id">
                            @foreach($shops as $shop)
                                <option
                                    value="{{$shop->shop_id}}">{{$shop->shop_name}}</option>
                            @endforeach

                        </select>
                    @endif


                </div>

            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Stock Status </label>
                <select class="form-control " name="stock_status">
                    <option>Select</option>
                    @foreach (getStockStatus() as $key => $value)
                        <option value="{{ $key}}"
                                @if($result->stock_status==$key) selected @endif>{{$value}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Display Category</label>
                <select class="form-control " name="product_type">
                    <option>Select</option>
                    @foreach (gettingProductType() as $key => $value)
                        <option value="{{ $key}}"
                                @if($result->product_type==$key) selected @endif>{{$value}}</option>
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
                       ng-change="discountRate()" class="form-control" required>

            </div>
            <div class="col-md-6">
                <label for="price">Selling Price<span class="text-danger">*</span></label>
                <input id="price" name="selling_price" ng-model="selling_price" type="number"
                       class="form-control"
                       readonly required>

            </div>

            <div class="col-md-6">
                <label for="qr_code">Product Code</label>
                <input id="qr_code" name="qr_code" type="text" class="form-control"
                       value="{{$result->qr_code}}" readonly>

            </div>
            {{--    <div class="col-md-6">
                    <label for="manufacturerbrand">Order Quantity<span
                            class="text-danger">*</span> </label>
                    <input id="quantity" name="minimum_order_quantity" type="number"
                           class="form-control"
                           value="{{$result->minimum_order_quantity}}">

                </div>--}}
            {{--<div class="col-md-6">
                <label for="product_color">Delivery Charge<span
                        class="text-danger">*</span></label>
                <input type="text" name="delivery_charge" class="form-control"
                       value="{{$result->delivery_charge}}">
            </div>
            <div class="col-md-6">
                <label for="product_color">Deliverable Quantity<span
                        class="text-danger">*</span>
                </label>
                <input type="number" name="deliverable_quantity" class="form-control"
                       value="{{$result->deliverable_quantity}}">
            </div>
            <div class="col-md-6">
                <label for="product_color">Extra Delivery Charge<span
                        class="text-danger">*</span>
                </label>
                <input type="text" name="extra_delivery_charge" class="form-control"
                       value="{{$result->extra_delivery_charge}}">
            </div>--}}
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="productdesc">Product Description</label>
            <textarea id="elm1" class="form-control summernote" name="product_details">
                                        {!! $result->product_details !!}
                                    </textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="productdesc">Product Specification</label>
            <textarea class="form-control summernote" id="productdesc"
                      name="product_specification">
                                         {!! $result->product_specification !!}
                                    </textarea>
        </div>

    </div>


</div>
<div class="row">
    <div class="col-sm-4">

        <div class="form-group">
            <label for="productdesc">Meta Title</label>
            <textarea class="form-control" id="productdesc" name="meta_title"
                      rows="5">{{$result->meta_title}}</textarea>
        </div>
    </div>
    <div class="col-sm-4">

        <div class="form-group">
            <label for="productdesc">Meta Kywords</label>
            <textarea class="form-control" id="productdesc" name="meta_keywords"
                      rows="5">{{$result->meta_keywords}}</textarea>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="productdesc">Meta Description</label>
            <textarea class="form-control" id="productdesc" name="meta_description"
                      rows="5">{{$result->meta_description}}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="product_color">Featured Image</label>
        <input type="file" class="form-control" name="featured">
    </div>

    <div class="col-md-6">
        <h4 class="card-title mb-3">Product Images</h4>
        <div class="fallback">
            <input name="image[]" type="file" multiple/>
        </div>

        <div class="dz-message needsclick">
            <div class="mb-3">
                <i class="display-4 text-muted bx bxs-cloud-upload"></i>
            </div>

        </div>

    </div>


    <div class="col-md-6">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon3">Youtube Link :</span>
            </div>
            <input type="text" class="form-control" name="video" id="video"
                   aria-describedby="basic-addon3" value="{{$result->video}}">
        </div>
    </div>


</div>
