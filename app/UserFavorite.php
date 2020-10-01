<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    public $timestamps = false;
    public $fillable = [
        'user_id', 'meat_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function meat(){
        return $this->belongsTo(Meat::class, 'meat_id');
    }
}
