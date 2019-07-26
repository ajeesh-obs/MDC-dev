<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model {

    protected $table = 'user_activity_log';
    protected $fillable = [
        'user_id', 'module', 'activity'
    ];

}
