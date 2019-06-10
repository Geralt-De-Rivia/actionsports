<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkClientActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::table('client_activities', function (Blueprint $table) {
            $table->foreign('client_id', 'fk_client_activities_clients')->references('id')->on('clients')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('activity_id', 'fk_client_activities_activities')->references('id')->on('activities')->onUpdate('NO ACTION')->onDelete('NO ACTION');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_activities', function (Blueprint $table) {
            $table->dropForeign('fk_client_activities_clients');
            $table->dropForeign('fk_client_activities_activities');
        });
    }
}
