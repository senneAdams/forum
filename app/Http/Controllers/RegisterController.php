<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function registerUser(Request $request)
    {
        $validate = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'username' => 'required'
        ]);

        if (User::where('email', '=', $validate['email'])->count() === 0) {
            $data = [
                'username' => $validate['username'],
                'email'    => $validate['email'],
                'password' => Hash::make($validate['password']),
            ];

            if (User::registerUser($data)) {
                return redirect()->intended('viewLogin');
            }
            return Redirect::back()->withErrors(['msg' => 'Registreren fout gegaan']);
        }
        return Redirect::back()->withErrors(['msg' => 'Een gebruiker met deze gegevens bestaat al.']);
    }
}
