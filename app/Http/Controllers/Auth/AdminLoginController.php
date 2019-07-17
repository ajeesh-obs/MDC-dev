<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Permission;
use App\Role;
use Session;

class AdminLoginController extends Controller {
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
    protected $redirectTo = '/adminhome';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /*
     * admin login form 
     */

    public function login(Request $request) {

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);
            if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password, 'deleted_at' => NULL], $request->get('remember'))) {
                // check user in active state or not
                $userActivity = Auth::user()->is_active;
                $userEmailVerifiedAt = Auth::user()->email_verified_at;
                if (!$userActivity) {
                    Auth::logout();
                    return redirect()->route('admin.login')->with('errormessage', 'Your profile is not active');
                }
                // check email is verified or not
                if (empty($userEmailVerifiedAt)) {
                    Auth::logout();
                    return redirect()->route('admin.login')->with('errormessage', 'Your email is not verified');
                }
                // check user have module permissions
                $userId = Auth::id();
                $modulePermissionExists = 0;
                if (!empty($userId)) {
                    //get user roles 
                    $userRoles = DB::table('user_role_relations')->whereNull('deleted_at')->where('user_id', '=', $userId)->orderBy('id', 'desc')->get();
                    if ($userRoles) {
                        foreach ($userRoles as $userRole) {
                            // check module permission exists 
                            $usermodulePermission = DB::table('permissions')->whereNull('deleted_at')->where('role_id', '=', $userRole->role_id)->orderBy('id', 'desc')->count();
                            if ($usermodulePermission > 0) {
                                $modulePermissionExists = 1;
                            }
                        }
                    }
                }
                if ($modulePermissionExists == 0) {
                    Auth::logout();
                    return redirect()->route('admin.login')->with('errormessage', 'User not have module permissions');
                } else {
                    Session::put('isadmin', 1);
                    return redirect()->intended('/admin/dashboard');
                }
            }
//            return redirect()->route('admin.login')->withErrors($validation)->withInput();
            return back()->withInput($request->only('email', 'remember'));
        }

        return view('auth.admin_login');
    }

}
