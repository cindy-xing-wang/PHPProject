<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('stepNum');

            $table->integer('userId')->nullable()->unsigned();
            $table->foreign('userId')->references('id')->on('users')->onDelete('SET NULL');
            $table->integer('procedureId')->nullable()->unsigned();
            $table->foreign('procedureId')->references('id')->on('procedure_lists')->onDelete('SET NULL');
           
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
        Schema::table('checklists', function (Blueprint $table) {
            $table->dropForeign('checklists_userId_foreign');
            $table->dropForeign('checklists_procedureId_foreign');
        });
        Schema::dropIfExists('checklists');
    }
}
