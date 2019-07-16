<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLastLocations extends Model {

    protected $table = 'user_last_locations';
    protected $fillable = [
        'location', 'latitude', 'longitude', 'user_id', 'location_date'
    ];

}
