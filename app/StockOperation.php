<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockOperation extends Model
{
   
    protected $table = 'stock_operations';
    protected $guarded = [];
    public function stock(){
    	return $this->belongsTo('App\Stock');
    }
    public function admin(){
    	return $this->belongsTo('Bitfumes\Multiauth\Model\Admin');
    }
}
