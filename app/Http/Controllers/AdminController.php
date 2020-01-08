<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use Str;

class AdminController extends Controller
{
    public function showCategoryRegister()
    {
        return view('admin.category-register');
    }

    public function SaveCategoryRegister(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-')
        ]);

        return redirect()->back();
    }

    public function showStoreRegister()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.store-register', compact('categories'));
    }

    public function SaveStoreRegister(Request $request)
    {
        $store = Store::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'url_home' => $request->url_home,
            'url_search' => $request->url_search
        ]);

        $store->categories()->attach($request->category);

        return redirect()->back();
    }
}
