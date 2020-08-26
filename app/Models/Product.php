<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function files()
    {
        return $this->hasMany(\App\Models\File::class, 'relation_id', 'id')->where('file_type', 'product');
    }
    public function otherData()
    {
        return $this->hasMany(\App\Models\OtherData::class);
    }

    public function malls()
    {
        return $this->belongsToMany(\App\Models\Mall::class);
    }

    public function categories()
    {
        return $this->belongsToMany(\App\Models\Category::class);
    }
}
