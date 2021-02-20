<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
class adminController extends Controller
{
    public function adminIndex()
    {

        return view('admin.components.adminIndex');
    }


    public function adminData()
    {
        $result = json_decode(Admin::orderBy('id', 'desc')->get());

        return $result;

    }


    function adminDelete(Request $req)
    {
        $id = $req->input('id');
        $result = Admin::where('id', '=', $id)->delete();
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }

    function adminDetailEdit(Request $req)
    {
        $id = $req->input('id');
        $result = json_encode(Admin::where('id', '=', $id)->get());
        return $result;
    }



    function adminDataUpdate(Request $req)
    {
        $this->validate($req, [
            'name'  => 'required',
            'password'  => 'required|max:13|min:6',
            'email'  => 'required|email',
          ]);
        $id = $req->Input('id');
        $name = $req->Input('name');
        $password = $req->Input('password');
        $email = strtolower($req-> Input('email'));


        $result = Admin::where('id', '=', $id)->update([
            'name' => $name,
            'password' =>   bcrypt($password),
            'email' => $email
            ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }



    function adminAdd(Request $req)
    {

        $this->validate($req, [
            'name'  => 'required',
            'password'  => 'required|max:13|min:6',
            'email'  => 'required|email',
          ]);
        $name = $req->Input('name');
        $password = $req->Input('password');
        $email =strtolower( $req->Input('email'));


        $result = Admin::insert([
            'name' => $name,
            'password' =>  bcrypt($password),
            'email' => $email
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
