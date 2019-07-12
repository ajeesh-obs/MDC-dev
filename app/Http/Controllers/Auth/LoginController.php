<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
    
    /*
     * function override to add additional parameters for login checking
     */
    protected function credentials(Request $request) {

        return array_merge($request->only($this->username(), 'password'), ['is_active' => 1, 'deleted_at' => NULL]);
    }

    /*
     * member reset password
     * 
     */

    public function usersResetPassword($id, Request $request) {
        $message = "Error occured, Please try again later";
        $randomNumber = $id;
        $getData = DB::table('member_password_resets')->where([['token', '=', $randomNumber]])->first();
        if ($getData) {
            if ($getData->user_id) {
                $user = User::find($getData->user_id);
                //check member password reset link active or not
                $resetActive = DB::table('member_password_resets')->where([['user_id', '=', $getData->user_id], ['email', '=', $getData->email], ['token', '=', $randomNumber], ['is_active', '=', 1]])->first();
                if (empty($resetActive)) {
                    $message = "The password link expired";
                    return view('error', compact('message'));
                }
            }
            return view('user.reset', compact('user'));
        }
        return view('error', compact('message'));
    }

    /*
     * member password update 
     * 
     */

    public function memberPasswordUpdate(Request $request) {
        $formData = $request->all();
        // check email & confirm email are same or not
        if ($formData['password'] != $formData['passwordconfirm']) {
            return response()->json(array('status' => 'error', 'message' => 'Password and Confirm password are not matching'));
        }
        $validation = Validator::make($formData, [
                    'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validation->fails()) {
            return response()->json(array('status' => 'error', 'message' => "Form validation Failed, Please enter proper details"));
        }
        $getData = DB::table('users')->where([['id', '=', $formData['id']], ['email', '=', $formData['email']]])->first();
        if (empty($getData)) {
            return response()->json(array('status' => 'error', 'message' => "selected user details not getting"));
        }
        //check member password reset link active or not
        $resetActive = DB::table('member_password_resets')->where([['user_id', '=', $formData['id']], ['email', '=', $formData['email']], ['is_active', '=', 1]])->first();
        if (empty($resetActive)) {
            return response()->json(array('status' => 'error', 'message' => "Password reset link not active, Please contact administrator"));
        }
        // update user details 
        $password = Hash::make($formData['password']);
        $response = DB::table('users')->where([['id', '=', $formData['id']], ['email', '=', $formData['email']]])->update(['password' => $password]);
        $save = DB::table('member_password_resets')->where([['user_id', '=', $formData['id']], ['email', '=', $formData['email']]])->update(['is_active' => 0]);
        // update member password details
        if ($response && $save) {
            return response()->json(array('status' => 'success', 'message' => 'User details updated successfully'));
        } else {
            return response()->json(array('status' => 'error', 'message' => 'User details not updated, Please try again later'));
        }
        return response()->json(array('status' => 'error', 'message' => 'Some error found, Please try again later'));
    }

}
