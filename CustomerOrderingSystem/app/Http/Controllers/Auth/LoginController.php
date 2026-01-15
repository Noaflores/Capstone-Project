<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $credentials = [
        'Email' => $request->email, // Use 'Email' to match your DB column
        'password' => $request->password,
    ];

    if (auth()->attempt($credentials)) {
        return redirect()->intended('/home');
    }

    return back()->with('error', 'The provided credentials do not match our records.');
}

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

