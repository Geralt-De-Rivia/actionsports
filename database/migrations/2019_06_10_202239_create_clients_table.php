<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dni');
            $table->string('name');
            $table->string('last_name');
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->string('code')->nullable();
            $table->string('image_url')->nullable();
            $table->string('membership_number')->nullable();
            $table->bigInteger('client_status_id')->unsigned();
            $table->date('birth_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
