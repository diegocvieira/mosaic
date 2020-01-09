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
        $stores_id = explode(',', Cookie::get('stores_id'));

        $stores = Store::whereIn('id', $stores_id)->orderBy('name', 'ASC')->get();

        $categories = Category::whereHas('stores', function ($query) use ($stores_id) {
            $query->whereIn('stores.id', $stores_id);
        })
        ->orderBy('name', 'ASC')->get();

        return view('home', compact('stores', 'categories'));
    }
}
