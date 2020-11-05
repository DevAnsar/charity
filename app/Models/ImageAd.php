<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageAd extends Model
{
    protected $fillable=[
        'title',
        'section',
        'col',
        'category_id',
        'status',
        'showInApp',
    ];

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
