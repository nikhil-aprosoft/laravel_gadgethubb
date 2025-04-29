<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (! $request->expectsJson()) {
            return route('admin.login');
        }
        // Check if user is logged in
        if (!Auth::check()) {
            // Not logged in, redirect to admin login page
            return redirect('admin/dashboard');
        }

        // User is logged in, now check if user is admin
        $user = Auth::user();

        // Assuming your User model has a 'role' field
        if ($user->role !== 'admin') {
            // User is not admin, you can redirect or abort
            abort(403, 'Unauthorized');
        }

        // Everything okay, continue
        return $next($request);
    }
}
