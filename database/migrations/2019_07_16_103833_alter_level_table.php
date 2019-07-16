<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterLevelTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('level', function (Blueprint $table) {
            $table->boolean('is_default')->default(false)->after('price_duration');
        });

        DB::table('level')->insert(array(
            array('is_default' => true,
                'level' => 'DURATION',
                'price' => 0,
                'legacy' => 0,
                'coins' => 0,
                'description' => "Descriptions",
            ),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('level', function ($table) {
            $table->dropColumn('is_service_provider');
        });
    }

}
