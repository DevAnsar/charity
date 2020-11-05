<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
   protected $fillable=[
       'review',
       'rate',
       'user_id',
       'product_id',
       'status',
   ];

   public function user(){
       return $this->belongsTo(User::class);
   }
   public function product(){
       return $this->belongsTo(Product::class);
   }
}
