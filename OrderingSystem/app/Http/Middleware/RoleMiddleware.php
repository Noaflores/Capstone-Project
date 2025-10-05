<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // If the user’s role doesn't match the required role...
        if ($user->role !== $role) {
            // Redirect based on their actual role
            if ($user->role === 'manager') {
                return redirect()->route('homepage')->with('error', 'Access denied.');
            } elseif ($user->role === 'staff') {
                return redirect()->route('staff.orders')->with('error', 'Access denied.');
            } else {
                // For any other role (future-proofing)
                return redirect('/')->with('error', 'Access denied.');
            }
        }

        return $next($request);
    }
}
