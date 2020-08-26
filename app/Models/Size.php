<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $guarded = [];

    public function unit()
    {
        return $this->belongsTo(\App\Models\Unit::class, 'unit_id');
    }
}
