<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model {

    protected $table = 'user_details';
    protected $fillable = [
        'user_id', 'languages_spoken', 'about_username', 'goals_vision', 'education', 'certifications', 'awards_honor', 'conferences_events', 'volunteer_activities', 'hobbies_interests', 'income', 'facebook_link', 'twitter_link', 'instagram_link', 'youtube_link', 'linkedin_link', 'profile_pic', 
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
