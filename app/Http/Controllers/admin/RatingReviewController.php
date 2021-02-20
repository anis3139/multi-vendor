<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ReatingReview;
use Illuminate\Http\Request;

class RatingReviewController extends Controller
{
    public function reviewIndex()
    {
        return view('admin.components.reviewRating');
    }

    public function getReviewdata()
    {
       $result=json_decode(ReatingReview::with('user','product','vendor')->orderBy('id', 'desc')->get());
       return  $result;
    }
    public function deleteReview(Request $request)
    {
        $id = $request->input('id');
        $result = ReatingReview::where('id', '=', $id)->delete();
        if ($result == true) {
            return 1;
        } else {
            return 0;
        }
    }
}
