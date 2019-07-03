<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserDetailsTableSocialLinks extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('facebook_link')->after('income')->nullable()->default(NULL);
            $table->string('twitter_link')->after('facebook_link')->nullable()->default(NULL);
            $table->string('instagram_link')->after('twitter_link')->nullable()->default(NULL);
            $table->string('youtube_link')->after('instagram_link')->nullable()->default(NULL);
            $table->string('linkedin_link')->after('youtube_link')->nullable()->default(NULL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('user_details', function ($table) {
            $table->dropColumn('facebook_link');
            $table->dropColumn('twitter_link');
            $table->dropColumn('instagram_link');
            $table->dropColumn('youtube_link');
            $table->dropColumn('linkedin_link');
        });
    }

}
