<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserCurrentLocation extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->string('current_location')->after('email_token')->nullable()->default(NULL);
            $table->string('current_latitude')->after('current_location')->nullable()->default(NULL);
            $table->string('current_longitude')->after('current_latitude')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function ($table) {
            $table->dropColumn('current_location');
            $table->dropColumn('current_latitude');
            $table->dropColumn('current_longitude');
        });
    }

}
