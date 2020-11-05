<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainSlider extends Model
{
    protected $fillable=[
        'title',
        'image',
        'image_responsive',
        'category_id',
        'status',
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

}
