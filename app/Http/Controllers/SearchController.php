<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Realiza la búsqueda en la base de datos
        $results = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(15);

        // Devuelve una vista con los resultados
        return view('search.search', compact('results', 'query'));
    }
}
