<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Models\meserments;
use App\Models\product_color;
use App\Models\product_has_images;
use App\Models\product_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.components.Products');
    }



    public function getProductData()
    {
        $result = json_decode(product_table::with(['getCategory', 'getBrand', 'image'])->where('product_owner_id', '0')->orderBy('id', 'desc')->get());
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $data = json_decode($_POST['data']);
        $product_title = $data['0']->product_title;
        $product_discription = $data['0']->product_discription;
        $product_price = $data['0']->product_price;
        $product_saving = $data['0']->product_saving;
        $product_selling_price = $data['0']->product_selling_price;
        $product_quantity = $data['0']->product_quantity;
        $product_category_id = $data['0']->product_category_id;
        $product_brand_id = $data['0']->product_brand_id;
        $product_in_stock = $data['0']->product_in_stock;
        $feture_products = $data['0']->feture_products;
        $product_active = $data['0']->product_active;
        $pdmesermentValue = $data['0']->pdmesermentValue;
        $product_colors = $data['0']->product_colors;
        $selectedmesermentId = $data['0']->selectedmesermentId;
        $pdTax = $data['0']->pdTax;
        $deliveryCharge = $data['0']->deliveryCharge;
        $product_delivary_charge_type = $data['0']->product_delivary_charge_type;

        $slug = Str::slug($product_title);
        $next = 2;
        while (product_table::where('product_slug', '=', $slug)->first()) {
            $slug = $slug . "-" . $next;
            $next++;
        }

        $result = new product_table();
        $result->product_title = $product_title;
        $result->product_discription = $product_discription;
        $result->product_price = $product_price;
        $result->product_saving = $product_saving;
        $result->product_selling_price = $product_selling_price;
        $result->product_quantity = $product_quantity;
        $result->product_category_id = $product_category_id;
        $result->product_brand_id = $product_brand_id;
        $result->product_in_stock = $product_in_stock;
        $result->feture_products = $feture_products;
        $result->product_meserment_type = $selectedmesermentId;
        $result->product_active = $product_active;
        $result->product_slug = $slug;
        $result->product_tax = $pdTax;
        $result->product_delivary_charge = $deliveryCharge;
        $result->product_delivary_charge_type = $product_delivary_charge_type;
        $result->save();
        $last_id = $result->id;


        if (count($request->images) > 0) {
            $i = 0;
            foreach ($request->images as $image) {

                $img = time() . $i . '.' . $image->getClientOriginalExtension();
                $image->move('storage', $img);
                $productImageOnehost = $_SERVER['HTTP_HOST'];
                $host = $_SERVER['HTTP_HOST'];
                $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
                $productImageOnelocation = $protocol . $productImageOnehost .  "/storage/" . $img;
                $imagemodel = new product_has_images();
                $imagemodel->image_path = "$productImageOnelocation";
                $imagemodel->has_images_product_id = $last_id;
                $imagemodel->save();
                $i++;
            }
        }

        if (count($pdmesermentValue) > 0) {

            for ($mersement = 0; $mersement < count($pdmesermentValue); $mersement++) {
                $pdmeserment = new meserments();
                $pdmeserment->product_id = $last_id;
                $pdmeserment->meserment_value = $pdmesermentValue[$mersement];
                $pdmeserment->save();
            }
        }
        if (count($product_colors) > 0) {

            for ($color = 0; $color < count($product_colors); $color++) {
                $pdmeserment = new product_color();
                $pdmeserment->product_color_product_id = $last_id;
                $pdmeserment->product_color_code = $product_colors[$color];
                $pdmeserment->save();
            }
        }



        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req)
    {
        $id = $req->input('id');
        $result = json_encode(product_table::with(['getCategory', 'getBrand', 'image', 'vendor', 'maserment', 'color'])->where('id', '=', $id)->get());
        return $result;
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


        $data = json_decode($_POST['data']);
        $product_id_edit = $data['0']->product_id_edit;
        $pdEditName = $data['0']->pdEditName;
        $pdEditDescription = $data['0']->pdEditDescription;
        $pdEditPrice = $data['0']->pdEditPrice;
        $pdEditSaving = $data['0']->pdEditSaving;
        $pdEditOffer = $data['0']->pdEditOffer;
        $pdEditQuantity = $data['0']->pdEditQuantity;
        $pdEditCategory = $data['0']->pdEditCategory;
        $pdEditBrand = $data['0']->pdEditBrand;
        $pdEditStock = $data['0']->pdEditStock;
        $pdEditFeature = $data['0']->pdEditFeature;
        $pdEditStatus = $data['0']->pdEditStatus;
        $pdmesermentValueEdit = $data['0']->pdmesermentValueEdit;
        $slelctedmesermentEdit = $data['0']->slelctedmesermentEdit;
        $editedValueOfColor = $data['0']->editedValueOfColor;
        $pdEditTax = $data['0']->pdEditTax;
        $deliveryEditCharge = $data['0']->deliveryEditCharge;
        $product_delivary_charge_type_edit = $data['0']->product_delivary_charge_type_edit;




        if ($pdmesermentValueEdit !== null) {
            meserments::where('product_id', $product_id_edit)->delete();

            for ($meserments = 0; $meserments < count($pdmesermentValueEdit); $meserments++) {
                $data = new meserments();
                $data->product_id = $product_id_edit;
                $data->meserment_value = $pdmesermentValueEdit[$meserments];
                $data->save();
            }
        }

        if (isset($editedValueOfColor)) {
            product_color::where('product_color_product_id', $product_id_edit)->delete();

            for ($colors = 0; $colors < count($editedValueOfColor); $colors++) {
                $dataColor = new product_color();
                $dataColor->product_color_code = $editedValueOfColor[$colors];
                $dataColor->product_color_product_id = $product_id_edit;
                $dataColor->save();
            }
        }




        if ($request->has('images')) {

            $product_has_images = product_has_images::where('has_images_product_id', $product_id_edit)->get();
            foreach ($product_has_images as  $product_has_images_value) {
                $delete_old_file = product_has_images::where('id', '=', $product_has_images_value->id)->first();
                $delete_old_file_name = (explode('/', $delete_old_file->image_path))[4];
                Storage::delete("public/" . $delete_old_file_name);
                $delete_old_file->delete();
            }



            $i = 0;
            foreach ($request->images as $image) {
                $img = time() . $i . '.' . $image->getClientOriginalExtension();
                $image->move('storage', $img);
                $productImageOnehost = $_SERVER['HTTP_HOST'];
                $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';

                $productImageOnelocation = $protocol . $productImageOnehost .  "/storage/" . $img;
                $imagemodel = new product_has_images();
                $imagemodel->image_path = $productImageOnelocation;
                $imagemodel->has_images_product_id = $product_id_edit;
                $imagemodel->save();
                $i++;
            }


            $result = product_table::where('id', '=', $product_id_edit)->first();
            $result->product_title = $pdEditName;
            $result->product_discription = $pdEditDescription;
            $result->product_price = $pdEditPrice;
            $result->product_saving = $pdEditSaving;
            $result->product_selling_price = $pdEditOffer;
            $result->product_quantity = $pdEditQuantity;
            $result->product_category_id = $pdEditCategory;
            $result->product_brand_id = $pdEditBrand;
            $result->product_in_stock = $pdEditStock;
            $result->feture_products = $pdEditFeature;
            $result->product_active = $pdEditStatus;
            $result->product_meserment_type = $slelctedmesermentEdit;
            $result->product_tax = $pdEditTax;
            $result->product_delivary_charge = $deliveryEditCharge;
            $result->product_delivary_charge_type = $product_delivary_charge_type_edit;
            $status = $result->save();

            if ($status == true) {
                return 1;
            } else {
                return 0;
            }
        } else {

            $result = product_table::where('id', '=', $product_id_edit)->first();
            $result->product_title = $pdEditName;
            $result->product_discription = $pdEditDescription;
            $result->product_price = $pdEditPrice;
            $result->product_saving = $pdEditSaving;
            $result->product_selling_price = $pdEditOffer;
            $result->product_quantity = $pdEditQuantity;
            $result->product_category_id = $pdEditCategory;
            $result->product_brand_id = $pdEditBrand;
            $result->product_in_stock = $pdEditStock;
            $result->feture_products = $pdEditFeature;
            $result->product_active = $pdEditStatus;
            $result->product_meserment_type = $slelctedmesermentEdit;
            $result->product_tax = $pdEditTax;
            $result->product_delivary_charge = $deliveryEditCharge;
            $result->product_delivary_charge_type = $product_delivary_charge_type_edit;
            $status = $result->save();

            if ($status == true) {
                return 1;
            } else {
                return 0;
            }
        }
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
        $product_has_images = product_has_images::where('has_images_product_id', $id)->get();

        foreach ($product_has_images as  $product_has_images_value) {

            $delete_old_file = product_has_images::where('id', '=', $product_has_images_value->id)->first();
            $delete_old_file_name = (explode('/', $delete_old_file->image_path))[4];

            Storage::delete("public/" . $delete_old_file_name);
            $result2 = $delete_old_file->delete();
        }

        $product_maserments = meserments::where('product_id', $id)->get();
        foreach ($product_maserments as  $product_maserment) {

            $delete_old_meserment_data = meserments::where('id', '=', $product_maserment->id)->first();

            $result3 = $delete_old_meserment_data->delete();
        }

        $product_colors = product_color::where('product_color_product_id', $id)->get();
        foreach ($product_colors as  $product_color) {

            $delete_old_color_data = product_color::where('id', '=', $product_color->id)->first();

            $result4 = $delete_old_color_data->delete();
        }

        $data = product_table::where('id', '=', $id)->first();
        $result = $data->delete();
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
