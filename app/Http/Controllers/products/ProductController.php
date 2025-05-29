<?php

namespace App\Http\Controllers\products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ProductController extends Controller
{ 
    
    public function showByCategory($slug)
    {
        // Buscar la categoría por su slug
        $category = Category::where('slug', $slug)->firstOrFail();
    
        // Obtener los productos de la categoría
        $products = $category->products()->get(); // Asegúrate de usar el método ->get()
    

        // Depuración
        // dd($category, $products);

        // Retornar la vista con los productos
        return view('products.product_categoria', compact('category', 'products'));
    }


}

