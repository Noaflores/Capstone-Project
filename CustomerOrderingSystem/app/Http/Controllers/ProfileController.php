<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:tbl_customer,email,' . $user->customer_id . ',customer_id',
            'contact_number' => 'nullable|string|max:20',
        ]);

        // Split name into first_name and last_name
        $names = explode(' ', $validated['name'], 2);
        $user->first_name = $names[0];
        $user->last_name = $names[1] ?? '';

        // Use lowercase 'email' to match Laravel auth
        $user->email = $validated['email'];

        // Set contact number
        $user->contact_number = $validated['contact_number'];

        $user->save(); // commit changes

        // Redirect back to profile page with success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}
