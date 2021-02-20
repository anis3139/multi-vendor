<?php

namespace App\Http\Controllers;

use App\Models\product_table;
use App\Models\ProductsCategoryModel;
use App\Models\SliderModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = SliderModel::limit(4)->orderBy('id', 'desc')->get();
        $categories = ProductsCategoryModel::where('parent_id', 0)->get();
        $featureProducts = product_table::with('img')->where('product_active', 1)->where('feture_products', 1)->limit(6)->get();
        $recomeded = product_table::with('img')->where('product_active', 1)->limit(60)->paginate(4);
        $flshProducts = product_table::with('img')->where('product_active', 1)->where('feture_products', 1)->take(6)->get();


        return view('index')
            ->with('slider', $sliders)
            ->with('featureProducts', $featureProducts)
            ->with('recomededs', $recomeded)
            ->with('flshProducts', $flshProducts)
            ->with('categories', $categories);
    }
}
