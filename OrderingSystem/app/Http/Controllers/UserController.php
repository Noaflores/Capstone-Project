<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show employees (manager & staff)
     */
    public function index()
    {
        $users = User::whereIn('role', ['manager', 'staff'])
            ->orderBy('role')
            ->orderBy('name')
            ->get();

        return view('manager.index', compact('users'));
    }

    /**
     * Show edit form (manager / staff)
     */
    public function edit(User $user)
    {
        return view('manager.edit-user', compact('user'));
    }

    /**
     * Update manager / staff
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'contact_number' => 'required|digits:11',
        ]);

        $user->update([
            'name'           => $request->name,
            'email'          => $request->email,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete manager / staff
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
