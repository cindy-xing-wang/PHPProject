<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklist_logs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('procedureLogId')->nullable()->unsigned();
            $table->foreign('procedureLogId')->references('id')->on('procedure_logs')->onDelete('SET NULL');
            $table->integer('checklistId')->nullable()->unsigned();
            $table->foreign('checklistId')->references('id')->on('checklists')->onDelete('SET NULL');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checklist_logs', function (Blueprint $table) {
            $table->dropForeign('checklist_logs_procedureLogId_foreign');
            $table->dropForeign('checklist_logs_checklistId_foreign');
        });
        Schema::dropIfExists('checklist_logs');
    }
}
