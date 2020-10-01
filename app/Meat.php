<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meat extends Model
{
    public $timestamps  = false;
    protected $guarded=[];
    
    public function discounts(){
        return $this->belongsToMany('App\Discount', 'discounts_meats', 'discount_id', 'meat_id');
    }
}
