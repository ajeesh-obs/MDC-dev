<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Services\UserService;
use App\Messaging;
use App\UsersFollowing;
use Illuminate\Support\Facades\Validator;

class MessagingController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService) {
        $this->middleware('auth');
        $this->userService = $userService;
    }

    /*
     * landing page
     */

    public function index($id = '') {

        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $LoginUserProfilePic = "";
        $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();
        if ($userDetails) {
            if ($userDetails->profile_pic) {
                $LoginUserProfilePic = $userDetails->profile_pic;
            }
        }
        // get unread messages 
        $unreadMessages = $this->userService->getUnreadMessages();
        $unreadMessagesCount = count($unreadMessages);
        // get latest followers list
        $latestFollowers = $this->userService->getLatestFollowers();

        $getData = [];
        $selUserId = "";
        $selUserName = "";

        if (!empty($id)) {
            $selUserId = base64_decode($id);
            $selUser = DB::table('users')->where('id', '=', $selUserId)->first();
            if ($selUser) {
                $selUserName = $selUser->first_name . ' ' . $selUser->last_name;

                // set all messages as read status 
                DB::table('messaging')->where([['sender_user_id', '=', $selUserId], ['receiver_user_id', '=', Auth::id()]])->update(['is_read' => 1]);

                $ids = array(Auth::id(), $selUserId);
                // get message history 
                $getData = Messaging::select('user_details.profile_pic', 'messaging.id', 'users.first_name', 'users.last_name', 'messaging.message', 'messaging.created_at', 'messaging.sender_user_id', 'messaging.receiver_user_id', 'messaging.is_receiver_dismissed')
                                ->leftjoin('user_details', 'user_details.user_id', '=', 'messaging.sender_user_id')
                                ->leftjoin('users', 'users.id', '=', 'messaging.sender_user_id')
                                ->whereIn('messaging.sender_user_id', $ids)
                                ->whereIn('messaging.receiver_user_id', $ids)
                                ->orderBy('messaging.id', 'DESC')->get();
            }
        }
        return view('message.index', compact('LoginUserProfilePic', 'getData', 'selUserId', 'selUserName', 'unreadMessages', 'unreadMessagesCount', 'latestFollowers'));
    }

    /*
     * send messages
     * 
     */

    public function messageSend(Request $request) {

        $formData = $request->all();
        $validation = Validator::make($formData, [
                    'toUserId' => ['required'],
                    'message' => ['required'],
        ]);
        if ($validation->fails()) {
            return response()->json(array('status' => 'error', 'message' => "Form validation Failed, Please enter proper details"));
        }
        // check to user is valid or not
        $selUser = DB::table('users')->where('id', '=', $formData['toUserId'])->first();
        if (empty($selUser)) {
            return response()->json(array('status' => 'error', 'message' => "Selected user details not getting, Please try again later"));
        }
        // check user is active or not
        if (empty($selUser->is_active)) {
            return response()->json(array('status' => 'error', 'message' => "Selected user profile is not active"));
        }
        // save message
        $saveData = Messaging::create([
                    'sender_user_id' => Auth::id(),
                    'receiver_user_id' => $formData['toUserId'],
                    'message' => $formData['message'],
        ]);
        if ($saveData) {
            return response()->json(array('status' => 'success', 'message' => 'Message sent successfully'));
        } else {
            return response()->json(array('status' => 'error', 'message' => 'User message sent not sent, Please try again later'));
        }
    }

    /*
     * dismiss messages
     * 
     */

    public function messageDismiss(Request $request) {
        $formData = $request->all();
        $validation = Validator::make($formData, [
                    'id' => ['required'],
        ]);
        if ($validation->fails()) {
            return response()->json(array('status' => 'error', 'message' => "Form validation Failed, Please enter proper details"));
        }

        // check entry valid or not
        $selData = DB::table('messaging')->where('id', '=', $formData['id'])->first();
        if ($selData) {
            // cross check this msg was send to logged user
            if (Auth::id() == $selData->receiver_user_id) {
                // dismiss selected msg
                DB::table('messaging')->where('id', '=', $formData['id'])->update(array('is_receiver_dismissed' => 1));
                return response()->json(array('status' => 'success', 'message' => 'Message dismissed successfully'));
            }
        }
        return response()->json(array('status' => 'error', 'message' => 'Message not dismissed, Please try again later'));
    }

    /*
     * get all followers  list
     * 
     */

    public function myFollowersAll(Request $request) {

        $formData = $request->all();
        $value = $formData['value'];

        $list = "";
        $followersCount = UsersFollowing::where('following_user_id', '=', Auth::id())->count();
        $followers = UsersFollowing::select('user_details.profile_pic', 'users_following.id', 'users_following.id', 'users.first_name', 'users.last_name', 'users_following.user_id')
                ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.user_id')
                ->leftjoin('users', 'users.id', '=', 'users_following.user_id')
                ->where('users_following.following_user_id', '=', Auth::id());
        if (!empty($value)) {
            $followers->where(function($query) use($value) {
                $query->where('users.first_name', 'LIKE', "%$value%")
                        ->orWhere('users.last_name', 'LIKE', "%$value%");
            });
        }
        $followers = $followers->orderBy('users_following.id', 'DESC')
//                ->skip(5)
                ->take($followersCount)
                ->get();
        if ($followers) {
            $list = view('message.my_followers_all', compact('followers'));
        }
        return $list;
    }

    /*
     * get message history
     * 
     */

    public function messageHistory(Request $request) {
        $formData = $request->all();
        $list = "";
        $toUserId = $formData['toUserId'];
        $ids = array(Auth::id(), $toUserId);

        // set all messages as read status 
        DB::table('messaging')->where([['sender_user_id', '=', $formData['toUserId']], ['receiver_user_id', '=', Auth::id()]])->update(['is_read' => 1]);

        if ($toUserId) {
            // check to user is valid or not
            $selUser = DB::table('users')->where('id', '=', $formData['toUserId'])->first();
            if (!empty($selUser)) {
                // get message history 
                $getData = Messaging::select('user_details.profile_pic', 'messaging.id', 'users.first_name', 'users.last_name', 'messaging.message', 'messaging.created_at', 'messaging.sender_user_id', 'messaging.receiver_user_id', 'messaging.is_receiver_dismissed')
                                ->leftjoin('user_details', 'user_details.user_id', '=', 'messaging.sender_user_id')
                                ->leftjoin('users', 'users.id', '=', 'messaging.sender_user_id')
                                ->whereIn('messaging.sender_user_id', $ids)
                                ->whereIn('messaging.receiver_user_id', $ids)
                                ->orderBy('messaging.id', 'DESC')->get();
                if ($getData) {
                    $list = view('message.history', compact('getData'));
                }
            }
        }
        return $list;
    }

    /*
     * check logged as admin or user 
     * 
     */

    protected function loggedUserCheck() {
        $isadmin = session('isadmin');
        return $isadmin;
    }

    /*
     * error function
     * 
     */

    protected function errorFunction() {
        return Redirect::to('/admin/dashboard');
    }

}
