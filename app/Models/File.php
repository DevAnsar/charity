<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable=[
        'fileable_id',
        'fileable_type',
        'url',
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
