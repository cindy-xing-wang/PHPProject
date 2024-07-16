<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreFlightLogViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement($this->createPreFlightLogView());
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

    private function createPreFlightLogView(): string
    {
        return <<< SQL
            create VIEW pre_flight_log_view AS
            select ops.id operation_id, prol.id procedure_id, prol.name procedure_name, prolog.completion pre_flight_completion, prolog.logNote pre_flight_logNote, chec.name,
                ops.created_at
                from ops_logs ops
                inner join procedure_logs prolog
                on prolog.operationId = ops.id
                inner join checklist_logs checlog
                on checlog.procedureLogId = prolog.id
                inner join checklists chec
                on chec.id = checlog.checklistId
                inner join procedure_lists prol
                on prol.id = prolog.procedureId 
                where prol.id = 1;
            SQL;
    }

    private function dropView(): string
    {
        return <<< SQL

            DROP VIEW IF EXISTS `pre_flight_log_view`;
            SQL;
    }
}
