<?php

namespace App\Http\Controllers\admin\vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function vendorIndex()
    {

        return view('admin.vendor.vendorIndex');
    }


    public function vendorData()
    {
        $result = json_decode(Vendor::orderBy('id', 'desc')->get());

        return $result;

    }


    function vendorDelete(Request $req)
    {
        $id = $req->input('id');
        $result = Vendor::where('id', '=', $id)->delete();
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }

    function vendorDetailEdit(Request $req)
    {
        $id = $req->input('id');
        $result = json_encode(Vendor::where('id', '=', $id)->get());
        return $result;
    }



    function vendorDataUpdate(Request $req)
    {

        $id = $req->Input('id');
        $vendor=Vendor::where('id', '=', $id)->first();

        $this->validate($req, [
            'name' => 'required',
            'email' => 'required |unique:vendors,email,' .$vendor->id,
            'phone_number_edit' => 'required|min:8| max:16|required |unique:vendors,phone_number,'.$vendor->id,
            'status_edit' => 'required'

          ]);

        $id = $req->Input('id');
        $name = $req->Input('name');
        $email = strtolower($req-> Input('email'));
        $phone_number_edit = $req-> Input('phone_number_edit');
        $status_edit = $req-> Input('status_edit');


        $result = Vendor::where('id', '=', $id)->update([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number_edit,
            'status' => $status_edit,
            ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }



    function vendorAdd(Request $req)
    {

        $this->validate($req, [
            'name' => 'required',
            'email' => 'required | email |unique:vendors,email',
            'phone_number' => 'required|min:8| max:16|unique:vendors,phone_number',
            'password' => 'min:6|required',
            'status' => 'required'
          ]);
        $name = $req->Input('name');
        $password = $req->Input('password');
        $email =strtolower( $req->Input('email'));
        $phone_number = $req->Input('phone_number');
        $status = $req->Input('status');


        $result = Vendor::insert([
            'name' => $name,
            'password' =>  bcrypt($password),
            'email' => $email,
            'phone_number' => $phone_number,
            'status' => $status,
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
