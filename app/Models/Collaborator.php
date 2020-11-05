<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    protected $fillable=[
        'name',
        'family',
        'code_melli',
        'tell',
        'mobile',
        'education_rate',
        'field_of_Study',
        'job',
        'date_of_birth',
        'address',
        'type_of_cooperation',
        'cooperation_time',
        'seen',
    ];
}
