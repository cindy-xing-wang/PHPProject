<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightPath extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('flight_paths')->insert([
            'name' => 'CHCH1',
            'airportId' => 2
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'CHCH2',
            'airportId' => 2
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'CHCH3',
            'airportId' => 2
        ]);
        
        DB::table('flight_paths')->insert([
            'name' => 'W1',
            'airportId' => 3
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'W2',
            'airportId' => 3
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'W3',
            'airportId' => 3
        ]);
        
        DB::table('flight_paths')->insert([
            'name' => 'AU1',
            'airportId' => 4
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'AU2',
            'airportId' => 4
        ]);
        DB::table('flight_paths')->insert([
            'name' => 'AU3',
            'airportId' => 4
        ]);
    }
}
