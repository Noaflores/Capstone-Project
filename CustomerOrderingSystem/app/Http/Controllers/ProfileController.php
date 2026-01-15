<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // fetch logged-in customer

        return view('profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();

        return view('profile-edit', compact('user'));
    }
}
