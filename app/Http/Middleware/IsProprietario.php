<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsProprietario
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_proprietario) {
            return $next($request);
        }

        return redirect('/');
    }
}
