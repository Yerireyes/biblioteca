<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            AuthorsTableSeeder::class,
            CategoriesTableSeeder::class,
            LanguagesTableSeeder::class,
            SubjectsTableSeeder::class,
            ManagementsTableSeeder::class,
            ThesesTableSeeder::class,
            BooksTableSeeder::class
            ]);
    }
}
