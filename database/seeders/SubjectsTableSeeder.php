<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subject=new Subject();
        $subject->name='Programacion II';
        $subject->acronym='INF220';
        $subject->save();

        $subject=new Subject();
        $subject->name='Estructuras Discretas';
        $subject->acronym='INF119';
        $subject->save();

        $subject=new Subject();
        $subject->name='Lenguajes Formales';
        $subject->acronym='INF319';
        $subject->save();
    }
}
