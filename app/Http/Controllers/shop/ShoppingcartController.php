<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Http\Controllers\Controller;
use App\Models\Category;


class ShoppingcartController extends Controller
{
    //
    public function Shoppingcart(){
        $categories = Category::all();
        return view('shoppingcart.Shoppingcart', compact('categories'));

    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $productName = $request->input('product_name');
        $productPrice = $request->input('product_price');

        // Guardar el producto en la tabla del carrito
        ShoppingCart::create([
            'user_id' => auth()->id(), 
            'product_id' => $productId,
            'product_name' => $productName,
            'product_price' => $productPrice,
            'quantity' => 1,
        ]);
        // Si viene de "Comprar", redirige a la cesta
        if ($request->has('go_to_cart')) {
            return redirect()->route('shoppingcart')->with('success', 'Producto añadido a la cesta.');
        }

        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    public function empty()
    {
        // Elimina todos los productos del carrito del usuario autenticado
        ShoppingCart::where('user_id', auth()->id())->delete();
        return redirect()->back()->with('success', 'Carrito vaciado correctamente.');
    }

    public function remove($id)
    {
        // Elimina un producto específico del carrito del usuario autenticado
        $item = ShoppingCart::where('user_id', auth()->id())->where('id', $id)->first();
        if ($item) {
            $item->delete();
        }
        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }
}
