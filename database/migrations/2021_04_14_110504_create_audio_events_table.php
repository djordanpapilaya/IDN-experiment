<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudioEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
	        $table->unsignedBigInteger('session_id');
	        $table->unsignedBigInteger('resource_id');
	        $table->unsignedBigInteger('user_id');
	        $table->foreign('session_id')->references('id')->on('sessions');
	        $table->foreign('resource_id')->references('id')->on('resources');
	        $table->foreign('user_id')->references('id')->on('users');
	        $table->time('start_time');
	        $table->time('end_time');
	        $table->time('sequence_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audio_events');
    }
}
