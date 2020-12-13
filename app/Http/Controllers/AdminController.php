<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        $credentials=$request->only('email','password');

        if (Auth::guard('admin')->attempt($credentials,$request->remember)) {
            $user=Admin::where('email',$request->email)->first();
            Auth::guard('admin')->login($user);
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.login')->with('status','failed to login prosess');
        }
    }




    public function logout(Request $request)
    {
        if (Auth::guard('admin')->logout()) {
            return redirect()->route('admin.login')->with('status','Admin logout susccessfuly');
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('admin.home');
    }




    protected function guard()
    {
        return Auth::guard('admin');
    }


    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }
}
