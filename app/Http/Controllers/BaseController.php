<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
class BaseController extends Controller
{
    public function changeLanguage($val){
        if (session()->has('locale')) {
            App::setLocale(session()->get('locale'));
        }
        App::setLocale($val);
        session()->put('locale', $val);
        return redirect()->back();
    }
}
