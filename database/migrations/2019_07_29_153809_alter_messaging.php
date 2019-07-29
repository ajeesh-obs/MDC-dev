<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessaging extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('messaging', function (Blueprint $table) {
            $table->integer('messaging_parent_id')->unsigned()->nullable()->after('is_receiver_dismissed');
            //$table->foreign('messaging_parent_id')->references('id')->on('messaging')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('messaging', function ($table) {
            $table->dropColumn('messaging_parent_id');
        });
    }

}
