<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcedureList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procedure_lists')->insert([
            'name' => 'preFlight'
        ]);
        
        DB::table('procedure_lists')->insert([
            'name' => 'postFlight'
        ]);
    }
}
