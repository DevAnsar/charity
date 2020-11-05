<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable=[
      'user_id',
      'receiver',
      'mobile',
      'state',
      'city',
      'state_id',
      'city_id',
      'postal_code',
      'address',
      'lat',
      'lng',
      'is_default',
    ];
    public function user(){
        return $this->belongsTo(User::class,'id','user_id');
    }
}
