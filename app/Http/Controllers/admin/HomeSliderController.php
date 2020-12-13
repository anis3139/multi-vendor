<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SliderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    public function SliderIndex(){

        return view('admin.Slider');
    }

    public function SliderData()
    {
        $result = SliderModel::orderBy('id', 'desc')->get();
        return $result;
    }

    function SliderAdd(Request $req)
    {

        $data = json_decode($_POST['data']);
        $name = $data['0']->name;
        $description = $data['0']->description;

        $photoPath =  $req->file('photo')->store('public');
        $photoName = (explode('/', $photoPath))[1];
        $host = $_SERVER['HTTP_HOST'];
        $location = "http://" . $host . "/storage/" . $photoName;
        $result = SliderModel::insert([
            'title' => $name,
            'sub_title' => $description,
            'image' => $location,
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }



    function SliderDetailEdit(Request $req)
    {
        $id = $req->input('id');
        $result = json_encode(SliderModel::where('id', '=', $id)->get());
        return $result;
    }



    function SliderUpdate(Request $req)
    {


        $data = json_decode($_POST['data']);
        $id = $data['0']->id;
        $name = $data['0']->name;
        $description = $data['0']->description;
        if ($req->file('photo')) {


        $delete_old_file = SliderModel::where('id', '=', $id)->first();
        $delete_old_file_name = (explode('/', $delete_old_file->image))[4];

        Storage::delete("public/".$delete_old_file_name);



            $photoPath =  $req->file('photo')->store('public');
            $photoName = (explode('/', $photoPath))[1];
            $host = $_SERVER['HTTP_HOST'];
            $location = "http://" . $host . "/storage/" . $photoName;

            $result = SliderModel::where('id', '=', $id)->update(['title' => $name, 'sub_title' => $description, 'image' => $location]);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        } else {
            $result = SliderModel::where('id', '=', $id)->update(['title' => $name, 'sub_title' => $description]);
            if ($result == true) {
                return 1;
            } else {
                return 0;
            }
        }

    }

    function SliderDelete(Request $req)
    {
        $id = $req->input('id');
        $delete_old_file = SliderModel::where('id', '=', $id)->first();
        $delete_old_file_name = (explode('/', $delete_old_file->image))[4];
        Storage::delete("public/".$delete_old_file_name);
        $result = $delete_old_file->delete();
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }


}
