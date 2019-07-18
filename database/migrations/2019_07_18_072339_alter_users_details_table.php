<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersDetailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('profile_pic')->nullable()->after('income');
            $table->integer('level_id')->unsigned()->nullable()->after('profile_pic');
//            $table->foreign('level_id')->references('id')->on('level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('user_details', function ($table) {
            $table->dropColumn('profile_pic');
            $table->dropColumn('level_id');
        });
    }

}
