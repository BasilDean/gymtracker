<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function changeLocale(Request $request, $locale): RedirectResponse
    {
        if (array_key_exists($locale, config('locale.locales'))) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }

        return Redirect::back();
    }
}
