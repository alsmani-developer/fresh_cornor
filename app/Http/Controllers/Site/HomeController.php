<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
class HomeController extends BaseController
{
    public function index(){
        return view('site.home.index');
    }
}
