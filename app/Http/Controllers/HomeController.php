<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $stores = Store::orderBy('name', 'ASC')->get();

        $categories = Category::has('stores')->orderBy('name', 'ASC')->get();

        return view('home', compact('stores', 'categories'));
    }
}
