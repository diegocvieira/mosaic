<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Cookie;
use App\Models\Category;

class StoreController extends Controller
{
    public function list()
    {
        $categories = Category::has('stores')->with('stores')->orderBy('name', 'ASC')->get();

        return view('list-stores', compact('categories'));
    }

    public function filterCategory($category_slug)
    {
        $stores = Store::whereHas('categories', function ($query) use ($category_slug) {
                $query->where('slug', $category_slug);
            })
            ->get();

        return $stores;
    }

    public function activate($store_id)
    {
        $stores_id = Cookie::get('stores_id') ? Cookie::get('stores_id') . ',' . $store_id : $store_id;

        Cookie::queue('stores_id', $stores_id, '525600');
    }

    public function desactivate($store_id)
    {
        $stores_id = explode(',', Cookie::get('stores_id'));

        if (($key = array_search($store_id, $stores_id)) !== false) {
            unset($stores_id[$key]);
        }

        Cookie::queue('stores_id', implode(',', $stores_id), '525600');

        return Cookie::get('stores_id');
    }
}
