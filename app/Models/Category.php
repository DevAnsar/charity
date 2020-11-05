<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;
    protected $fillable=[
      'title',
      'title_en',
      'slug',
      'parent_id',
      'level',
      'status',
      'productCount',
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
                'source' => 'title_en'
            ]
        ];
    }

    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function limit_children(){
        return $this->hasMany(Category::class,'parent_id','id')->where('status',true)->take(5);
    }
    public function parent(){
        return $this->hasOne(Category::class,'id','parent_id');
    }
    public function properties(){
        return $this->hasMany(Property::class);
    }

    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public static function getCatFilter($cat){
        $parent_id=$cat->parent->id;
        $array_id=[$cat->id,$parent_id];

        $filter=Property::with('defaults')
            ->where('filter',true)
            ->whereIn('category_id',$array_id)
            ->get();
        return $filter;
    }
}
