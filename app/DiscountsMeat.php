<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountsMeat extends Model
{
<<<<<<< HEAD
    public function meat(){
    	return $this->belongsTo('App\Meat');
    }
    public function discount(){
    	return $this->belongsTo('App\Discount', 'discount_id');
    }
=======
    //
>>>>>>> d7b7e2e7336ca76e2a5eea2ee3c3fec239dabc48
}
