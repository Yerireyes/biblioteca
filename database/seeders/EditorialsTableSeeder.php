<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Editorial;

class EditorialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $editorial=new Editorial();
        $editorial->name='Galaxia Gutenberg';
        $editorial->save();

        $editorial=new Editorial();
        $editorial->name='Leonardo';
        $editorial->save();

        $editorial=new Editorial();
        $editorial->name='Bonaventuriano';
        $editorial->save();


    }
}
