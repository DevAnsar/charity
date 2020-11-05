<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductQuestion extends Model
{
    protected $fillable=[
      'content',
      'parent_id',
      'status',
      'product_id',
      'user_id'
    ];

    public function children(){
        return $this->hasMany(ProductQuestion::class,'parent_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
