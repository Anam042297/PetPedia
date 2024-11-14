<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('login')->with('error', 'Please log in to continue.');
        }

        // If the user is an admin, allow them to proceed
        if (Auth::user()->role == 'admin') {
            return $next($request);
        } else {
            return redirect('/');

        }
        // If the user is not an admin and is trying to access an admin route, redirect them
        // return redirect('home')->with('error', 'You do not have permission to access this page.');
    }

}

