<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;

class ShoppingcartController extends Controller
{
    //
    public function Shoppingcart(){
        return view('shoppingcart.Shoppingcart');

    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $productName = $request->input('product_name');
        $productPrice = $request->input('product_price');

        // Guardar el producto en la tabla del carrito
        ShoppingCart::create([
            'user_id' => auth()->id(), // Si tienes autenticación, guarda el ID del usuario
            'product_id' => $productId,
            'product_name' => $productName,
            'product_price' => $productPrice,
            'quantity' => 1,
        ]);

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }
}
