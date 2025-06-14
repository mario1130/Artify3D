<?php

namespace App\Http\Controllers\shop;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Http\Controllers\Controller;
use App\Models\Category;
use \App\Models\Order;



class ResumenController extends Controller
{
        public function index()
        {
                $categories = Category::all();
                $order = Order::where('user_id', auth()->id())->latest()->first();
                $products = $order ? $order->products : collect(); 

                return view('shop.resumen', compact('categories', 'order', 'products'));
        }
        public function finalizar()
        {
        return redirect('/')->with('success', '¡Compra realizada con éxito!');
        }
}
