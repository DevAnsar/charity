<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendType extends Model
{
   protected $fillable=[
     'title',
     'price',
     'status',
   ];
   public function image(){
       return $this->morphOne(Image::class,'imageable');
   }
}
