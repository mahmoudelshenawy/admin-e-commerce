<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    protected $guarded = [];

    public function malls()
    {
        return $this->hasMany(\App\Models\Mall::class, 'country_id');
    }
}
