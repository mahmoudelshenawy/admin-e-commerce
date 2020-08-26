<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeMark extends Model
{
    protected $guarded = [];

    protected $fillable = [
        'name_ar',
        'name_en',
        'logo'
    ];
}
