<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'user_id',
        'lat',
        'lng',
        'icon',
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
