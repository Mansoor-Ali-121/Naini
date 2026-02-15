<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Agar user login nahi hai toh login page par bhejo
        if (!Auth::check()) {
            return redirect()->route('login.add');
        }

        // 2. Agar login hai lekin usertype 'admin' nahi hai toh website par bhejo
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->route('website')->with('error', 'Unauthorized access! Sirf Admin hi dashboard dekh sakta hai.');
        }

        return $next($request);
    }
}
