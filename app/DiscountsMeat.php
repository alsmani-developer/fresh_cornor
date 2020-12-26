<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountsMeat extends Model
{



    public function meat(){
    	return $this->belongsTo('App\Meat');
    }
    public function discount(){
    	return $this->belongsTo('App\Discount', 'discount_id');
    }
}
