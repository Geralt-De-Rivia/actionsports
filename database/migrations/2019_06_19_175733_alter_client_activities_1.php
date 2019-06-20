<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClientActivities1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_activities', function(Blueprint $table)
        {
            $table->bigInteger('routine_id')->unsigned()->index('fk_client_activities_routine_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_activities', function(Blueprint $table)
        {
            $table->dropColumn('routine_id');
        });
    }
}
