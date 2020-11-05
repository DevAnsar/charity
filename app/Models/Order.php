<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',//needy user
        'total_price',
        'paid_price',
        'sponsor_total_price',
        'status',//0->Registered 1->processing 2->posted 3->delivered
        'receiver',
        'mobile',
        'state',
        'city',
        'address',
        'postal_code',
        'send_type_title',
        'send_type_price',
        'pay_type_title',
        'pay_status',//0->پرداخت نشده 1->پرداخت شده
        'has_needy'
    ];

    public function user()
    {
        //needy user
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id');
    }

    public function products_fields()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'id');
    }

    public function payments()
    {
        return $this->morphMany('App\Models\Payment', 'paymentable');
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class, 'order_id', 'id');
    }

}
