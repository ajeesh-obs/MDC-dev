<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    protected $table = 'notification';
    protected $fillable = [
        'notification', 'user_id', 'is_read'
    ];

}
