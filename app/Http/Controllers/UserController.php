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
use App\Http\Requests;
use Session;
use View;

class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /*
     * get users list
     * 
     */

    public function users(Request $request) {

        // filter apply if exists
        $userActivityFilter = request('userActivityFilter');
        if (!empty($userActivityFilter)) {
            if ($userActivityFilter == 1) {
                $users = User::sortable()->where('is_active', $userActivityFilter)->whereNull('deleted_at')->paginate(25);
            } else if ($userActivityFilter == 2) {
                $users = User::sortable()->where('is_active', 0)->whereNull('deleted_at')->sortable()->paginate(25);
            } else {
                $users = User::sortable()->whereNull('deleted_at')->paginate(25);
            }
            return view('user.usersfilter', compact('users'))->render();
        }

        $users = User::sortable()->whereNull('deleted_at')->paginate(25);
        $roles = DB::table('roles')->whereNull('deleted_at')->orderBy('id', 'desc')->get();

        return view('user.users', compact('users', 'roles'));
    }

    /*
     * get users list
     * 
     */

    public function userslist(Request $request) {

        if (empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $roles = DB::table('roles')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $userRoleRelations = DB::table('user_role_relations')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $userRoles = array();
        foreach ($userRoleRelations as $usrole) {
            $pc['id'] = $usrole->id;
            $pc['user_id'] = $usrole->user_id;
            $pc['role_id'] = $usrole->role_id;
            $role = Role::find($usrole->role_id);
            $pc['role_name'] = $role->name;
            $userRoles[] = $pc;
        }

        // filter apply if exists
        $userActivityFilter = request('userActivityFilter');
        $userRoleFilter = request('userRoleFilter');

        if ((!empty($userRoleFilter)) || (!empty($userActivityFilter))) {

            $users = User::select('users.id', 'users.first_name', 'users.last_name', 'users.is_active', 'users.email')
                    ->leftjoin('user_role_relations', 'users.id', '=', 'user_role_relations.user_id')
                    ->leftjoin('roles', 'roles.id', '=', 'user_role_relations.role_id')
                    ->where('user_role_relations.deleted_at', '=', NULL)
                    ->where('users.deleted_at', '=', NULL)
                    ->where('roles.deleted_at', '=', NULL);
            if ($userRoleFilter != 'all') {
                $users->where('roles.id', '=', $userRoleFilter);
            }
            if (!empty($userActivityFilter)) {
                if ($userActivityFilter == 1) {
                    $users->where('users.is_active', '=', $userActivityFilter);
                } else if ($userActivityFilter == 2) {
                    $users->where('users.is_active', '=', 0);
                }
            }
            $users = $users->orderBy('users.id', 'desc')->groupBy('users.id')->get();
//            $users = $users->orderBy('users.id', 'desc')->distinct()->get();

            return view('user.usersfilter', compact('users', 'roles', 'userRoleRelations', 'userRoles'))->render();
        }


        $users = User::sortable()->whereNull('deleted_at')->orderBy('users.id', 'desc')->paginate(10);
        $modules = DB::table('modules')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $modulePermissions = DB::table('permissions')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $serviceProviders = array();
        $serviceProviderRoleIds = array();
        $serviceProviderRoles = DB::table('roles')->whereNull('deleted_at')->where('roles.is_service_provider', '=', true)->orderBy('id', 'desc')->get();
        if ($serviceProviderRoles) {
            foreach ($serviceProviderRoles as $serviceProviderRole) {
                $spr['role_id'] = $serviceProviderRole->id;
                $serviceProviderRoleIds[] = $spr;
            }
        }
        if (count($serviceProviderRoleIds) > 0) {
//            $serviceProviders = User::sortable()
//                    ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'roles.name as name')
//                    ->leftjoin('user_role_relations', 'users.id', '=', 'user_role_relations.user_id')
//                    ->leftjoin('roles', 'roles.id', '=', 'user_role_relations.role_id')
//                    ->whereIn('user_role_relations.role_id', $serviceProviderRoleIds)
//                    ->where('user_role_relations.deleted_at', '=', NULL)
//                    ->where('users.deleted_at', '=', NULL)
//                    ->where('roles.deleted_at', '=', NULL)
//                    ->orderBy('users.id', 'desc')
//                    ->get();

            $serviceProviders = User::sortable()
                    ->select("users.*", DB::raw("GROUP_CONCAT(roles.name) as name"))
                    ->leftjoin('user_role_relations', 'users.id', '=', 'user_role_relations.user_id')
                    ->leftjoin('roles', 'roles.id', '=', 'user_role_relations.role_id')
                    ->whereIn('roles.id', $serviceProviderRoleIds)
                    ->where('user_role_relations.deleted_at', '=', NULL)
                    ->where('users.deleted_at', '=', NULL)
                    ->where('roles.deleted_at', '=', NULL)
                    ->orderBy('users.id', 'desc')
                    ->groupBy("users.id")
                    ->get();
        }
        //print_r($serviceProviders);exit;

        return view('user.userslist', compact('users', 'roles', 'userRoleRelations', 'userRoles', 'modules', 'modulePermissions', 'serviceProviders'));
    }

    /*
     * delete users
     * 
     */

    public function usersDelete($id) {
        $selUser = DB::table('users')->where('id', '=', $id)->first();
        if ($selUser) {

            DB::table('users')->where('id', '=', $id)->update(array('deleted_at' => date('y-m-d')));
            return response()->json(array('status' => true, 'message' => 'User deleted successfully'));
        }
        return response()->json(false, 401);
    }

    /*
     * users activity change function
     * 
     */

    public function usersActivityChange($id) {
        $selUser = DB::table('users')->where('id', '=', $id)->first();
        if ($selUser) {
            $currentActivity = $selUser->is_active;
            // Inactivate user
            if ($currentActivity) {
                DB::table('users')->where('id', '=', $id)->update(array('is_active' => 0));
                return response()->json(array('status' => true, 'message' => 'User Profile Inactivated Successfully'));
            }
            // activate user
            else {
                DB::table('users')->where('id', '=', $id)->update(array('is_active' => 1));
                return response()->json(array('status' => true, 'message' => 'User Profile Activated Successfully'));
            }
        }
        return response()->json(false, 401);
    }

    /*
     * edit users
     * 
     */

    public function usersEdit($id, Request $request) {

        $user = User::find($id);

        if ($request->isMethod('post')) {
            $programFormData = $request->all();

            /* $validation = Validator::make($programFormData, [
              'first_name' => ['required', 'string', 'max:255']
              ]);

              if ($validation->fails()) {
              return redirect()->route('users.edit')->withErrors($validation)->withInput();
              } */

            $user->first_name = $request->get('first_name');
            $user->last_name = $request->get('last_name');
            $response = $user->save();

            if ($response) {
                return redirect()->route('users')->with('success', 'User details updated successfully!');
            } else {
                return redirect()->route('users.edit')->withErrors($validation)->withInput();
            }
        }

        return view('user.user_edit', compact('user'));
    }

    /*
     * create new members
     * 
     */

    public function memberSave(Request $request) {
        $formData = $request->all();

        // check email & confirm email are same or not
        if ($formData['email'] != $formData['confirmEmail']) {
            return response()->json(array('status' => 'error', 'message' => 'Email and Confirm email are not matching'));
        }

        // check same emaile already exists
        $sameExists = DB::table('users')->where([['email', '=', $formData['email']], ['deleted_at', '=', NULL]])->first();
        if ($sameExists) {
            return response()->json(array('status' => 'error', 'message' => 'Email already exists'));
        }

        $validation = Validator::make($formData, [
                    'firstName' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'userRole' => ['required'],
        ]);
        if ($validation->fails()) {
            return response()->json(array('status' => 'error', 'message' => "Form validation Failed, Please enter proper details"));
        }
        $randomNumber = $this->random_strings(8);
        // save user details
        $save = User::create([
                    'first_name' => $formData['firstName'],
                    'last_name' => $formData['lastName'],
                    'email' => $formData['email'],
//                    'password' => Hash::make($password),
        ]);
        // save user role details
        $insertUserId = $save->id;
        if ($insertUserId) {
            $saveRole = UserRoleRelation::create([
                        'role_id' => $formData['userRole'],
                        'user_id' => $insertUserId,
            ]);
            // save in member password reset table
            $saveMemberPasswordReset = MemberPasswordReset::create([
                        'email' => $formData['email'],
                        'token' => $randomNumber,
                        'user_id' => $insertUserId
            ]);
            // send mail to member
            if ($saveRole && $saveMemberPasswordReset) {
                $user = array('first_name' => $formData['firstName'], 'last_name' => $formData['lastName'], 'email' => $formData['email'], 'randomNumber' => $randomNumber);
                Mail::to($user['email'])->send(new MemberCredentialsMail($user));
            }
        }
        if ($save && $saveRole) {
            return response()->json(array('status' => 'success', 'message' => 'New member saved successfully'));
        } else {
            return response()->json(array('status' => 'error', 'message' => 'New member not saved, Please try again later'));
        }
    }

    /*
     * update member details
     * 
     */

    public function memberUpdate(Request $request) {

        if ($request->isMethod('post')) {

            $formData = $request->all();
            $validation = Validator::make($formData, [
                        'firstName' => ['required', 'string', 'max:255'],
            ]);
            if ($validation->fails()) {
                return response()->json(array('status' => 'error', 'message' => "Form validation Failed, Please enter proper details"));
            }
            $user = User::find($formData['id']);
            if (empty($user)) {
                return response()->json(array('status' => 'error', 'message' => "Selected user details not getting, Please try again later"));
            }
            // update user details
            $user->first_name = $formData['firstName'];
            $user->last_name = $formData['lastName'];
            $response = $user->save();

            if ($response) {
                return response()->json(array('status' => 'success', 'message' => 'User details updated successfully'));
            } else {
                return response()->json(array('status' => 'error', 'message' => 'User details not updated, Please try again later'));
            }
        }
        return response()->json(array('status' => 'error', 'message' => 'Some error found, Please try again later'));
    }

    function random_strings($length_of_string) {

        // md5 the timestamps and returns substring 
        // of specified length 
        return substr(md5(time()), 0, $length_of_string);
    }

    /*
     * admin logout 
     * 
     */

    public function adminLogout(Request $request) {
        Auth::logout();
        $request->session()->forget('isadmin');
        return Redirect::to('/admin/login');
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
        return Redirect::to('/');

        //$message = "Page Not Found";
        //return View::make('error_user', compact('message'));
    }

}
