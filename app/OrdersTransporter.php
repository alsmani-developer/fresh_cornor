<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersTransporter extends Model
{
    public $timestamps  = false;
    protected $table = 'orders_transporters';
    protected $guarded = [];

    public function order(){
    	return $this->belongsTo('App\Order');
    }
    public function user(){
    	return $this->belongsTo('App\User','transporter_id');
    }
 
}

