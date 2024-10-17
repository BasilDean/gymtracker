<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = Session::get('locale', config('app.locale'));
        App::setLocale($locale);

        Inertia::share([
            'locales' => config('locale.locales'),
            'currentLocale' => $locale,
            'translations' => Lang::get('layout'),
        ]);

        return $next($request);
    }
}
