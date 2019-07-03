<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->integer('user_id')->unsigned()->nullable();
            //$table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->string('languages_spoken')->nullable();
            $table->text('about_username')->nullable();
            $table->text('goals_vision')->nullable();
            $table->string('education')->nullable();
            $table->text('certifications')->nullable();
            $table->text('awards_honor')->nullable();
            $table->text('conferences_events')->nullable();
            $table->text('volunteer_activities')->nullable();
            $table->text('hobbies_interests')->nullable();
            $table->float('income', 8, 2)->nullable();	 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('user_details');
    }

}
