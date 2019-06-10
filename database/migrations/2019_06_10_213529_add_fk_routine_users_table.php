<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkRoutineUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::table('routine_clients', function (Blueprint $table) {
            $table->foreign('routine_id', 'fk_routine_clients_routines')->references('id')->on('routines')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'fk_routine_clients_users')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('client_id', 'fk_routine_clients_clients')->references('id')->on('clients')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routine_clients', function (Blueprint $table) {
            $table->dropForeign('fk_routine_clients_routines');
            $table->dropForeign('fk_routine_clients_users');
            $table->dropForeign('fk_routine_clients_clients');
        });
    }
}
