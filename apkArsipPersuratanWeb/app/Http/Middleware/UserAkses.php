<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request; 
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the user has any of the specified roles
        if (!auth()->check() || !auth()->user()->hasAnyRole(...$roles)) {
            return redirect('dashboard');
        }

        return $next($request);
    }
}

