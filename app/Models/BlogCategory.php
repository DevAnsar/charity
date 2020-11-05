<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use sluggable;
    protected $fillable = [
        'title',
        'slug',
        'parent_id',
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

    public function children(){
        return $this->hasMany(BlogCategory::class,'parent_id','id');
    }
    public function real_children(){
        return $this->children()->where('status','=',1);
    }
    public function parent(){
        return $this->belongsTo(BlogCategory::class);
    }
    public function blogs(){
        return $this->hasMany(Blog::class,'blog_category_id','id');
    }
}
