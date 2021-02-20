<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\askAboutProduct as ModelsAskAboutProduct;
use App\Models\product_table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AskAboutProduct extends Controller
{
    public function store(Request $request)
    {
        $productId = $request->product_id;
        $messege = $request->messege;
        $product_details = product_table::where('id', $productId)->first();
        // dd($product_details->product_owner_id);

        $ask = new ModelsAskAboutProduct();
        $ask->product_id = $productId;
        $ask->sender_id = Auth::user()->id;
        $ask->reciver_id = $product_details->product_owner_id;
        $ask->messege = $messege;
        $status = $ask->save();

        if ($status == true) {
            return 1;
        } else {
            return 0;
        }
    }


    public function getallmessege(Request $request)
    {
        $productId = $request->product_id;
        $product_details = product_table::where('id', $productId)->first();
        $userID = Auth::user()->id;

        $sql = "SELECT
                ask_about_products.id,
                ask_about_products.product_id,
                ask_about_products.sender_id,
                ask_about_products.reciver_id,
                ask_about_products.messege,
                ask_about_products.created_at,
                ask_about_products.updated_at,
                users.id as userId,
                users.image as userImage,
                users.name as username,
                vendors.id as vendorID,
                vendors.name as vendorName

            FROM
                ovender.ask_about_products
                    LEFT JOIN
                users ON users.id = ask_about_products.sender_id
                    LEFT JOIN
                vendors ON vendors.id = ask_about_products.reciver_id
                where ask_about_products.product_id =$productId order by created_at asc";


        $data = DB::select($sql);
        return response()->json(array('messegedata' => $data, 'userid' => $userID, 'ownerId' => $product_details->product_owner_id));
    }
}
