<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next = null, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);
            // dd('it happened asshole');
            return back();
        } else {
            // dd('nope you stuck');
            return redirect('admin/login');
        }
    }
}
