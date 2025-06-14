<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 1; $i <= 13; $i++) {
                Product::create([
                    'name' => "Producto {$i} de {$category->name}",
                    'description' => "Descripción del producto {$i} en la categoría {$category->name}",
                    'precio' => rand(10, 100),
                    'category_id' => $category->id,
                    'user_id' => 1, // Cambia esto por el ID de un usuario válido
                    'download_url' => null,
                ]);
            }
        }
    }
}
