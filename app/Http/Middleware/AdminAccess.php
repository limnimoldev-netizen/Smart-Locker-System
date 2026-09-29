<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! in_array($request->user()->role, ['admin', 'staff'], true)) {
            return redirect()->route('user.dashboard');
        }

        return $next($request);
    }
}