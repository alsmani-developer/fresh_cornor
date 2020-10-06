<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    public function meat(){
    	return $this->belongsTo('App\Meat');
    }
}
