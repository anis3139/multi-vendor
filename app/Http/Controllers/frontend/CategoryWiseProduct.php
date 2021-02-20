<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\product_table;
use App\Models\ProductsBrandModel;
use App\Models\ProductsCategoryModel;
use Illuminate\Http\Request;

class CategoryWiseProduct extends Controller
{
    public function index(Request $request,$slug)
    {
        $category=ProductsCategoryModel::where('slug',$slug)->first();
        $brands=ProductsBrandModel::where('products_category_id',$category->id)->get();

        $CatWiseAllProducts=product_table::with(['img', 'brand'])->where('product_category_id',  $category->id)->where('product_active', 1)->paginate(12);
        $featureProducts=product_table::with('img')->where('product_category_id',  $category->id)->where('product_active', 1)->where('feture_products', 1)->limit(5)->get();

       

        return view('categoryWiseProduct.categoryWiseProductHome')
        ->with('category',$category)
        ->with('featureProducts',$featureProducts)
        ->with('CatWiseAllProducts',$CatWiseAllProducts)
        ->with('brands',$brands);
    }
}
