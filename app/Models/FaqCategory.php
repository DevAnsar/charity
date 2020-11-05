<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    protected $fillable = [
        'title',
        'status',
    ];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function faqs(){
        return $this->hasMany(Faq::class);
    }
}
