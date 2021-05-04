<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
	        $table->unsignedBigInteger('session_id');
	        $table->unsignedBigInteger('resource_id');
	        $table->unsignedBigInteger('user_id');
	        $table->foreign('session_id')->references('id')->on('sessions');
	        $table->foreign('resource_id')->references('id')->on('resources');
	        $table->foreign('user_id')->references('id')->on('users');
	        $table->nullableTimestamps('time_started');
	        $table->nullableTimestamps('time_ended');
	        $table->time('total_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_events');
    }
}
