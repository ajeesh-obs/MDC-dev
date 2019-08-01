<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Services\UserService;
use App\Messaging;
use App\TravelPlans;
use App\UsersFollowing;
use App\Notification;
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
        // get unread notifiactions
        $unreadNotifications = $this->userService->getUnreadNotifications();

        $messageList = [];
        $selUserId = "";
        $selUserName = "";

        if (!empty($id)) {
            $selUserId = base64_decode($id);
            $selUser = DB::table('users')->where('id', '=', $selUserId)->first();
            if ($selUser) {
                $selUserName = $selUser->first_name . ' ' . $selUser->last_name;

                // set all messages as read status 
                DB::table('messaging')->where([['sender_user_id', '=', $selUserId], ['receiver_user_id', '=', Auth::id()]])->update(['is_read' => 1]);

                // get message history 
                $messageList = $this->getMessageLists($selUserId);
            }
        }
        return view('message.index', compact('LoginUserProfilePic', 'selUserId', 'selUserName', 'unreadMessages', 'unreadMessagesCount', 'latestFollowers', 'messageList', 'unreadNotifications'));
    }

    /*
     * get message history
     * 
     */

    public function messageHistory(Request $request) {
        $formData = $request->all();
        $list = "";
        $toUserId = $formData['toUserId'];

        // set all messages as read status 
        DB::table('messaging')->where([['sender_user_id', '=', $formData['toUserId']], ['receiver_user_id', '=', Auth::id()]])->update(['is_read' => 1]);
        if ($toUserId) {
            // get message history 
            $messageList = $this->getMessageLists($toUserId);
            if ($messageList) {
                $list = view('message.history', compact('messageList'));
            }
        }
        return $list;
    }

    /*
     * get message history
     * 
     */

    public function getMessageLists($toUserId = '') {
        $list = "";
        $result = array();
        $ids = array(Auth::id(), $toUserId);
        if ($toUserId) {
            // check to user is valid or not
            $selUser = DB::table('users')->where('id', '=', $toUserId)->first();
            if (!empty($selUser)) {
                // get message history 
                $getData = Messaging::select('user_details.profile_pic', 'messaging.id', 'users.first_name', 'users.last_name', 'messaging.message', 'messaging.created_at', 'messaging.sender_user_id', 'messaging.receiver_user_id', 'messaging.is_receiver_dismissed', 'messaging.messaging_parent_id')
                                ->leftjoin('user_details', 'user_details.user_id', '=', 'messaging.sender_user_id')
                                ->leftjoin('users', 'users.id', '=', 'messaging.sender_user_id')
                                ->whereIn('messaging.sender_user_id', $ids)
                                ->whereIn('messaging.receiver_user_id', $ids)
                                ->where('messaging.messaging_parent_id', NULL)
                                ->orderBy('messaging.id', 'DESC')->get();

                if ($getData) {
                    foreach ($getData as $row) {

                        $res['profile_pic'] = $row->profile_pic;
                        $res['id'] = $row->id;
                        $res['name'] = $row->first_name . ' ' . $row->last_name;
                        $res['message'] = $row->message;
                        $res['created_at'] = $row->created_at;
                        $res['sender_user_id'] = $row->sender_user_id;
                        $res['receiver_user_id'] = $row->receiver_user_id;
                        $res['is_receiver_dismissed'] = $row->is_receiver_dismissed;
                        $res['messaging_parent_id'] = $row->messaging_parent_id;

                        // get replays if exists 
                        $getDataReplay = Messaging::select('user_details.profile_pic', 'messaging.id', 'users.first_name', 'users.last_name', 'messaging.message', 'messaging.created_at', 'messaging.sender_user_id', 'messaging.receiver_user_id', 'messaging.is_receiver_dismissed', 'messaging.is_sender_dismissed', 'messaging.messaging_parent_id')
                                        ->leftjoin('user_details', 'user_details.user_id', '=', 'messaging.sender_user_id')
                                        ->leftjoin('users', 'users.id', '=', 'messaging.sender_user_id')
                                        ->whereIn('messaging.sender_user_id', $ids)
                                        ->whereIn('messaging.receiver_user_id', $ids)
                                        ->where('messaging.messaging_parent_id', $row->id)
                                        ->orderBy('messaging.id', 'ASC')->get();
                        $res['replays'] = $getDataReplay;
                        $result[] = $res;
                    }
                }
            }
        }
        return $result;
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
            return response()->json(array('status' => 'error', 'message' => 'User message not sent, Please try again later'));
        }
    }

    /*
     * send messages replay
     * 
     */

    public function messageSendReplay(Request $request) {

        $formData = $request->all();
        $validation = Validator::make($formData, [
                    'toUserId' => ['required'],
                    'message' => ['required'],
                    'parentMessageId' => ['required'],
                    'replayTypeHidden' => ['required'],
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
        if ($formData['replayTypeHidden'] == 'self') {
            $saveData = Messaging::create([
                        'sender_user_id' => Auth::id(),
                        'receiver_user_id' => Auth::id(),
                        'message' => $formData['message'],
                        'messaging_parent_id' => $formData['parentMessageId'],
                        'is_read' => 1,
            ]);
        } else {
            $saveData = Messaging::create([
                        'sender_user_id' => Auth::id(),
                        'receiver_user_id' => $formData['toUserId'],
                        'message' => $formData['message'],
                        'messaging_parent_id' => $formData['parentMessageId'],
            ]);
        }

        if ($saveData) {
            return response()->json(array('status' => 'success', 'message' => 'Message  reply sent successfully'));
        } else {
            return response()->json(array('status' => 'error', 'message' => 'User message reply not sent, Please try again later'));
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

            // cross check this msg was send from logged user
            if (Auth::id() == $selData->sender_user_id) {
                // dismiss selected msg
                DB::table('messaging')->where('id', '=', $formData['id'])->update(array('is_sender_dismissed' => 1));
                return response()->json(array('status' => 'success', 'message' => 'Message dismissed successfully'));
            }
            // cross check this msg was send to logged user
//            else if (Auth::id() == $selData->receiver_user_id) {
            else {
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
     * save travel plans
     * 
     */

    public function travelPlanSave(Request $request) {
        $formData = $request->all();
        $validation = Validator::make($formData, [
                    'travelLocation' => ['required'],
                    'travelDepart' => 'required|date',
                    'travelReturn' => 'required|date|after_or_equal:travelDepart',
        ]);
        if ($validation->fails()) {
            return response()->json(array('status' => 'error', 'message' => "Form validation Failed, Please enter proper details"));
        }
        $saveData = TravelPlans::create([
                    'user_id' => Auth::id(),
                    'travel_depart' => $formData['travelDepart'],
                    'travel_deturn' => $formData['travelReturn'],
                    'travel_location' => $formData['travelLocation'],
                    'travel_status' => 'ACTIVE',
        ]);
        if ($saveData) {

            // insert notifications if users have same location
            $usersLists = DB::table('user_details')->where('current_location', $formData['travelLocation'])->orderBy('id', 'desc')->get();
            if ($usersLists) {
                $notificationTxt = auth()->user()->first_name . ' ' . auth()->user()->last_name . ' will be in your area during ' . $formData['travelDepart'] . ' to ' . $formData['travelReturn'];
                foreach ($usersLists as $key => $usersList) {
                    $saveNotification = Notification::create([
                                'user_id' => $usersList->user_id,
                                'notification' => $notificationTxt,
                    ]);
                }
            }
            return response()->json(array('status' => 'success', 'message' => 'Travel plan saved successfully'));
        } else {
            return response()->json(array('status' => 'error', 'message' => 'Travel plan not saved, Please try again later'));
        }
    }

    /*
     * delete travel plans
     * 
     */

    public function deleteTravelPlan($id) {
        $selData = DB::table('travel_plans')->where('id', '=', $id)->first();
        if ($selData) {

            DB::table('travel_plans')->where('id', '=', $id)->update(array('deleted_at' => date('y-m-d')));
            return response()->json(array('status' => true, 'message' => 'Travel plan deleted successfully'));
        }
        return response()->json(false, 401);
    }

    /*
     * get travel plans list
     * 
     */

    public function listTravelPlan(Request $request) {
        $list = "";
        // get user travel plans
        $travelPlans = DB::table('travel_plans')->whereNull('deleted_at')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        if ($travelPlans) {
            $list = view('travel_plan_list', compact('travelPlans'));
        }
        return $list;
    }

    /*
     * update travel plans
     * 
     */

    public function travelPlanUpdate(Request $request) {
        $formData = $request->all();
        $validation = Validator::make($formData, [
                    'selid' => ['required'],
                    'travelLocation' => ['required'],
                    'travelDepart' => 'required|date',
                    'travelReturn' => 'required|date|after_or_equal:travelDepart',
        ]);
        if ($validation->fails()) {
            return response()->json(array('status' => 'error', 'message' => "Form validation Failed, Please enter proper details"));
        }
        // update details
        // check entry valid or not
        $selData = DB::table('travel_plans')->where('id', '=', $formData['selid'])->first();
        if ($selData) {
            DB::table('travel_plans')->where('id', '=', $formData['selid'])->update(
                    array(
                        'travel_depart' => $formData['travelDepart'],
                        'travel_deturn' => $formData['travelReturn'],
                        'travel_location' => $formData['travelLocation'],
                    )
            );
            return response()->json(array('status' => 'success', 'message' => 'Travel plan details modified successfully'));
        }

        return response()->json(array('status' => 'error', 'message' => 'Travel plan not modified, Please try again later'));
    }

    /*
     * notification list 
     * 
     */

    protected function notificationList() {

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
        // get unread notifiactions
        $unreadNotifications = $this->userService->getUnreadNotifications();

        // set all notificatons as read status 
        DB::table('notification')->where([['is_read', '=', 0], ['user_id', '=', Auth::id()]])->update(['is_read' => 1]);

        $notificationList = Notification::whereNull('deleted_at')->orderBy('id', 'desc')->paginate(10);

        return view('message.notification', compact('LoginUserProfilePic', 'unreadMessages', 'unreadMessagesCount', 'latestFollowers', 'notificationList', 'unreadNotifications'));
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
