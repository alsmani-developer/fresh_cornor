<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $timestamps  = false;
    protected $guarded=[];
    public function meats(){
        return $this->belongsToMany('App\Meat', 'discounts_meats', 'discount_id', 'meat_id');
    }
}
