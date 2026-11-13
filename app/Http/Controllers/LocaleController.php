<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    /**
     * Switch language for the public / customer portal.
     * Does NOT affect the admin dashboard language.
     */
    public function setPublicLocale(string $locale): RedirectResponse
    {
        if (in_array($locale, ['ta', 'en'])) {
            Session::put('public_locale', $locale);
            // Also store legacy 'locale' for backward compatibility
            Session::put('locale', $locale);
        }

        $targetLang = $locale === 'en' ? 'en' : 'ta';
        $cookieVal = "/ta/{$targetLang}";

        return redirect()->back()
            ->cookie('googtrans', $cookieVal, 60 * 24 * 30, '/', null, false, false);
    }

    /**
     * Switch language for the admin dashboard.
     * Does NOT affect the public / customer portal language.
     */
    public function setAdminLocale(string $locale): RedirectResponse
    {
        if (in_array($locale, ['ta', 'en'])) {
            Session::put('admin_locale', $locale);
        }

        return redirect()->back();
    }

    /**
     * Fallback alias for setPublicLocale
     */
    public function setLocale(string $locale): RedirectResponse
    {
        return $this->setPublicLocale($locale);
    }
}
