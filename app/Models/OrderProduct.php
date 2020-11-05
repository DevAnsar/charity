<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'title',
        'image',
        'price',
        'quantity',
        'total_price',
    ];
    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
