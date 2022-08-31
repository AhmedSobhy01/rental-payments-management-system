<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = in_array($request->segment(1), LaravelLocalization::getSupportedLanguagesKeys()) ? $request->segment(1) : Session::get('locale');

        if ($locale) {
            LaravelLocalization::setLocale($locale);
            Session::put('locale', $locale);
        }

        return $next($request);
    }
}