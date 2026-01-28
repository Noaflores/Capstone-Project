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
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Match the DB column exactly (case sensitive)
    $credentials = [
        'Email' => $request->email, // <-- if your DB column is "Email"
        'password' => $request->password,
    ];

    if (auth()->attempt($credentials)) {

        // Regenerate session
        $request->session()->regenerate();

        // Save customer email in session
        session(['customer_email' => $request->email]);

        //  Debug to confirm
        // dd(session()->all());

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

