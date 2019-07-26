<?php

namespace App\Services;

use App\UserActivityLog;
use Illuminate\Support\Facades\Auth;

class UserService {

    public function saveUserActivityLog($module = '', $activity = '') {

        UserActivityLog::create([
            'user_id' => Auth::id(),
            'module' => $module,
            'activity' => $activity
        ]);
        return true;
    }

}
