<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function parent()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }
}
