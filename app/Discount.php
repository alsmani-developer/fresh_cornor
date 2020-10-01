<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $timestamps  = false;
    protected $guarded=[];
<<<<<<< HEAD
    public function discountsMeat(){
    	return $this->hasMany('App\DiscountsMeat', 'discount_id');
    }
    
    public function stock(){
    	return $this->hasOne('App\Stocks', 'meat_id');
    }

    public function discountsQuantity(){
    	return $this->hasMany('App\DiscountsQuantity', 'discount_id');
=======
    public function meats(){
        return $this->belongsToMany('App\Meat', 'discounts_meats', 'discount_id', 'meat_id');
>>>>>>> d7b7e2e7336ca76e2a5eea2ee3c3fec239dabc48
    }
}
