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
        if (str_replace(url('/'), '', url()->previous()) != '/lojas') {
            session()->forget('filter_category');

            $route_stores = false;
        } else {
            $route_stores = true;
        }

        if (_getStoreCookie()) {
            $categories = Category::whereHas('stores', function ($query) {
                    $query->whereIn('stores.id', _getActiveStores());
                })
                ->orderBy('name', 'ASC')
                ->get();

            $stores = collect(json_decode(app('App\Http\Controllers\StoreController')->filterCategory(session('filter_category') ?? 'all')));

            if (!count($stores)) {
                session()->forget('filter_category');

                return redirect()->route('home');
            }
        } else {
            $categories = Category::has('stores')->orderBy('name', 'ASC')->get();

            $stores = Store::orderBy('name', 'ASC')->get();

            foreach ($stores as $store) {
                $stores_id[] = $store->id;
            }

            app('App\Http\Controllers\StoreController')->activate($stores_id);
        }

        return view('home', compact('stores', 'categories', 'route_stores'));
    }
}
