<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request) {
        if($request->method() == "GET") {
            return view('user.login', [
                "title" => "Catatan Hutang - Login",
            ]);
        } else {
            $credentials = $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
    
            if (Auth::guard('web')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/debt');
            }
    
            return back()->withInput()->with('failed','Login Failed!');
        }
    }

    public function register(Request $request) {
        if($request->method() == "GET") {
            return view('user.register', [
                "title" => "Catatan Hutang - Register",
            ]);
        } else {
            $credentials = $request->validate([
                'fullname' => 'required',
                'username' => 'required',
                'phone_no' => 'required',
                'email' => 'required',
                'password' => 'required|min:8',
                'confirm-password' => 'required|min:8|same:password',
                'photo' => 'required'
            ]);

            $createUser = User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'phone_no' => $request->phone_no,
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'photo' => CommonFunctions::uploadFiles($request->file('photo'), "USER_PHOTO"),
            ]);

            if(!$createUser) {
                return back()->withInput()->with('failed','Unable to register!');
            }
            return redirect('/user/login')->with('success', 'Account registered successfully!');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/user/login');
    }
}
