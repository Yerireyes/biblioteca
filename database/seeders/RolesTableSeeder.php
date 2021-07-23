<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = new Role();
        $rol->roleName="admin";
        $rol->save();

        $rol = new Role();
        $rol->roleName="user";
        $rol->save();
    }
}
