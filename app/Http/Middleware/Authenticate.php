<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Optionally dump request data for debugging
        // dd($request->all());
        
        if (Auth::check()) {
            // dd(123);
            // Redirect to the intended page if authenticated
            return session()->get('url.intended', '/'); // Replace '/' with your default route
        }
        // dd(123);
        return route('login'); // Redirect to login if not authenticated
    }
    
}
