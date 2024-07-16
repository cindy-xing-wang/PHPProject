<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHazardReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hazard_reports', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('email');
            $table->date('dateOfHazard');
            $table->longText('description');
            $table->longText('suggestion');

            $table->integer('userId')->nullable()->unsigned();
            $table->foreign('userId')->references('id')->on('users');

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
        Schema::table('accident_reports', function (Blueprint $table) {
            $table->dropForeign('userId');
        });

        Schema::dropIfExists('hazard_reports');
    }
}
