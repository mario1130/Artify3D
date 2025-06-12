<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rating;

class ProductRatingController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'stars' => 'required|integer|min:1|max:5',
        ]);

        $product = Product::findOrFail($productId);

        Rating::updateOrCreate(
            ['product_id' => $product->id, 'user_id' => auth()->id()],
            ['stars' => $request->stars]
        );

        return redirect()->back()->with('success', '¡Puntuación guardada!');
    }
}
