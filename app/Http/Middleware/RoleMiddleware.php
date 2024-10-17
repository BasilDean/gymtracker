<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
//        dd(Auth::user()->roles->pluck('id')->toArray());
        if (!Auth::check() || !in_array(1, Auth::user()->roles->pluck('id')->toArray(), true)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
