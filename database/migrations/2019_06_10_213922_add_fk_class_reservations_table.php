<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkClassReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::table('class_reservations', function (Blueprint $table) {
            $table->foreign('client_id', 'fk_class_reservations_clients')->references('id')->on('clients')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('class_schedule_id', 'fk_class_reservations_class_schedules')->references('id')->on('class_schedules')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_reservations', function (Blueprint $table) {
            $table->dropForeign('fk_class_reservations_clients');
            $table->dropForeign('fk_class_reservations_class_schedules');
        });
    }
}
