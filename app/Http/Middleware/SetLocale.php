<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     * Separates the locale for public/customer pages and the admin dashboard,
     * ensuring language changes on one side never affect the other.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin*')) {
            // Admin dashboard locale (defaults to English or saved admin preference)
            $locale = Session::get('admin_locale', 'en');
        } else {
            // Public / Customer pages locale (defaults to Tamil as per project requirement)
            $locale = Session::get('public_locale', config('app.locale', 'ta'));
        }

        if (in_array($locale, ['ta', 'en'])) {
            App::setLocale($locale);
        } else {
            App::setLocale($request->is('admin*') ? 'en' : 'ta');
        }

        return $next($request);
    }
}
