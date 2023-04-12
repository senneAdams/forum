<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $validate = $request->validate([
            'email'    => 'required|email|string',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('viewPostIndex');
        }
        return back()->withErrors('De opgegeven username/password combinatie klopt niet.');
    }

    public function logOut()
    {
        Auth::logout();

        return redirect('/viewLogin');
    }
}
