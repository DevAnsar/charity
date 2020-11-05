<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
   protected $fillable=[
       'title',
       'status',
   ];

   public function image(){
       return $this->morphOne(Image::class,'imageable');
   }
}
