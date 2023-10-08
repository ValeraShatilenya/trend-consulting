<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LocaleController extends Controller
{
    public function __invoke(string $locale): RedirectResponse
    {
        abort_if(!in_array($locale, ['en', 'ru']), 400, "Available locales only 'en' and 'ru'");
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
