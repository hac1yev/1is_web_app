<?php

namespace App\Http\Controllers\Front\Languages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function setLang($locale)
    {
        if (! in_array($locale, ['AZ', 'EN', 'RU', 'TR'])) {
            return redirect()->back();
        }


        App::setLocale($locale);
        Session::put('locale', $locale);
       
        return redirect()->back();
    }
}
