<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryInAds extends Model
{
    protected $fillable=[
        'category_id',
        'type_in_mobile',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
