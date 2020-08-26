<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'admin_id',
        'user_id',
        'product_id',
        'quantity',
        'status',
        'purchase_price',
        'discount',
        'tax',
        'coupon',
        'total_price',
        'payment_type',
        'payment_status',
        'payment_price',
        'submit_time',
        'delivery_time',
    ];

    public function users()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
    public function admins()
    {
        return $this->belongsTo(\App\Admin::class, 'admin_id');
    }
    public function products()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
}
