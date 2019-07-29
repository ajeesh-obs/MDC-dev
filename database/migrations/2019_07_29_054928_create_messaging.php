<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessaging extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('messaging', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sender_user_id')->unsigned()->nullable();
            //$table->foreign('sender_user_id')->references('id')->on('users')->nullable();
            $table->integer('receiver_user_id')->unsigned()->nullable();
            //$table->foreign('receiver_user_id')->references('id')->on('users')->nullable();
            $table->string('message')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('messaging');
    }

}
