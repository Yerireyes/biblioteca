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
            ThesesTableSeeder::class,
            UsersTableSeeder::class,
            AuthorsTableSeeder::class,
            CategoryTableSeeder::class
            ]);
    }
}
