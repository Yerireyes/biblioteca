<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name='Matematicas';
        $category->save();

        $category = new Category();
        $category->name='Trigonometria';
        $category->superCategory=1;
        $category->save();
    }
}
