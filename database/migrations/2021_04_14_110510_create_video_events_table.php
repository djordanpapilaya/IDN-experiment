<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
	        $table->unsignedBigInteger('user_id');
	        $table->unsignedBigInteger('resource_id');
	        $table->foreign('user_id')->references('id')->on('users');
	        $table->foreign('resource_id')->references('id')->on('resources');
	        $table->time('start_time');
	        $table->time('end_time');
	        $table->time('sequence_time');
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
        Schema::dropIfExists('video_events');
    }
}
