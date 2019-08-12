<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnrollmentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('enrollment', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->nullable(); 
            $table->integer('assigned_id')->unsigned()->nullable();
            $table->enum('type', ['class', 'group'])->default('class');
            $table->string('name');
            $table->string('price');
            $table->timestamp('start_date')->nullable();
            $table->string('duration')->nullable()->default(null);
            $table->timestamp('publish_date')->nullable()->default(null);
            $table->integer('min_users')->nullable()->default(null);
            $table->integer('max_users')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('enrollment');
    }

}
