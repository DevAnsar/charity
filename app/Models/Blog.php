<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use sluggable;
    protected $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'content',
        'viewCount',
        'status',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }

    public function blog_category(){
        return $this->belongsTo(BlogCategory::class);
    }
}
