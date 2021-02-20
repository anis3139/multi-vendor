<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Vendor;
use App\Notifications\VendorPasswordRecoverNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class vendorAuthController extends Controller
{




    public function registration()
    {
        return view('vendor.register');
    }


    public function showLogin()
    {
        return view('vendor.login');
    }

    public function onlogin(Request $request)
    {


        $validator = Validator::make(request()->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = request()->only(['email', 'password']);


        if (Auth::guard('vendor')->attempt($credentials)) {



            if (Auth::guard('vendor')->user()->status == 0) {
                Auth::guard('vendor')->logOut();
                session()->flash('error', 'Your Account is not Active. Please Wait Form Confirmation');
                return redirect()->route('vendor.login');
            } else {
                $request->session()->regenerate();
                session()->flash('success', 'Login Success');
                return redirect()->route('vendor.home');
            }
        }
        session()->flash('error', 'The provided credentials do not match our records.');
        return redirect()->back();
    }

    public function logOut()
    {

        if (Auth::guard('vendor')->logout()) {
            return redirect()->route('vendor.login')->with('status', 'Logout Successfull');
        } else {
            return redirect()->route('vendor.login')->with('status', 'Logout Successfull');
        }
    }

    public function addVendor(Request $request)
    {


        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required | email |unique:vendors,email',
            'phone_number' => 'required|min:8| max:16|unique:vendors,phone_number',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $name = $request->Input('name');
        $phone_number = $request->Input('phone_number');
        $email = strtolower($request->Input('email'));
        $password = bcrypt($request->Input('password'));

        $user = new Vendor();
        $user->name = $name;
        $user->phone_number = $phone_number;
        $user->email = $email;
        $user->password = $password;
        $user->save();

        session()->flash('success', 'Registration Successfull!  Please Wait Form Confirmation');
        return redirect()->route('vendor.registration');
    }



    public function forgot()
    {
        return view('vendor.forgot');
    }


    public function forgotPassword(Request $request)
    {

        $vendor = Vendor::where('email', $request->email)->first();

        if ($vendor == null) {
            return redirect()->back()->with('error', 'Email not Exist !');
        }


        $vendor->notify(new VendorPasswordRecoverNotification($vendor));

        return redirect()->back()->with('success', 'Please Check your Mail For new Password !');
    }


    public function recoverPassWord($id = null)
    {

        if ($id == null) {
            session()->flash('error', 'Wrong varification Token');
            return redirect()->route('vendor.home');
        }

        $recoveryTocken = $id;
        $vendor_id = (explode('_', $recoveryTocken))[0];

        $vendor = Vendor::where('id', $vendor_id)->firstOrFail();
        if ($vendor) {
            return view('vendor.recoverPassword')->with(['vendor' => $vendor]);
        }
    }


    public function updatePassword(Request $request)
    {
        $validator = Validator::make(request()->all(), [

            'email' => 'required | email',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = Vendor::where('email', $request->email)->first();

        $data->password = bcrypt($request->Input('password'));
        $data->save();

        return redirect()->route('vendor.login')->with('success', 'Password Reset Successfully');
    }


    public function profile()
    {

        $data = [];
        $data['vendor'] = Vendor::where('id', auth()->user()->id)->get();

        return view('vendor.profile.profile', $data);
    }

    public function profileEdit($id)
    {
        $data = [];
        $data['user'] = Vendor::where('id', $id)->first();

        return view('vendor.profile.profileEdit', $data);
    }



    public function upadeteProfile(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'email' => 'required | email',
            'phone_number' => 'required|min:8| max:16',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $name = $request->Input('name');
        $phone_number = $request->Input('phone_number');
        $address = $request->Input('address');
        $city = $request->Input('city');
        $district = $request->Input('district');
        $postal_code = $request->Input('postal_code');
        $email = strtolower($request->Input('email'));
        $password = bcrypt($request->Input('password'));




        $user = Vendor::findOrFail($id);
        $user->name = $name;
        $user->phone_number = $phone_number;
        $user->email = $email;

        if ($request->hasFile('image')) {
            $photoPath =  $request->file('image')->store('public');
            $photoName = (explode('/', $photoPath))[1];
            $host = $_SERVER['HTTP_HOST'];
            $protocol = $_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://';
            $location = $protocol . $host .  "/storage/" . $photoName;
            $user->image = $location;
        }

        $user->address = $address;
        $user->city = $city;
        $user->district = $district;
        $user->postal_code = $postal_code;
        $user->password = $password;
        $user->email_verification_token = uniqid(time() . $email, true) . Str::random(40);
        $user->save();

        session()->flash('success', 'Profile Updated Successfully');
        return redirect()->route('vendor.profile');
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
