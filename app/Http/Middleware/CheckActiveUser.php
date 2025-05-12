<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveUser
{
    /**
     * Handle an incoming request.
     *
     * Validate if the authenticated user is active
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login tapi tidak aktif, logout dan redirect ke login
        if (Auth::check() && !Auth::user()->is_active) {
            Auth::logout();
            return redirect()->route('login')
                ->with('status', 'Your account has been deactivated. Please contact administrator.');
        }

        return $next($request);
    }
}
