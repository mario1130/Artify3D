<?php

namespace App\Http\Controllers;

use  App\Models\Product;
use Illuminate\Http\Request;

class My_productsController extends Controller
{
    //
    public function index(){
        $products = Product::paginate();
        return view('products.my_products',compact('products'));

    }

    public function add_show(){
        return view('products.add_products');

    }
    
    public function product_show($id){
        $product = Product::find($id);
        return view('products.show_product',compact('product'));

    }

    public function add(){

        $product = new Product(); 
        $product->name = $request->name;
        $product->description = $request->description;
        $product->precio = $request->precio;
        $product->category_id = $request->category_id;
        $product->save();



        return redirect()->route('products.my_products');

    }
    

}
