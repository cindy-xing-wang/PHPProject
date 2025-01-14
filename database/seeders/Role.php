<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin'
        ]);
        DB::table('roles')->insert([
            'name' => 'sub-admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'staff'
        ]);
    }
}
