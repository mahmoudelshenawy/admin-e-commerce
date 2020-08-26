<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'state_name_ar',
        'state_name_en',
        'country_id',
        'city_id',
    ];

    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }

    public function city()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }
}
