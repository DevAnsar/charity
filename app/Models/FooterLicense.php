<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterLicense extends Model
{
    protected $fillable=[
        'title',
        'link',
    ];

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
}
