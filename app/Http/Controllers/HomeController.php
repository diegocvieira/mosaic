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
        $categories_filter = Category::whereHas('stores', function ($query) {
                $query->whereIn('stores.id', _getActiveStores());
            })
            ->orderBy('name', 'ASC')
            ->get();

        $categories = collect(json_decode(app('App\Http\Controllers\StoreController')
            ->filterCategory(session('filter_category') ?? 'all')));

        return view('home', compact('categories', 'categories_filter'));
    }

    public function storeKeyword($keyword = null)
    {
        session(['keyword' => $keyword]);
    }
}
