<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NeedyUser extends Model
{
    protected $fillable=[
        'user_id',
        'code_melli',
        'date_of_birth',
        'state_id',
        'city_id',
        'is_married',
        'number_of_child',
        'is_employed',
        'health_status',
        'covered',
        'housing_situation',
        'tell',
        'address',
        'evidence',
    ];
    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function state(){
        return $this->hasOne(City::class,'id','state_id');
    }
    public function city(){
        return $this->hasOne(City::class,'id','city_id');
    }
}
