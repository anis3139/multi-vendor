<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\product_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleProductView extends Controller
{
    public function index($slug)
    {
        $singleData = [];

        $singleData['productDetails'] = product_table::with('cat', 'img', 'brand', 'maserment', 'vendor', 'color', 'reviews')->where('product_slug', $slug)->where('product_active', 1)->first();
        $singleData['relatedProducts'] = product_table::with('cat', 'img', 'brand', 'maserment', 'vendor', 'color', 'reviews')->whereNotIn('id', [$singleData['productDetails']->id])->where('product_active', 1)->take(4)->get();

        $singleData['reatings'] = DB::select("SELECT
    *
FROM
    reating_reviews
        LEFT JOIN
    users ON users.id = reating_reviews.user_id
WHERE
    product_id = 1");
        // dd($singleData['productDetails']);
        if ($singleData['productDetails'] == null) {
            return redirect()->route('client.home');
        }

        return view('productView', $singleData);
    }
}
