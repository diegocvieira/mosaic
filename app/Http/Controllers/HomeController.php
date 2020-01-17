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
        if (_getStoreCookie()) {
            $categories = Category::whereHas('stores', function ($query) {
                    $query->whereIn('stores.id', _getActiveStores());
                })
                ->orderBy('name', 'ASC')->get();

            $stores = Store::whereIn('id', _getActiveStores())
                ->orderBy('name', 'ASC')
                ->get();
        } else {
            $categories = Category::has('stores')->orderBy('name', 'ASC')->get();

            $stores = Store::orderBy('name', 'ASC')->get();

            foreach ($stores as $store) {
                app('App\Http\Controllers\StoreController')->activate($store->id);
            }
        }

        return view('home', compact('stores', 'categories'));
    }
}
