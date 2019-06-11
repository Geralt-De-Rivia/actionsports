<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkClassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->foreign('class_id', 'fk_class_schedules_classes')->references('id')->on('classes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'fk_class_schedules_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->dropForeign('fk_class_schedules_classes');
            $table->dropForeign('fk_class_schedules_users');
        });
    }
}
