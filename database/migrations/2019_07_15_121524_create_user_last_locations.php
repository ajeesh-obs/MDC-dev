<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLastLocations extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_last_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('location');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('user_id')->unsigned()->nullable();
//            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->dateTime('location_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_last_locations');
    }

}
