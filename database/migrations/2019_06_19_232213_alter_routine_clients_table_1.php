<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRoutineClientsTable1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::table('routine_clients', function(Blueprint $table)
		{
			$table->tinyInteger('requested_days')->default(0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('routine_clients', function(Blueprint $table)
		{
			$table->dropColumn('requested_days');
		});
	}
}
