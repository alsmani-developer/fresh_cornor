<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CattlesType extends Model
{
    public $timestamps  = false;
    protected $guarded=[];
    public function Meat(){
    	return $this->hasMany('App\Meat', 'cattels_types_id');
    }
}
