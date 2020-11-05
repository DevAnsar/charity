<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'total_price',
        'amount',
    ];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
