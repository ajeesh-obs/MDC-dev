<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessaging1 extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('messaging', function (Blueprint $table) {
            $table->boolean('is_receiver_dismissed')->default(false)->after('is_read');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('messaging', function ($table) {
            $table->dropColumn('is_receiver_dismissed');
        });
    }

}
