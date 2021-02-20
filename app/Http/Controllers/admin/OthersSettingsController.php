<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\OthersModel;
use Illuminate\Http\Request;

class OthersSettingsController extends Controller
{
    public function otherIndex()
    {

        $results = json_decode(OthersModel::orderBy('id', 'desc')->get()->first());


        return view('admin.components.Others', [
            'results' => $results
        ]);
    }


    public function addAddress(Request $request)
    {
        $address = $request->input("address");

        $valuecheck = (OthersModel::orderBy('id', 'desc')->get());



        if (count($valuecheck) > 0) {
            $result = OthersModel::where('id', '=',  $valuecheck['0']->id)->update(['address' => $address]);
        } else {
            $result = OthersModel::insert(['address' => $address]);
        }
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }


    public function addPhone(Request $request)
    {
        $phone = $request->input("phone");

        $valuecheck = (OthersModel::orderBy('id', 'desc')->get());



        if (count($valuecheck) > 0) {
            $result = OthersModel::where('id', '=',  $valuecheck['0']->id)->update(['phone' => $phone]);
        } else {
            $result = OthersModel::insert(['phone' => $phone]);
        }
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }


    public function addEmail(Request $request)
    {
        $email = $request->input("email");

        $valuecheck = (OthersModel::orderBy('id', 'desc')->get());



        if (count($valuecheck) > 0) {
            $result = OthersModel::where('id', '=',  $valuecheck['0']->id)->update(['email' => $email]);
        } else {
            $result = OthersModel::insert(['email' => $email]);
        }
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }


    public function addTitle(Request $request)
    {
        $title = $request->input("title");

        $valuecheck = (OthersModel::orderBy('id', 'desc')->get());



        if (count($valuecheck) > 0) {
            $result = OthersModel::where('id', '=',  $valuecheck['0']->id)->update(['title' => $title]);
        } else {
            $result = OthersModel::insert(['title' => $title]);
        }
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }

    public function addGmap(Request $request)
    {
        $gmap = $request->input("gmap");

        $valuecheck = (OthersModel::orderBy('id', 'desc')->get());



        if (count($valuecheck) > 0) {
            $result = OthersModel::where('id', '=',  $valuecheck['0']->id)->update(['gmap' => $gmap]);
        } else {
            $result = OthersModel::insert(['gmap' => $gmap]);
        }
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }











    function logoAdd(Request $req)
    {

        $valuecheck = (OthersModel::orderBy('id', 'desc')->get());
        $photoPath =  $req->file('photo')->store('public');
        $photoName = (explode('/', $photoPath))[1];
        $host = $_SERVER['HTTP_HOST'];
        $location = "http://" . $host . "/storage/" . $photoName;
        if (count($valuecheck) > 0) {
            $result = OthersModel::where('id', '=',  $valuecheck['0']->id)->update(['logo' => $location]);
        } else {
            $result = OthersModel::insert(['logo' => $location]);
        }
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }

    function BannerAdd(Request $req)
    {

        $valuecheckBanner = (OthersModel::orderBy('id', 'desc')->get());
        $BannerPath =  $req->file('Banner')->store('public');
        $BannerName = (explode('/', $BannerPath))[1];
        $hostBanner = $_SERVER['HTTP_HOST'];
        $locationBanner = "http://" . $hostBanner . "/public/public/storage/" . $BannerName;
        if (count($valuecheckBanner) > 0) {
            $result = OthersModel::where('id', '=',  $valuecheckBanner['0']->id)->update(['hero_banner' => $locationBanner]);
        } else {
            $result = OthersModel::insert(['hero_banner' => $locationBanner]);
        }
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }


    function promoImageOne(Request $req)
    {

        $valuecheckpromoImageOne = (OthersModel::orderBy('id', 'desc')->get());
        $promoImageOnePath =  $req->file('promoImageOne')->store('public');
        $promoImageOneName = (explode('/', $promoImageOnePath))[1];
        $hostpromoImageOne = $_SERVER['HTTP_HOST'];
        $locationpromoImageOne = "http://" . $hostpromoImageOne . "/public/public/storage/" . $promoImageOneName;
        if (count($valuecheckpromoImageOne) > 0) {
            $result = OthersModel::where('id', '=',  $valuecheckpromoImageOne['0']->id)->update(['promo_image_one' => $locationpromoImageOne]);
        } else {
            $result = OthersModel::insert(['promo_image_one' => $locationpromoImageOne]);
        }
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }

    function promoImageTwo(Request $req)
    {

        $valuecheckpromoImageTwo = (OthersModel::orderBy('id', 'desc')->get());
        $promoImageTwoPath =  $req->file('promoImageTwo')->store('public');
        $promoImageTwoName = (explode('/', $promoImageTwoPath))[1];
        $hostpromoImageTwo = $_SERVER['HTTP_HOST'];
        $locationpromoImageTwo = "http://" . $hostpromoImageTwo . "/public/public/storage/" . $promoImageTwoName;
        if (count($valuecheckpromoImageTwo) > 0) {
            $result = OthersModel::where('id', '=',  $valuecheckpromoImageTwo['0']->id)->update(['promo_image_two' => $locationpromoImageTwo]);
        } else {
            $result = OthersModel::insert(['promo_image_two' => $locationpromoImageTwo]);
        }
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }


    function promoImageThree(Request $req)
    {

        $valuecheckpromoImageThree = (OthersModel::orderBy('id', 'desc')->get());
        $promoImageThreePath =  $req->file('promoImageThree')->store('public');
        $promoImageThreeName = (explode('/', $promoImageThreePath))[1];
        $hostpromoImageThree = $_SERVER['HTTP_HOST'];
        $locationpromoImageThree = "http://" . $hostpromoImageThree . "/public/public/storage/" . $promoImageThreeName;
        if (count($valuecheckpromoImageThree) > 0) {
            $result = OthersModel::where('id', '=',  $valuecheckpromoImageThree['0']->id)->update(['promo_image_three' => $locationpromoImageThree]);
        } else {
            $result = OthersModel::insert(['promo_image_three' => $locationpromoImageThree]);
        }
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
