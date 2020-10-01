<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersMeat extends Model
{
    public $timestamps = false;
    protected $guarded=[];
    public function meat()
    {
        return $this->belongsTo(Meat::class, 'meat_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
