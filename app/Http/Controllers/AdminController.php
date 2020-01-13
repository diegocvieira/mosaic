<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Store;
use Str;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function sendLogin(Request $request)
    {
        if ($request->password === 'PSwrhvna2QrAWx2z') {
            session(['admin_checked' => 'true']);

            return redirect()->route('admin-index');
        } else {
            session()->flash('flash_message', 'Senha incorreta.');

            return redirect()->route('admin-show-login');
        }
    }

    public function index()
    {
        return view('admin.index');
    }

    public function showCategoryRegister()
    {
        return view('admin.category-register');
    }

    public function SaveCategoryRegister(Request $request)
    {
        try {
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-')
            ]);

            session()->flash('flash_message', 'Cadastro realizado com sucesso!');
        } catch (\Exception $e) {
            session()->flash('flash_message', 'Erro ao realizar cadastro.');
        }

        return redirect()->back();
    }

    public function showStoreRegister()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.store-register', compact('categories'));
    }

    public function SaveStoreRegister(Request $request)
    {
        try {
            $store = Store::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'url_home' => $request->url_home,
                'url_search' => $request->url_search
            ]);

            $store->categories()->attach($request->category);

            session()->flash('flash_message', 'Cadastro realizado com sucesso!');
        } catch (\Exception $e) {
            session()->flash('flash_message', 'Erro ao realizar cadastro.');
        }

        return redirect()->back();
    }
}
