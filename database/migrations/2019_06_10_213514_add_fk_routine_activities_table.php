<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkRoutineActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::table('routine_activities', function (Blueprint $table) {
            $table->foreign('routine_id', 'fk_routine_activities_routines')->references('id')->on('routines')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('activity_id', 'fk_routine_activities_activities')->references('id')->on('activities')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routine_activities', function (Blueprint $table) {
            $table->dropForeign('fk_routine_activities_routines');
            $table->dropForeign('fk_routine_activities_activities');
        });
    }
}
