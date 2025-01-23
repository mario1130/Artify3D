<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $category = new Category();
        $category->name = 'renders';

        $category2 = new Category();
        $category2->name = 'tutoriales';

        $category3 = new Category();
        $category3->name = 'blender';

        $category4 = new Category();
        $category4->name = 'maya';

        $category5 = new Category();
        $category5->name = 'sketchup';


        $category->save();
        $category2->save();
        $category3->save();
        $category4->save();
    }
}
