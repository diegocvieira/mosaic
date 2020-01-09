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
        $stores = Store::whereIn('id', _getActiveStores())
            ->orderBy('name', 'ASC')
            ->get();

        $categories = Category::whereHas('stores', function ($query) {
                $query->whereIn('stores.id', _getActiveStores());
            })
            ->orderBy('name', 'ASC')->get();

        return view('home', compact('stores', 'categories'));
    }
}
