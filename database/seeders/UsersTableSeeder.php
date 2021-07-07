<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->fullName="Down";
        $user->username="Yerireyes";
        $user->email="down@hotmail.com";
        $user->password=bcrypt("12345678");
        $user->profilePicture="abc";
        $user->roleid="1";
        $user->save();

        $user = new User();
        $user->fullName="Down";
        $user->username="Downtless";
        $user->email="downmayor@hotmail.com";
        $user->password=bcrypt("12345678");
        $user->profilePicture="abc";
        $user->roleid="1";
        $user->save();

        $user = new User();
        $user->fullName="Pam";
        $user->username="Pam";
        $user->email="pam@hotmail.com";
        $user->password=bcrypt("12345678");
        $user->profilePicture="abc";
        $user->roleid="1";
        $user->save();

    }
}
