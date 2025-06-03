<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ShoppingCart;
use \App\Models\Order;
use \App\Models\Order_items;

class PagoController extends Controller
{
        public function Pago(){
        $categories = Category::all();
        return view('shop.pago', compact('categories'));

    }


public function confirmar(Request $request)
{
    $request->validate([
        'payment' => 'required|in:tarjeta,paypal,transferencia',
        'card_number' => 'required_if:payment,tarjeta',
        'card_expiry' => 'required_if:payment,tarjeta',
        'card_cvc' => 'required_if:payment,tarjeta',
        'card_name' => 'required_if:payment,tarjeta',
        'paypal_email' => 'required_if:payment,paypal|email',

    ]);

    $user = auth()->user();
    $cartItems = ShoppingCart::where('user_id', $user->id)->get();
    $total = $cartItems->sum(function($item) { return $item->product_price * $item->quantity; });

    // Guarda el pedido
    $order = Order::create([
        'user_id' => $user->id,
        'payment_method' => $request->payment,
        'card_number' => $request->payment === 'tarjeta' ? $request->card_number : null,
        'card_expiry' => $request->payment === 'tarjeta' ? $request->card_expiry : null,
        'card_cvc' => $request->payment === 'tarjeta' ? $request->card_cvc : null,
        'card_name' => $request->payment === 'tarjeta' ? $request->card_name : null,
        'total' => $total,
    ]);

    // Guarda los productos del pedido
    foreach ($cartItems as $item) {
        Order_items::create([
            'order_id' => $order->id,
            'product_name' => $item->product_name,
            'product_price' => $item->product_price,
            'quantity' => $item->quantity,
        ]);
    }

    // Borra el carrito
    ShoppingCart::where('user_id', $user->id)->delete();

    return redirect()->route('resumen')->with('success', 'Método de pago guardado correctamente.');
}
}
