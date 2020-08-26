<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'email',
        'mobile',
        'facebook',
        'country_id',
        'twitter',
        'address',
        'website',
        'contact_name',
        'lat',
        'lng',
        'icon',
    ];

    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }

    public function products()
    {
        return $this->belongsToMany(\App\Models\Product::class);
    }
}
