<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccidentLevel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accident_levels')->insert([
            'name' => 'Near-miss'
        ]);
        DB::table('accident_levels')->insert([
            'name' => 'Minor'
        ]);
        DB::table('accident_levels')->insert([
            'name' => 'Serious'
        ]);
    }
}
