<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate_Candidate
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('candidate')->check()) {
            return $next($request);
        }

        return redirect()->route('candidate.index'); // Redirect to login route if user is not authenticated
    }
}
