<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function show(){
        return view('site.product.show');
    }
    public function index(){
        return view('site.products.index');
    }
}
