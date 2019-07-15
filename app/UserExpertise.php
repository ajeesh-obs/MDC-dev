<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExpertise extends Model {

    protected $table = 'user_expertise';
    protected $fillable = [
        'user_id', 'expertise',
    ];

}
