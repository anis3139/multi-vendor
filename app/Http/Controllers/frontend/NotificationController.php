<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $userId=Auth::id();
        $allnotify=Notification::where('userID',$userId)->orderBy('created_at','desc')->get();
        $unreadNotify=Notification::where('userID',$userId)->where('is_seen',0)->get();

        return response()->json(array('allnotify'=>$allnotify,'unreadNotify'=>$unreadNotify));

    }

    public function show(Request $request)
    {
        $id=$request->id;
        $update=Notification::find($id);
        $update->is_seen=1;
        $update->save();


        $data=Notification::where('id',$id)->first();
        return $data;

    }
}
