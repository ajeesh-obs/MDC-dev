<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\UserRoleRelation;
use App\MemberPasswordReset;
use App\Mail\MemberCredentialsMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index() {

        $user = Auth::user();
        $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();
        return view('admin.home', compact('user', 'userDetails'));
    }

    /*
     * admin logout 
     * 
     */

    public function logout() {

        Auth::logout();
        return Redirect::to('/admin/login');
    }

}
