<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language=New Language();
        $language->name='español';
        $language->save();

        $language=New Language();
        $language->name='ingles';
        $language->save();

        $language=New Language();
        $language->name='tailandes';
        $language->save();
    }
}
