<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkClientsTable extends Migration
{
    public function up()
    {
        Schema::table('clients', function(Blueprint $table)
        {
            $table->foreign('client_status_id', 'fk_clients_client_statuses')->references('id')->on('client_statuses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function(Blueprint $table)
        {
            $table->dropForeign('fk_clients_client_statuses');
        });
    }
}
