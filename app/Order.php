<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // public $timestamps  = false;
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function ordersMeats()
    {
        return $this->hasMany(OrdersMeat::class);
    }
    public  function status(){
        return $this->belongsTo(DeliveriesStatus::class);
    }
}
