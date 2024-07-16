<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportCrewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_crews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->nullable()->unsigned();
            $table->foreign('userId')->references('id')->on('users')->onDelete('SET NULL');
            $table->integer('opsLogId')->nullable()->unsigned();
            $table->foreign('opsLogId')->references('id')->on('ops_logs')->onDelete('SET NULL');
           
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
        Schema::table('support_crews', function (Blueprint $table) {
            $table->dropForeign('support_crews_userId_foreign');
            $table->dropForeign('support_crews_opsLogId_foreign');
        });
        Schema::dropIfExists('support_crews');
    }
}
