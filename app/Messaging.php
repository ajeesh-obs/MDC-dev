<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messaging extends Model {

    protected $table = 'messaging';
    protected $fillable = [
        'sender_user_id', 'receiver_user_id', 'message', 'is_read', 'is_receiver_dismissed', 'messaging_parent_id'
    ];

}
