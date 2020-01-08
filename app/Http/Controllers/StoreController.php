<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    public function filterCategory($category_slug)
    {
        $stores = Store::whereHas('categories', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);
            })
            ->get();

        return $stores;
    }
}
