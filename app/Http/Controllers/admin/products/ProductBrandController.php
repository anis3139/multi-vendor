<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Models\ProductsBrandModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\PseudoTypes\True_;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.components.Brands');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.components.addBrands');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {



        $data = json_decode($_POST['data']);
        $name = $data['0']->name;
        $categories = $data['0']->categories;
        $photoPath =  $request->file('photo')->store('public');
        $photoName = (explode('/', $photoPath))[1];
        $host = $_SERVER['HTTP_HOST'];
        $location = "http://" . $host . "/storage/" . $photoName;

        $result = ProductsBrandModel::insert([
            'name' => $name,
            'products_category_id' => $categories,
            'image' => $location,
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }

    } catch (\Throwable $th) {
        return response()->json(array('error',$th));
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $req)
    {
        $id = $req->input('id');
        $result = json_encode(ProductsBrandModel::where('id', '=', $id)->get());
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {


        $id = $request->input('id');
        $delete_old_file = ProductsBrandModel::where('id', '=', $id)->first();
        $delete_old_file_name = (explode('/', $delete_old_file->image))[4];
        Storage::delete("public/".$delete_old_file_name);
        $result = $delete_old_file->delete();
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }

    }


    public function getBrandData()
    {
        $brand_result =DB::select("SELECT
            Products_brand.id,
            Products_brand.name AS brandName,
            Products_brand.image,
            Products_brand.products_category_id,
            Products_category.id AS categoryId,
            Products_category.name AS categoryName
        FROM
        products_brand
                LEFT JOIN
            products_category ON products_category.id = products_category_id");

        return $brand_result;
        if ($brand_result == true) {
            return 1;
        } else {
            return 0;
        }
    }

    public function updateBrand(Request $request)
    {

        $data = json_decode($_POST['data']);
        $id = $data['0']->id;
        $name = $data['0']->name;

        $products_category_models_id = $data['0']->products_category_models_id;


        if ($request->file('photo')) {


            $delete_old_file = ProductsBrandModel::where('id', '=', $id)->first();
            $delete_old_file_name = (explode('/', $delete_old_file->image))[4];

            Storage::delete("public/".$delete_old_file_name);



            $photoPath =  $request->file('photo')->store('public');
            $photoName = (explode('/', $photoPath))[1];
            $host = $_SERVER['HTTP_HOST'];
            $location = "http://" . $host . "/storage/" . $photoName;


            $result = ProductsBrandModel::where('id', '=', $id)->update(['name' => $name, 'products_category_id' => $products_category_models_id, 'image' => $location]);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            $result = ProductsBrandModel::where('id', '=', $id)->update(['name' => $name, 'products_category_id' => $products_category_models_id]);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        }

    }

}
