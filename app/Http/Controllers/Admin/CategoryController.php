<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create-edit');
    }

    public function store(Request $request)
    {
        try {
            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-')
            ]);

            session()->flash('flash_message', 'Categoria cadastrada com sucesso!');
        } catch (\Exception $e) {
            session()->flash('flash_message', 'Erro ao cadastrar categoria.');
        }

        return redirect()->route('admin.category.index');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.create-edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-')
            ]);

            session()->flash('flash_message', 'Categoria atualizada com sucesso!');
        } catch (\Exception $e) {
            session()->flash('flash_message', 'Erro ao atualizar categoria.');
        }

        return redirect()->route('admin.category.index');
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            $category->delete();

            session()->flash('flash_message', 'Categoria excluída com sucesso!');
        } catch (\Exception $e) {
            session()->flash('flash_message', 'Erro ao excluir categoria.');
        }

        return redirect()->route('admin.category.index');
    }
}
