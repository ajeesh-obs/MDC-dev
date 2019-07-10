<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperAdminPermissions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::table('users')->insert(array(
            array('first_name' => 'SUPER', 'last_name' => 'ADMIN', 'email' => 'admin@bfaro.com', 'password' => '$2y$10$RL6HoLosV8eGiv97ZrwJdOHcGjWDPZ1i1HCvbB4rjlMU6q1lJEQuy'),
        ));

        DB::table('modules')->insert(array(
            array('module_name' => 'Users'),
            array('module_name' => 'Enrollment'),
            array('module_name' => 'Financial'),
            array('module_name' => 'Systems'),
            array('module_name' => 'Leaderboard'),
            array('module_name' => 'Store'),
        ));

        DB::table('roles')->insert(array(
            array('name' => 'Admin', 'is_service_provider' => 0),
            array('name' => 'Users', 'is_service_provider' => 0),
            array('name' => 'COACH', 'is_service_provider' => 0),
            array('name' => 'Member', 'is_service_provider' => 0),
            array('name' => 'VIDEO GRAPHER', 'is_service_provider' => 1),
        ));

        DB::table('user_role_relations')->insert(array(
            array('user_id' => 1, 'role_id' => 1),
            array('user_id' => 1, 'role_id' => 2),
            array('user_id' => 1, 'role_id' => 3),
            array('user_id' => 1, 'role_id' => 4),
        ));

        DB::table('permissions')->insert(array(
            array('role_id' => 1, 'module_id' => 1),
            array('role_id' => 1, 'module_id' => 2),
            array('role_id' => 1, 'module_id' => 3),
            array('role_id' => 1, 'module_id' => 4),
            array('role_id' => 1, 'module_id' => 5),
            array('role_id' => 1, 'module_id' => 6),
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
    }

}
