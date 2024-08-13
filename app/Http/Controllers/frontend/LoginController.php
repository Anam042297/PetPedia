<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('frontend.login');
    }
    public function showregisterform()
    {
        return view('frontend.register');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                "name" => 'required|string|max:255|regex:/^[a-zA-Z]+$/u',
                'email' => 'required|string|max:255|email',
                'password' => 'required|min:8|max:20|confirmed|regex:/[A-Za-z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            ]
        );
        $dataEntered = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => hash::make($request->password)
        ]);
        // dd( $dataEntered);
        if ($dataEntered == null) {
            return redirect()->back();
        } else {
            return view('frontend.login');
        }
    }

    public function login(Request $request)
    {
        // dd($request->all());

        $credentials = $request->validate(
            [
                'email' => 'required|string',
                'password' => 'required|string',
            ]
        );
        // dd( $credentials);
        // dd(Auth::attempt($credentials));
        // $user =User::where('email', $credentials['email'])->first();
        // if ($user && \Hash::check($request->password, $user->password)) {
        //     dd('Password matches');
       // } else {
       //     dd('Password does not match');
       // }
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {

                return redirect('/admin/index');
            } else {
                return redirect('/');
            }

        } else {
            return redirect()->back()->with('error', "Invalid Credentials");
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
