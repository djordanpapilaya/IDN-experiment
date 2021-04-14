<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
	        $table->unsignedBigInteger('user_id');
	        $table->unsignedBigInteger('resource_id');
	        $table->foreign('user_id')->references('id')->on('users');
	        $table->foreign('resource_id')->references('id')->on('resources');
	        $table->integer('page_visit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_events');
    }
}
