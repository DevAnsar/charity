<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'paymentable_id',
        'paymentable_type',
        'type',
        'amount',
        'authority',
        'RefID',
        'status',
    ];
    public function paymentable()
    {
        return $this->morphTo();
    }
}
