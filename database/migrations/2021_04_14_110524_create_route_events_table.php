<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('session_id');
	        $table->unsignedBigInteger('resource_id');
	        $table->unsignedBigInteger('user_id');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->foreign('resource_id')->references('id')->on('resources');
	        $table->foreign('user_id')->references('id')->on('users');
            $table->integer('times_visited');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_events');
    }
}
