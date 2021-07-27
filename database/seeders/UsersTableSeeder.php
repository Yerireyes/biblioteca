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
        $user->fullName="Erik Reyes Soleto";
        $user->username="Yerireyes";
        $user->email="down@hotmail.com";
        $user->password=bcrypt("12345678");
        $user->profilePicture="abc";
        $user->roleid="1";
        $user->save();

        $user = new User();
        $user->fullName="Mauricio Sauza";
        $user->username="P3J1";
        $user->email="mauricio@gmail.com";
        $user->password=bcrypt("12345678");
        $user->profilePicture="abc";
        $user->roleid="1";
        $user->save();

        $user = new User();
        $user->fullName="Pamela Ivarnegaray";
        $user->username="Pam";
        $user->email="pam@gmail.com";
        $user->password=bcrypt("12345678");
        $user->profilePicture="abc";
        $user->roleid="1";
        $user->save();

        $user = new User();
        $user->fullName="Cecilia Justiniano";
        $user->username="jpceci";
        $user->email="cecilia@gmail.com";
        $user->password=bcrypt("12345678");
        $user->profilePicture="abc";
        $user->roleid="1";
        $user->save();

        $user = new User();
        $user->fullName="Catherine Gomez";
        $user->username="Cat";
        $user->email="kiracata@hotmail.com";
        $user->password=bcrypt("12345678");
        $user->profilePicture="abc";
        $user->roleid="1";
        $user->save();

    }
}
