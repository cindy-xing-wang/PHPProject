<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedureLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('completion')->default(false);
            $table->longText('logNote')->nullable();

            $table->integer('procedureId')->nullable()->unsigned();
            $table->foreign('procedureId')->references('id')->on('procedure_lists')->onDelete('SET NULL');
            $table->integer('operationId')->nullable()->unsigned();
            $table->foreign('operationId')->references('id')->on('ops_logs')->onDelete('SET NULL');
            
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
        Schema::table('procedure_logs', function (Blueprint $table) {
            $table->dropForeign('procedure_logs_procedureId_foreign');
            $table->dropForeign('procedure_logs_operationId_foreign');
        });
        Schema::dropIfExists('procedure_logs');
    }
}