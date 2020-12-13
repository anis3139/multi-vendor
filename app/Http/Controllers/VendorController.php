<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function login(Request $request)
    {
        $credentials=$request->only('email','password');

        if (Auth::guard('vendor')->attempt($credentials,$request->remember)) {
            $user=Vendor::where('email',$request->email)->first();
            Auth::guard('vendor')->login($user);
            return redirect()->route('vendor.home');
        }else{
            return redirect()->route('vendor.login')->with('status','failed to login prosess');
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('vendor.home');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('vendor')->logout()) {
            return redirect()->route('admin.login');
        }
    }


    protected function guard()
    {
        return Auth::guard('vendor');
    }


    protected function loggedOut(Request $request)
    {
        return redirect()->route('vendor.login');
    }
}
