<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    function getApiKey()
    {
        DB::table('personal_access_tokens')->where('tokenable_id', '=', Auth::id())->delete(); // verwijdert oudere keys
        $token = Auth::user()->createToken('token')->plainTextToken;
        if ($token) {
            return redirect()->back()->with('success', ['msg' => 'Key successvol aangemaakt', 'token' => $token]);
        }

        return redirect()->back()->with('error', ['Key kon niet aangemaakt worden']);
    }

    function returnProfileView()
    {
        return view('profile')->with('userData', Auth::user());
    }

    static function submitEditProfile(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'sometimes',
            'oldPassword' => 'sometimes'
        ]);

        $user = Auth::user();

        $user->username = $validate['username'];
        $user->email    = $validate['email'];

        if (isset($validate['oldPassword']) && isset($validate['password']) && Hash::check($validate['oldPassword'],$user->getAuthPassword())){
            $user->password = Hash::make($validate['password']);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Wachtwoord velden niet of incorrect ingevuld.']);
        }
        if ($user->save()) {
            return redirect()->back()->with('success', 'Gegevens veranderd');
        }
        return Redirect::back()->withErrors(['msg' => 'Gegevens veranderen mislukt']);
    }
}
