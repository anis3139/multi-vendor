<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\User;
use App\Mail\registrationVarificationMail;
use App\Notifications\userRegistrationNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class authController extends Controller
{




    public function registration()
    {
        return view('auth.registerUser');
    }


    public function showLogin()
    {
        return view('auth.loginUser');
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


        if (Auth::attempt($credentials)) {

            if (auth()->user()->email_verified_at == null) {
                auth()->logOut();
                session()->flash('warning', 'Your Account is not Active. Please Check Your Email');
                return redirect()->route('client.login');
            } else {
                $request->session()->regenerate();
                session()->flash('success', 'Login Success');
                return redirect()->route('client.checkout');
            }
        }
        session()->flash('error', 'The provided credentials do not match our records.');
        return redirect()->back();
    }

    public function logOut()
    {

        auth()->logout();
        session()->flash('success', 'Logout Success');
        return redirect()->route('home');
    }

    public function addUser(Request $request)
    {


        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required | email |unique:users,email',
            'phone_number' => 'required|min:8| max:16|unique:users,phone_number',
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

        $user = new User();
        $user->name = $name;
        $user->phone_number = $phone_number;
        $user->email = $email;
        $user->password = $password;
        $user->email_verification_token = uniqid(time() . $email, true) . Str::random(40);
        $user->save();



        $user->notify(new userRegistrationNotification($user));



        session()->flash('success', 'Registration Successfull! Please Check Your Mail For Active your Account');
        return redirect()->route('client.registration');
    }



    public function userActive($token = null)
    {
        if ($token == null) {
            return redirect()->route('client.home');
        }

        $user = User::where('email_verification_token', $token)->firstOrFail();

        if ($user) {
            $user->email_verified_at = Carbon::now();
            $user->email_verification_token = null;
            $user->save();
            session()->flash('success', 'Your Account Varified Successfully');
            return redirect()->route('client.login');
        }
    }


    public function profile()
    {

        $data = [];
        $data['orders'] = Orders::where('user_id', auth()->user()->id)->get();

        return view('profile', $data);
    }

    public function forgot()
    {
        return view('auth.forgot');
    }


    public function forgotPassword(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user == null) {
            return redirect()->back()->with('error', 'Email not Exist !');
        }


        Mail::to($user->email)->send(new registrationVarificationMail($user));

        return redirect()->back()->with('success', 'Please Check your Mail For new Password !');
    }


    public function recoverPassWord($id = null)
    {

        if ($id == null) {
            session()->flash('error', 'Wrong varification Token');
            return redirect()->route('client.home');
        }

        $recoveryTocken = $id;
        $email = (explode('-', $recoveryTocken))[0];
        $user = User::where('email', $email)->firstOrFail();
        if ($user) {
            return view('auth.recoverPassword')->with(['user' => $user]);
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

        $data = User::where('email', $request->email)->first();

        $data->password = bcrypt($request->Input('password'));
        $data->save();

        return redirect()->route('client.login')->with('success', 'Password Reset Successfully');
    }



    public function profileEdit($id)
    {
        $data = [];
        $data['user'] = User::where('id', $id)->first();

        return view('profileEdit', $data);
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




        $user = User::findOrFail($id);
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
        return redirect()->route('client.profile');
    }
}
