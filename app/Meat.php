<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meat extends Model
{
    protected $guarded=[];
    public function cattlesType(){
    	return $this->belongsTo('App\CattlesType', 'cattels_types_id');
    }
    public function stock(){
    	return $this->hasOne('App\Stocks', 'meat_id');
    }
}
