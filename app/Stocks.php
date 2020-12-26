<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    public $timestamps  = false;
    protected $table = 'stocks';
    protected $guarded = [];
    public function meat(){
    	return $this->belongsTo('App\Meat');
    }
}
