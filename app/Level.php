<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model {

    protected $table = 'level';
    protected $fillable = [
        'title', 'level', 'badge', 'price', 'legacy', 'coins', 'description', 'discount_code', 'price_duration'
    ];

}
