<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelPlans extends Model {

    protected $table = 'travel_plans';
    protected $fillable = [
        'user_id', 'travel_depart', 'travel_deturn', 'travel_location', 'travel_status'
    ];

}
