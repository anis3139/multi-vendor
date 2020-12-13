<?php

namespace App\Http\Controllers\Omart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class omart extends Controller
{
    public function index()
    {
        return view('omart');
    }
}
