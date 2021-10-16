<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="productname">Product Name</label>
            <input id="productname" name="product_name" type="text" class="form-control"  value="{{$result->product_name}}" required>
            <input name="_token" type="hidden" class="form-control" value="{{csrf_token()}}">
            <input name="whole_sales_product_id" type="hidden" class="form-control"
                   value="{{$result->whole_sales_product_id}}">
        </div>
        <div class="form-group">
            <div class="form-group">

                <label class="control-label">Category ({{getWholeSaleCategoryName($result->category_id)}})</label>


                <select class="form-control" name="category_id" ng-model="category_id"
                        ng-change="changeCategory()" required>
                    @foreach(getWholeSaleCategory() as $category)

                        <option
                            value="{{$category->whole_sale_category_id}}">{{$category->category_name_en}}</option>

                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group">
            <div class="form-group">

                <label class="control-label">Sub-Category ({{getWholeSaleSubCategoryName($result->sub_category_id)}})</label>


                <select class="form-control"
                        name="sub_category_id" ng-model="sub_category_id" required>

                    <option
                        value="@{{sub_category.whole_sale_sub_category_id}}"
                        ng-repeat="sub_category in sub_categories">
                        @{{sub_category.sub_category_name_en}}
                    </option>

                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="manufacturername"> Length</label>
            <input id="manufacturername" name="length" value="{{$result->length}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="manufacturerbrand">Length Class</label>
            <select class="form-control " name="length_class">
                @foreach (getLengthClass() as $key => $value)
                    <option value="{{$key}}" @if($key==$result->length_class)selected @endif>{{$value}}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for="height"> Height</label>
            <input id="height" name="height" type="text" class="form-control"
                   value="{{$result->height}}">
        </div>
        <div class="form-group">
            <label for="manufacturerbrand">Height Class<span
                ></span></label>
            <select class="form-control " name="height_class">
                @foreach (getLengthClass() as $key => $value)
                    <option value="{{ $key}}" @if($key==$result->height_class)selected @endif>{{$value}}</option>
                @endforeach

            </select>
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
        <div class="form-group">
            <label for="product_color">Color<span class="text-danger">*</span></label>
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


    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-md-6">
                <label for="manufacturerbrand">Color Quality
                </label>

                <input id="quantity" name="color_quality" type="text"
                       class="form-control" value="{{$result->color_quality}}" required>

            </div>

            <div class="col-md-6">
                <label for="price">Brand Name</label>
                <select class="select2 form-control select2-multiple"

                        name="brand_id" data-placeholder="Choose ...">
                    <option value="0">Other</option>
                    @foreach (getBrand() as $res)
                        <option
                            value="{{ $res->brand_id}}" @if($res->brand_id == $result->brand_id) selected @endif>
                            {{ $res->brand_name}}</option>
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
                                <option value="{{$shop->shop_id}}" @if($res->shop_id==$shop->shop_id) selected @endif>{{$shop->shop_name}}</option>
                            @endforeach

                        </select>
                    @endif

                </div>
            </div>

            <div class="col-md-6">
                <label for="manufacturerbrand">Stock Status
                </label>
                <select class="form-control " name="stock_status">
                    @foreach (getStockStatus() as $key => $value)
                        <option value="{{ $key}}"
                                @if($key==$res->stock_status)selected @endif>{{$value}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Display category </label>
                <select class="form-control " name="product_type">

                    @foreach (gettingProductType() as $key => $value)
                        <option value="{{ $key}}" @if($key==$res->product_type) selected @endif>{{$value}}</option>
                    @endforeach

                </select>

            </div>

            <div class="col-md-6">
                <label for="qr_code">Qr Code</label>
                <input id="qr_code" name="qr_code" type="text" value="{{getQrCode()}}"
                       class="form-control">

            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Order Quantity
                </label>

                <input id="quantity" name="minimum_order_quantity"
                       value="{{$result->minimum_order_quantity}}" type="number"

                       class="form-control"
                       required>

            </div>

            <div class="col-md-6">
                <label for="manufacturerbrand">Materials
                </label>
                <input id="quantity" name="materials" type="text" value="{{$result->materials}}"
                       class="form-control"
                       required>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Yarn Type
                </label>
                <input id="quantity" name="yarn_type" type="text" value="{{$result->yarn_type}}"
                       class="form-control"
                       required>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Yarn Count
                </label>
                <input id="quantity" name="yarn_count" type="text"
                       value="{{$result->yarn_count}}"

                       class="form-control"
                       required>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Density
                </label>
                <input id="quantity" name="density" type="text" value="{{$result->density}}"
                       class="form-control"
                       required>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Weaving Machine
                </label>

                <input id="quantity" name="weaving_machine" type="text"
                       value="{{$result->weaving_machine}}"

                       class="form-control"
                       required>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Design
                </label>

                <input id="quantity" name="design" type="text" value="{{$result->design}}"

                       class="form-control"
                       required>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Wash Process
                </label>

                <input id="quantity" name="wash_process" type="text"
                       value="{{$result->wash_process}}"

                       class="form-control"
                       required>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Customized Fold
                </label>
                <input id="quantity" name="customized_fold" type="text"
                       value="{{$result->customized_fold}}"

                       class="form-control"
                       required>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Packing
                </label>

                <input id="quantity" name="packing" type="text" value="{{$result->packing}}"

                       class="form-control"
                       required>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Bundle packing
                </label>

                <input id="quantity" name="bundle_packing" type="text"
                       value="{{$result->bundle_packing}}"

                       class="form-control"
                       required>
            </div>
            <div class="col-md-6">
                <label for="manufacturerbrand">Supply Ability
                </label>

                <input id="quantity" name="supply_ability" type="text"
                       value="{{$result->supply_ability}}"

                       class="form-control"
                       required>
            </div>

            <div class="col-md-12">
                <label for="video">Youtube</label>
                <input id="video" name="video" type="text" value="{{$result->video}}"
                       class="form-control">
            </div>

        </div>
    </div>
</div>
<h5>Price Range</h5>
<hr>
@for($i=0;$i<5;$i++)
    <h5 style="margin-top: 10px">Price Range {{$i}}</h5>
    <div class="row">

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="price">Min Order<span class="text-danger"></span></label>
                </div>
                <div class="col-md-8">
                    @if(count( $result->price_range)>$i)
                        <input id="price" name="min_quantity[]" type="number"
                               value="{{$result['price_range'][$i]->min_quantity}}"
                               class="form-control">
                    @else
                        <input id="price" name="min_quantity[]" type="number"
                               class="form-control">
                    @endif


                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="price">Max Order<span class="text-danger"></span></label>
                </div>
                <div class="col-md-8">

                    @if(count( $result->price_range)>$i)
                        <input id="price" name="max_quantity[]" type="number"
                               value="{{$result['price_range'][$i]->max_quantity}}"
                               class="form-control">
                    @else
                        <input id="price" name="max_quantity[]" type="number"
                               class="form-control">
                    @endif
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="price">Price<span class="text-danger"></span></label>
                </div>
                <div class="col-md-8">
                    @if(count( $result->price_range)>$i)
                        <input id="price" name="price[]" type="number"
                               value="{{$result['price_range'][$i]->price}}"
                               class="form-control">
                    @else
                        <input id="price" name="price[]" type="number" class="form-control">
                    @endif

                </div>
            </div>

        </div>
    </div>

@endfor

<br>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="productdesc">Product Description</label>
            <textarea id="elm1" class="form-control summernote"
                      name="product_details"> {!! $result->product_details !!}</textarea>
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
                      rows="5">{!!$result->meta_title !!}</textarea>
        </div>
    </div>
    <div class="col-sm-4">

        <div class="form-group">
            <label for="productdesc">Meta Kywords</label>
            <textarea class="form-control" id="productdesc" name="meta_keywords"
                      rows="5">{!!$result->meta_keywords !!}</textarea>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label for="productdesc">Meta Description</label>
            <textarea class="form-control" id="productdesc" name="meta_description"

                      rows="5">{!! $result->meta_description !!}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="product_color">Featured Image<span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="featured" >
    </div>

    <div class="col-md-6">
        <h4 class="card-title mb-3">Product Images<span class="text-danger">*</span>
        </h4>
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
