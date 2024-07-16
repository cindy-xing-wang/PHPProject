<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ops_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('windSpeed', 4,2);
            $table->decimal('temperature', 5,2);
            $table->text('visibility');
            $table->longText('logNote')->nullable();
            $table->boolean('completion')->default(false);
            
            $table->integer('droneId')->nullable()->unsigned();
            $table->foreign('droneId')->references('id')->on('drones')->onDelete('SET NULL');
           
            $table->integer('flightPathId')->nullable()->unsigned();
            $table->foreign('flightPathId')->references('id')->on('flight_paths')->onDelete('SET NULL');
           
            $table->integer('pilotId')->nullable()->unsigned();
            $table->foreign('pilotId')->references('id')->on('users')->onDelete('SET NULL');
           
            $table->integer('userId')->nullable()->unsigned();
            $table->foreign('userId')->references('id')->on('users')->onDelete('SET NULL');
           
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
        Schema::table('ops_logs', function (Blueprint $table) {
            $table->dropForeign('ops_logs_droneId_foreign');
            $table->dropForeign('ops_logs_flightPathId_foreign');
            $table->dropForeign('ops_logs_pilotId_foreign');
            $table->dropForeign('ops_logs_userId_foreign');
        });
        Schema::dropIfExists('ops_logs');
    }
}
