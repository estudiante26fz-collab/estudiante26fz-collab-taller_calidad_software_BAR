<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'], //dudas<-----------------------
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); //dudas<-----------------------

            return redirect()->intended('/dashboard'); //dudas<-----------------------
        }

    return back()->withErrors([
        'email' => 'Credenciales no coinciden intente de nuevo.'
        ])->onlyInput('email'); //dudas<-----------------------
    }

    public function logout(Request $resquest)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.show');
    }
}


    
