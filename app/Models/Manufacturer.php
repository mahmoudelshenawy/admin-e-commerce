<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'email',
        'mobile',
        'facebook',
        'twitter',
        'address',
        'website',
        'contact_manager',
        'lat',
        'lng',
        'icon'
    ];
}
