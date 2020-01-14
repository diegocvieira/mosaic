<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Category;
use Str;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::orderBy('name', 'ASC')->get();

        return view('admin.store.index', compact('stores'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.store.create-edit', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $store = Store::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'url_home' => $request->url_home,
                'url_search' => $request->url_search
            ]);

            $store->categories()->attach($request->category);

            session()->flash('flash_message', 'Loja cadastrada com sucesso!');
        } catch (\Exception $e) {
            session()->flash('flash_message', 'Erro ao cadastrar loja.');
        }

        return redirect()->route('admin.store.index');
    }

    public function edit($id)
    {
        $store = Store::with('categories')->findOrFail($id);

        $categories = Category::orderBy('name', 'ASC')->get();

        $store_categories = [];
        foreach ($store->categories as $sc) {
            $store_categories[] = $sc->id;
        }

        return view('admin.store.create-edit', compact('store', 'categories', 'store_categories'));
    }

    public function update(Request $request, $id)
    {
        try {
            $store = Store::findOrFail($id);

            $store->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'url_home' => $request->url_home,
                'url_search' => $request->url_search
            ]);

            $store->categories()->detach();
            $store->categories()->attach($request->category);

            session()->flash('flash_message', 'Loja atualizada com sucesso!');
        } catch (\Exception $e) {
            session()->flash('flash_message', 'Erro ao atualizar loja.');
        }

        return redirect()->route('admin.store.index');
    }

    public function destroy($id)
    {
        try {
            $store = Store::findOrFail($id);

            $store->delete();

            session()->flash('flash_message', 'Loja excluída com sucesso!');
        } catch (\Exception $e) {
            session()->flash('flash_message', 'Erro ao excluir loja.');
        }

        return redirect()->route('admin.store.index');
    }
}
