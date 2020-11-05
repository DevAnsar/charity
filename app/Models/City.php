<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use Sluggable;
    protected $fillable = [
        'code',
        'title',
        'title_en',
        'slug',
        'parent_id',
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
        return $this->hasMany(City::class,'parent_id','id');
    }
    public function parent(){
        return $this->belongsTo(City::class,'parent_id','id');
    }
}
