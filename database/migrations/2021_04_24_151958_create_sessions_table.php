<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
	        $table->id();
	        $table->timestamps();
	        $table->unsignedBigInteger('user_id');
	        $table->foreign('user_id')->references('id')->on('users');
	        $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
	        $table->text('start_time')->nullable();
	        $table->text('end_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
