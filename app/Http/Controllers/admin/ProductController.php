<?php

namespace App\Http\Controllers\admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\AdminLog;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhere('id', $search);
        }

        $products = $query->orderBy('id', 'asc')->paginate(10);

        return view('dashboard.product.admin_product', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.product.create_product', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'precio' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'download_url' => 'nullable|url|max:255',
        ]);
        $data['user_id'] = auth()->id();
        $product = Product::create($data);

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Crear producto',
            'description' => 'ID: ' . $product->id . ' | Nombre: ' . $product->name,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Producto creado correctamente.');
    }


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.product.edit_product', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'precio' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'download_url' => 'nullable|url|max:255',
        ]);
        $product->update($data);

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Actualizar producto',
            'description' => 'ID: ' . $product->id . ' | Nombre: ' . $product->name,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        AdminLog::create([
            'admin_id' => auth()->id(),
            'action' => 'Eliminar producto',
            'description' => 'ID: ' . $product->id . ' | Nombre: ' . $product->name,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
