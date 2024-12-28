<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $lang = $request->language;
        app()->setLocale($lang);
        Session::put('locale', $lang);

        return redirect()->back();
    }
}
