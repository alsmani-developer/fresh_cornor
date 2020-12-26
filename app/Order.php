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
        return $this->belongsTo(DeliveriesStatus::class, 'status_id');
    }
    public function discount()
    {
        return $this->hasOne(OrdersMeatsDiscount::class, 'order_id');
    }
    public  function  orders_transporter(){
        return $this->hasOne('App\OrdersTransporter');
    }
   
}
