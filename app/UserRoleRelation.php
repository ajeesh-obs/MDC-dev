<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoleRelation extends Model {

    protected $table = 'user_role_relations';
    protected $fillable = [
        'user_id', 'role_id',
    ];

}
