<?php

namespace App\Http\Controllers;

use App\ParentCategory;
use App\Product;
use App\ProductCategory;
use App\Slider;
use Illuminate\Http\Request;

class FrontendCategoryProductsController extends Controller
{

    public function show($id){
          $category  = ProductCategory::where('category_id',$id)->first();
         $products = Product::join('product_categories','product_categories.category_id','=','products.product_category_id')
                            ->where('product_category_id',$id)->get();
        return view('common.category.category_products')
                    ->with('product',$products)
                    ->with('category',$category);
    }

}
