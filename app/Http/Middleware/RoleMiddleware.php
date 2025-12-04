<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if (!$user->role) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Your account does not have a role assigned.']);
        }

        // Handle comma-separated roles (e.g., 'role:admin,content-management')
        $allowedRoles = [];
        foreach ($roles as $roleString) {
            // Split by comma if multiple roles specified
            $roleArray = explode(',', $roleString);
            $allowedRoles = array_merge($allowedRoles, $roleArray);
        }
        
        // Trim whitespace from role names
        $allowedRoles = array_map('trim', $allowedRoles);

        // Check if user has one of the required roles
        if (!in_array($user->role->slug, $allowedRoles)) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
