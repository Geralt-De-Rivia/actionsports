<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterKeysTable1 extends Migration
{
    public function up()
    {
        Schema::table('keys', function(Blueprint $table)
        {
            $table->string('key', 30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keys', function(Blueprint $table)
        {
            $table->dropColumn('key');
        });
    }
}
