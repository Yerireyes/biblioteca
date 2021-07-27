<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Management;

class ManagementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $management=new Management();
        $management->name='II-2018';
        $management->save();

        $management=new Management();
        $management->name='I-2019';
        $management->save();

        $management=new Management();
        $management->name='II-2019';
        $management->save();

        $management=new Management();
        $management->name='I-2020';
        $management->save();

        $management=new Management();
        $management->name='II-2020';
        $management->save();

        $management=new Management();
        $management->name='I-2021';
        $management->save();

        $management=new Management();
        $management->name='II-2021';
        $management->save();
    }
}
