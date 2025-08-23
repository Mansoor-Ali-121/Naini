<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Don't forget this import
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            // If not logged in, redirect to login page
            return redirect()->route('login.add'); // Redirect to your login form
        }

        // Check if the logged-in user has the 'admin' usertype
        if (Auth::user()->usertype !== 'admin') {
            // If not an admin, redirect them or abort
            // You might redirect them to the regular user dashboard or show an error
            return redirect()->route('dashboard')->with('error', 'You do not have admin access.');
            // Or if you prefer to just show a forbidden page:
            // abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}