<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Show all users
    public function index()
{
    $users = User::all();
    return view('manager.index', compact('users'));
}


    // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('manager.edit-user', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
{
    
    $user = User::findOrFail($id);
    $user->update($request->only(['name', 'email', 'contact_number']));

    // Redirect back to Manager User page
    return redirect()->route('users.index')->with('success', 'User updated successfully.');
}



    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
