<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role !== 'user') {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}