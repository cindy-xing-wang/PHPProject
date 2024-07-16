<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportInfo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('airport_Infos')->insert([
            'name' => 'Admin'
        ]);
        DB::table('airport_Infos')->insert([
            'name' => 'Christchurch'
        ]);
        DB::table('airport_Infos')->insert([
            'name' => 'Wellington'
        ]);

        DB::table('airport_Infos')->insert([
            'name' => 'Auckland'
        ]);
    }
}
