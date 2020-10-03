<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveriesStatus extends Model
{
    public $timestamps  = false;
    protected $table = 'deliveries_status';
    protected $guarded=[];
    public function orders(){
    	return $this->hasMany('App\Order', 'dellivery_status_id');
    }
}
