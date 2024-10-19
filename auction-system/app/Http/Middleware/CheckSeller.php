<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class CheckSeller
{
 
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->type == 'seller') {
            return $next($request);
        }

        return redirect('/products')->with('error', 'You do not have access to this resource.');
    }
}
