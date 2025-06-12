<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                  ->orWhere('id', $search);
        }

        $categories = $query->orderBy('id', 'asc')->paginate(10);

        return view('dashboard.category.admin_category', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.category.create_category');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        $data['slug'] = Str::slug($data['name']);

        $category = Category::create($data);

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Crear categoría',
            'description' => 'ID: ' . $category->id . ' | Nombre: ' . $category->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit(Category $category)
    {
        return view('dashboard.category.edit_category', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Actualizar categoría',
            'description' => 'ID: ' . $category->id . ' | Nombre: ' . $category->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Eliminar categoría',
            'description' => 'ID: ' . $category->id . ' | Nombre: ' . $category->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría eliminada correctamente.');
    }
}