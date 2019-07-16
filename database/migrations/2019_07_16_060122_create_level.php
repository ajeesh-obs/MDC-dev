<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevel extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('level', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('level');
            $table->string('badge')->nullable();
            $table->float('price', 8, 2);
            $table->float('legacy', 8, 2);
            $table->float('coins', 8, 2);
            $table->text('description')->nullable();
            $table->string('discount_code')->nullable();
            $table->enum('price_duration', ['year', 'month'])->default('year');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('level');
    }

}
