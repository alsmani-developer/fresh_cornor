<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountsType extends Model
{
    public function discounts(){
    	return $this->hasMany('App\Discount', 'discount_type_id');
    }
}
