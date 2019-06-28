<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkClassScheduleRecurencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::table('class_schedule_recurrences', function (Blueprint $table) {
            $table->foreign('class_schedule_id', 'fk_class_schedule_recurrences_class_schedules')->references('id')->on('class_schedules')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_schedule_recurrences', function (Blueprint $table) {
            $table->dropForeign('fk_class_schedule_recurrences_class_schedules');
        });
    }
}
