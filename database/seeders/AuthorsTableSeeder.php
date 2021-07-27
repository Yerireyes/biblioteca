<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = new Author();
        $author->name="Erik";
        $author->lastName="Reyes";
        $author->save();

        $author = new Author();
        $author->name="Pamela";
        $author->lastName="Ivarnegaray";
        $author->save();

        $author = new Author();
        $author->name="Mauricio";
        $author->lastName="Sauza";
        $author->save();

        $author = new Author();
        $author->name="Catherine";
        $author->lastName="Gomez";
        $author->save();
    
        $author = new Author();
        $author->name="Cecilia";
        $author->lastName="Justiniano";
        $author->save();
    }
}
