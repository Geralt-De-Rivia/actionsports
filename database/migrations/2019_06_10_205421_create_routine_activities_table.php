<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutineActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routine_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('routine_id')->unsigned()->index('fk_routine_activities_routines');
            $table->bigInteger('activity_id')->unsigned()->index('fk_routine_activities_activities');
            $table->tinyInteger('day');
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
        Schema::dropIfExists('routine_activities');
    }
}
