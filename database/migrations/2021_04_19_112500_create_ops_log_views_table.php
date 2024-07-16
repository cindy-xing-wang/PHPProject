<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpsLogViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createOpsLogView());
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

    private function createOpsLogView(): string
    {
        return <<< SQL
            create VIEW ops_log_view AS
            select ops.id, ops.windSpeed wind_speed, ops.temperature, ops.visibility, ops.logNote log_note, dro.name drone_name, fp.name flight_path_name,
                pil.name pilot_name, creU.name support_crew, ai.name airport_name, ops.created_at, ops.completion, u.name created_by
                from ops_logs ops
                inner join support_crews cre
                on ops.id = cre.opsLogId
                inner join users creU
                on cre.userId = creU.id
                inner join users u
                on ops.userId = u.id
                inner join users pil
                on ops.pilotId = pil.id
                inner join drones dro
                on ops.droneId = dro.id
                inner join flight_paths fp
                on ops.flightPathId = fp.id
                inner join airport_infos ai
                on u.airportId = ai.id;
            SQL;
    }

    private function dropView(): string
    {
        return <<< SQL

            DROP VIEW IF EXISTS `ops_log_view`;
            SQL;
    }
}
