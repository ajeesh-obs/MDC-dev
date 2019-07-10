<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable {

    use Notifiable;

    protected $guard = 'admin';
    
     protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'facebook_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function addNew($input) {

        $check = static::where('facebook_id', $input['facebook_id'])->first();
        if (is_null($check)) {

            return static::create($input);
        }
        return $check;
    }

    public function sendPasswordResetNotification($token) {

        $this->notify(new AdminResetPasswordNotification($token));
    }

}
