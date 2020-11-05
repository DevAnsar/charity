<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPropertyValue extends Model
{
    protected $fillable = [
        'product_id',
        'property_id',
        'property_default_id',
        'value',
    ];

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
    public function property(){
        return $this->hasOne(Property::class,'id','property_id');
    }
}
