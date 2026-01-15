<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Customer;

class RegisterController extends Controller
{
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function register(Request $request) 
{
    $request->validate([
    'email' => 'required|email|unique:tbl_customer,Email',
    'password' => 'required|min:6',
    'contact_number' => 'required|numeric|digits:11', // Ensures exactly 11 digits
]);

    Customer::create([
        'customer_id'    => 'CUST-' . strtoupper(Str::random(8)),
        'first_name'     => $request->first_name,
        'last_name'      => $request->last_name,
        'Email'          => $request->email, // Capital E
        'contact_number' => $request->contact_number,
        'password'       => bcrypt($request->password),
    ]);

    return redirect('/login')->with('success', 'Registration successful!');
}
}

