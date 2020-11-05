<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    use sluggable;

    protected $fillable=[
        'title',
        'slug',
        'content',
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function url(){
        return route('site.pages.show',['slug'=>$this->slug]);
    }
}
