<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpsLogByAirportViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createOpsLogByAirportView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }

    private function createOpsLogByAirportView(): string
    {
        return <<< SQL
            create VIEW ops_log_by_airport_view AS
            select ops.id, windSpeed, temperature, visibility, logNote, completion, userId, ops.created_at, airportId  from ops_logs ops 
            inner join users u on ops.userId = u.id;
            SQL;
    }

    private function dropView(): string
    {
        return <<< SQL

            DROP VIEW IF EXISTS `ops_log_by_airport_view`;
            SQL;
    }
}
