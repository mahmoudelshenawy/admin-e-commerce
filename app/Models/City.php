<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'city_name_ar',
        'city_name_en',
        'country_id',
    ];


    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }
}
