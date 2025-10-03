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
        $request->validate([
            'name' => 'required|string|max:255', // DB column is "name", not "username"
            'email' => 'required|email|unique:users,email,'.$id,
            'contact_number' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);

        $data = $request->only(['name','email','contact_number']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

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
