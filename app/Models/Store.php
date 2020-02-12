<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'slug', 'url_home', 'url_search', 'image'];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'stores_categories');
    }
}
