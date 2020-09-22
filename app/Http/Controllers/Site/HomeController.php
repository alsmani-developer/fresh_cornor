<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Meat;
class HomeController extends BaseController
{
    public function index(){
        $get_meats = Meat::orderByDesc('id')->take(8)->get();

        $data = array('get_meats' => $get_meats);
        return view('site.home.index')->with($data);
    }
}
