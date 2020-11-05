<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'title_en',
        'showBanner',
        'filter',
        'status',
    ];
    public function defaults(){
        return $this->hasMany(PropertyDefault::class,'property_id','id');
    }
}
