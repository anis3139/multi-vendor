<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\product_table;
use Illuminate\Http\Request;

class allProductController extends Controller
{
    public function index(Request $request)
    {
        $allProducts=product_table::with('img')->where('product_active', 1)->paginate(12);
        return view('shop.shopPage')->with('allProducts',$allProducts);

    }



    public function index2(Request $request)
    {
        $allProducts=product_table::with('img')->where('product_active', 1)->where('feture_products',1)->paginate(12);
        return view('shop.flushproduct')->with('allProducts',$allProducts);

    }

    public function search(Request $request)
    {
        $key=$request->key;

        if($key != ""){
            $searchProducts=product_table::with(['img'])->where('product_active', 1)->Where('product_title','LIKE',"%{$key}%")->orderBy('id', 'desc')->paginate(12);

            if(count($searchProducts)>0){
                return view('shop.search', compact('searchProducts','key'));
            }
        }
        return view('shop.search', compact('searchProducts','key'));


    }
}
