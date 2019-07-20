<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersFollowing extends Model {

    protected $table = 'users_following';
    protected $fillable = [
        'user_id', 'following_user_id',
    ];

}
