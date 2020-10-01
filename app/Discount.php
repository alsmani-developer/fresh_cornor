<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $timestamps  = false;
    protected $guarded=[];
    public function discountsMeat(){
    	return $this->hasMany('App\DiscountsMeat', 'discount_id');
    }
    
    public function stock(){
    	return $this->hasOne('App\Stocks', 'meat_id');
    }

    public function discountsQuantity(){
        return $this->hasMany('App\DiscountsQuantity', 'discount_id');
    }
    public function meats(){
        return $this->belongsToMany('App\Meat', 'discounts_meats', 'discount_id', 'meat_id');
    }
}
