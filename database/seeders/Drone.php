<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Drone extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drones')->insert([
            'name' => 'CHCHDrone1',
            'airportId' => 2
        ]);
        DB::table('drones')->insert([
            'name' => 'CHCHDrone2',
            'airportId' => 2
        ]);
        DB::table('drones')->insert([
            'name' => 'CHCHDrone3',
            'airportId' => 2
        ]);
        
        DB::table('drones')->insert([
            'name' => 'WDrone1',
            'airportId' => 3
        ]);
        DB::table('drones')->insert([
            'name' => 'WDrone2',
            'airportId' => 3
        ]);
        DB::table('drones')->insert([
            'name' => 'WDrone3',
            'airportId' => 3
        ]);
        
        DB::table('drones')->insert([
            'name' => 'AUDrone1',
            'airportId' => 4
        ]);
        DB::table('drones')->insert([
            'name' => 'AUDrone2',
            'airportId' => 4
        ]);
        DB::table('drones')->insert([
            'name' => 'AUDrone3',
            'airportId' => 4
        ]);
    }
}
