<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberPasswordReset extends Model {

    protected $table = 'member_password_resets';
    protected $fillable = [
        'email', 'token', ' is_active', 'user_id'
    ];

}
