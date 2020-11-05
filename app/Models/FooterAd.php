<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterAd extends Model
{
   protected $fillable=[
       'title',
   ];

   public function image(){
       return $this->morphOne(Image::class,'imageable');
   }
}
