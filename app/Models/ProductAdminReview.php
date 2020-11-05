<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAdminReview extends Model
{
    protected $fillable=[
      'product_id',
      'title',
      'body',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
