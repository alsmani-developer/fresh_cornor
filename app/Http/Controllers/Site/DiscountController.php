<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Discount;
use App\Meat;
use App\DiscountsType;
class DiscountController extends Controller
{
    public function index(){
        $discounts = Discount::orderByDesc('id')->paginate(15);
        return view('site.discounts.index', compact('discounts'));
    }
    public function show($id){
        $discount = Discount::findOrFail($id);
        return view('site.discounts.show', compact('discount'));
    }
}
