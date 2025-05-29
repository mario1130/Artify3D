<?php

namespace App\Http\Controllers\products;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class My_productsController extends Controller
{
    //
    public function index(){
        $products = Product::where('user_id', auth()->id())->paginate(4); 
        return view('products.my_products', compact('products'));
        

    }

    public function add_show(){
        $categories = Category::all();
        return view('products.add_products', compact('categories'));

    }

    public function edit_show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
    
        // Asegúrate de que secondary_images sea un array
        if (is_null($product->secondary_images)) {
            $product->secondary_images = [];
        }
    
        return view('products.edit_products', compact('product', 'categories'));
    }
    
    public function product_show($id){
        $product = Product::find($id);
        return view('products.show_product',compact('product'));

    }

    public function add(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'precio' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'secondary_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Crear el producto
    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->precio = $request->precio;
    $product->category_id = $request->category_id;
    $product->user_id = auth()->id();
    $product->save();

    // Guardar la foto principal
    if ($request->hasFile('main_image')) {
        $mainImagePath = $request->file('main_image')->store('products', 'public');
        ProductPhoto::create([
            'product_id' => $product->id, // Relación con el producto
            'photo_url' => 'storage/' . $mainImagePath, // Ruta de la imagen
            'is_main' => true, // Indicador de foto principal
        ]);
    }

    // Guardar las fotos secundarias
    if ($request->hasFile('secondary_images')) {
        foreach ($request->file('secondary_images') as $index => $image) {
            $imagePath = $image->store('products', 'public');
            ProductPhoto::create([
                'product_id' => $product->id,
                'photo_url' => 'storage/' . $imagePath,
                'is_main' => false, // Indicador de foto secundaria
                'order' => $index, // Guardar la posición
            ]);
        }
    }

    return redirect()->route('my_products.index')->with('success', 'Producto añadido correctamente.');
}
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('my_products.index')->with('success', 'Producto eliminado correctamente.');
    }

public function update(Request $request, $id)
{
    // Buscar el producto por su ID
    $product = Product::findOrFail($id);

    // Validar los datos del formulario
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'precio' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'secondary_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Actualizar los datos básicos del producto
    $product->name = $validatedData['name'];
    $product->description = $validatedData['description'];
    $product->precio = $validatedData['precio'];
    $product->category_id = $validatedData['category_id'];
    $product->save();

    // Manejar la imagen principal
    if ($request->hasFile('main_image')) {
        // Eliminar la imagen principal anterior si existe
        $mainPhoto = $product->mainPhoto;
        if ($mainPhoto) {
            Storage::delete($mainPhoto->photo_url);
            $mainPhoto->delete();
        }

        // Guardar la nueva imagen principal
        $mainImagePath = $request->file('main_image')->store('products', 'public');
        ProductPhoto::create([
            'product_id' => $product->id,
            'photo_url' => 'storage/' . $mainImagePath,
            'is_main' => true,
        ]);
    }

    // Manejar las imágenes secundarias
if ($request->hasFile('secondary_images')) {
    // Obtener las imágenes secundarias existentes
    $existingPhotos = $product->secondaryPhotos;

    // Recorrer las imágenes secundarias enviadas en el formulario
    foreach ($request->file('secondary_images') as $index => $image) {
        if ($image) {
            // Verificar si ya existe una imagen en esta posición
            $existingPhoto = $existingPhotos->where('order', $index)->first();

            if ($existingPhoto) {
                // Eliminar la imagen anterior del almacenamiento
                Storage::delete($existingPhoto->photo_url);

                // Actualizar la imagen existente
                $imagePath = $image->store('products', 'public');
                $existingPhoto->update([
                    'photo_url' => 'storage/' . $imagePath,
                ]);
            } else {
                // Crear una nueva imagen secundaria
                $imagePath = $image->store('products', 'public');
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'photo_url' => 'storage/' . $imagePath,
                    'is_main' => false,
                    'order' => $index, // Guardar la posición
                ]);
            }
        }
    }
}

    // Redirigir con un mensaje de éxito
    return redirect()->route('my_products.index')->with('success', 'Producto actualizado correctamente.');
}

}
