<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\pagesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function PageIndex()
    {
       return view('admin.components.pages');
    }

    public function PagesData()
    {
        $result = pagesModel::orderBy('id', 'desc')->get();
        return $result;
    }

    function PagesAdd(Request $req)
    {

        $data = json_decode($_POST['data']);
        $name = $data['0']->name;
        $description = $data['0']->description;


        $slug = Str::slug($name);
        $next = 2;
        while (pagesModel::where('slug', '=', $slug)->first()) {
            $slug = $slug . "-" . $next;
            $next++;
        }


        $result = pagesModel::insert([
            'title' => $name,
            'description' => $description,
            'slug'=> $slug
        ]);
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }

    }



    function PagesDetailEdit(Request $req)
    {
        $id = $req->input('id');
        $result = json_encode(pagesModel::where('id', '=', $id)->get());
        return $result;
    }



    function PagesUpdate(Request $req)
    {


        $data = json_decode($_POST['data']);
        $id = $data['0']->id;
        $name = $data['0']->name;
        $description = $data['0']->description;
        $result = pagesModel::where('id', '=', $id)->update(['title' => $name, 'description' => $description]);

        if ($result == true) {
            return 1;
        } else {
            return 0;
        }

    }

    function PagesDelete(Request $req)
    {
        $id = $req->input('id');
        $result = pagesModel::where('id', '=', $id)->delete();
        if ($result == true) {
            return 1;
        } else {
            return 0;

        }
    }




}
