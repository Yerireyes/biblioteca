<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category=new Category();
        $category->name='Libros';
        $category->save();

        $category=new Category();
        $category->name='Apuntes';
        $category->save();

        $category=new Category();
        $category->name='Tesis';
        $category->save();

        $category=new Category();
        $category->name='Ciencias Formales';
        $category->superCategory=1;
        $category->save();

        $category=new Category();
        $category->name='Ciencias Naturales';
        $category->superCategory=1;
        $category->save();

        $category=new Category();
        $category->name='Ciencias Sociales';
        $category->superCategory=1;
        $category->save();

        $category=new Category();
        $category->name='Matematicas';
        $category->superCategory=4;
        $category->save();

        $category=new Category();
        $category->name='Informatica';
        $category->superCategory=4;
        $category->save();

        $category=new Category();
        $category->name='Fisica';
        $category->superCategory=5;
        $category->save();

        $category=new Category();
        $category->name='Economia';
        $category->superCategory=6;
        $category->save();

        $category=new Category();
        $category->name='Calculo I';
        $category->superCategory=2;
        $category->save();

        $category=new Category();
        $category->name='Introduccion a la Informatica';
        $category->superCategory=2;
        $category->save();

        $category=new Category();
        $category->name='Estructuras Discretas';
        $category->superCategory=2;
        $category->save();

        $category=new Category();
        $category->name='Programacion I';
        $category->superCategory=2;
        $category->save();

        $category=new Category();
        $category->name='Programacion II';
        $category->superCategory=2;
        $category->save();
        
        $category=new Category();
        $category->name='Lenguajes Formales';
        $category->superCategory=2;
        $category->save();

        $category=new Category();
        $category->name='Estructuras de Datos I';
        $category->superCategory=2;
        $category->save();

        $category=new Category();
        $category->name='Facultad de Ingenieria en Ciencias de la Computacion y Telecomunicaciones';
        $category->superCategory=3;
        $category->save();

        $category=new Category();
        $category->name='Facultad de Ciencias Economicas';
        $category->superCategory=3;
        $category->save();

        $category=new Category();
        $category->name='Facultad de Humanidades';
        $category->superCategory=3;
        $category->save();
    }
}
