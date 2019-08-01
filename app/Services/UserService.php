<?php

namespace App\Services;

use App\UserActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Messaging;
use App\UsersFollowing;
use App\Notification;

class UserService {
    /*
     * save user activities
     */

    public function saveUserActivityLog($module = '', $activity = '') {

        UserActivityLog::create([
            'user_id' => Auth::id(),
            'module' => $module,
            'activity' => $activity
        ]);
        return true;
    }

    /*
     * get unread messages 
     * 
     */

    public function getUnreadMessages() {

        // get message history 
        $getData = Messaging::select('user_details.profile_pic', 'messaging.id', 'users.first_name', 'users.last_name', 'messaging.message', 'messaging.created_at', 'messaging.sender_user_id', 'messaging.receiver_user_id')
                        ->leftjoin('user_details', 'user_details.user_id', '=', 'messaging.sender_user_id')
                        ->leftjoin('users', 'users.id', '=', 'messaging.sender_user_id')
                        ->where('messaging.receiver_user_id', Auth::id())
                        ->where('messaging.is_read', 0)
                        ->orderBy('messaging.id', 'DESC')->get();
        return $getData;
    }

    /*
     * get unread notifications 
     * 
     */

    public function getUnreadNotifications() {

        // get message history 
        $getData = Notification::where('user_id', Auth::id())
                        ->where('is_read', 0)
                        ->whereNull('deleted_at')
                        ->orderBy('id', 'DESC')->get();
        return $getData;
    }

    /*
     * get lastest folllowers
     * 
     */

    public function getLatestFollowers() {
        $latestFollowers = UsersFollowing::select('user_details.profile_pic', 'users_following.id', 'users.first_name', 'users.last_name', 'users_following.user_id')
                ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.user_id')
                ->leftjoin('users', 'users.id', '=', 'users_following.user_id')
                ->where('users_following.following_user_id', '=', Auth::id())
                ->orderBy('users_following.id', 'DESC')
                ->take(5)
                ->get();
        return $latestFollowers;
    }

}
