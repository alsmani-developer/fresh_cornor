<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meat extends Model
{
    public $timestamps = false;
    protected $guarded=[];

    
    public function discounts(){
        return $this->belongsToMany('App\Discount', 'discounts_meats', 'discount_id', 'meat_id');
    }

    public function cattlesType(){
    	return $this->belongsTo('App\CattlesType', 'cattels_types_id');
    }
    public function stock(){
    	return $this->hasOne('App\Stocks', 'meat_id');

    }
    public function meatsratings(){
    	return $this->hasMany('App\MeatsRating', 'meat_id');
    }
    public function discount_meat(){
    	return $this->hasMany('App\DiscountsMeat', 'meat_id');
    }
    public function meatsrating(){
    	return $this->hasMany('App\MeatsRating', 'meat_id');
    }
    public function OrdersMeat(){
    	return $this->hasMany('App\OrdersMeat', 'meat_id');
    }

}
