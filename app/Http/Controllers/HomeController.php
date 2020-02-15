<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Category;
use Cookie;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereHas('stores', function ($query) {
                $query->whereIn('stores.id', _getActiveStores());
            })
            ->orderBy('name', 'ASC')
            ->get();

        $stores = collect(json_decode(app('App\Http\Controllers\StoreController')
            ->filterCategory(session('filter_category') ?? 'all')));

        return view('home', compact('stores', 'categories'));
    }
}
