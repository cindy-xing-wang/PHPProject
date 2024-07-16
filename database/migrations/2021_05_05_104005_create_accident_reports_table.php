<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accident_reports', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('email');
            $table->date('accidentDate');
            $table->text('accidentTime');
            $table->text('accidentLocation');
            $table->text('nameInvolvedParty');
            $table->text('address');
            $table->date('DOB');
            $table->text('phone');
            $table->longText('injury');
            $table->longText('damage');
            $table->longText('scenario');
            $table->boolean('notified')->default(false);

            $table->integer('accidentLevelId')->nullable()->unsigned();
            $table->foreign('accidentLevelId')->references('id')->on('accident_levels');
            // $table->foreignId('accidentLevelId')->references('id')->on('accident_levels');
            // $table->foreignId('created_by_user_id')->references('id')->on('users');
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
            $table->dropForeign('accidentLevelId');
            $table->dropForeign('userId');
        });
        Schema::dropIfExists('accident_reports');
    }
}
