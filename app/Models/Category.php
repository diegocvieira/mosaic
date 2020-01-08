<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    public function stores()
    {
        return $this->belongsToMany('App\Models\Store', 'stores_categories');
    }
}
