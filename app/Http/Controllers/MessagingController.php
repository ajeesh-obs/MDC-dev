<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Services\UserService;
use App\Messaging;
use Illuminate\Support\Facades\Validator;

class MessagingController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
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

        $getData = [];
        $selUserId = "";
        $selUserName = "";  

        if (!empty($id)) {
            $selUserId = base64_decode($id);
            $selUser = DB::table('users')->where('id', '=', $selUserId)->first();
            if ($selUser) {
                $selUserName = $selUser->first_name . ' ' . $selUser->last_name;

                $ids = array(Auth::id(), $selUserId);
                // get message history 
                $getData = Messaging::select('user_details.profile_pic', 'messaging.id', 'users.first_name', 'users.last_name', 'messaging.message', 'messaging.created_at', 'messaging.sender_user_id', 'messaging.receiver_user_id')
                                ->leftjoin('user_details', 'user_details.user_id', '=', 'messaging.sender_user_id')
                                ->leftjoin('users', 'users.id', '=', 'messaging.sender_user_id')
                                ->whereIn('messaging.sender_user_id', $ids)
                                ->whereIn('messaging.receiver_user_id', $ids)
                                ->orderBy('messaging.id', 'DESC')->get();
            }
        }
        return view('message.index', compact('LoginUserProfilePic', 'getData', 'selUserId', 'selUserName'));
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
     * get message history
     * 
     */

    public function messageHistory(Request $request) {
        $formData = $request->all();
        $list = "";
        $toUserId = $formData['toUserId'];
        $ids = array(Auth::id(), $toUserId);

        if ($toUserId) {
            // check to user is valid or not
            $selUser = DB::table('users')->where('id', '=', $formData['toUserId'])->first();
            if (!empty($selUser)) {
                // get message history 
                $getData = Messaging::select('user_details.profile_pic', 'messaging.id', 'users.first_name', 'users.last_name', 'messaging.message', 'messaging.created_at', 'messaging.sender_user_id', 'messaging.receiver_user_id')
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
