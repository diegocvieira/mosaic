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

        $stores = Store::with('categories')->whereIn('stores.id', _getActiveStores());
        if (session('filter_category') != 'all') {
            $stores = $stores->whereHas('categories', function ($query) {
                $query->where('slug', session('filter_category'));
            });
        }
        $stores = $stores->orderBy('name', 'ASC')->get();

        return view('home', compact('stores', 'categories'));
    }

    // public function storeKeyword($keyword = null)
    // {
    //     session(['keyword' => $keyword]);
    // }
}
