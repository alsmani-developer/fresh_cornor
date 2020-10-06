<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Meat;
use App\Discount;
use App\OrdersMeat;
use DB;
class HomeController extends BaseController
{
    public function index(){
        $get_meats = Meat::orderByDesc('id')->take(8)->get();
        $discounts = Discount::take(3)->get();
        $orders = Meat::leftjoin('orders_meats', 'meats.id', 'orders_meats.meat_id')
        ->select([DB::raw('Count(orders_meats.id) as order_count'), 'meats.id', 'meats.ar_name', 'meats.cattels_types_id', 'meats.pic', 'meats.views'])->
        orderByDesc('meats.status_id')->groupBy('meats.id', 'meats.ar_name', 'meats.cattels_types_id', 'meats.pic', 'meats.views')->take(8)->get();
        $data = array('get_meats' => $get_meats, 'discounts' => $discounts, 'orders' => $orders);
        return view('site.home.index')->with($data);
    }
}
