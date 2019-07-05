<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Role;

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

        // filter apply if exists
        $userActivityFilter = request('userActivityFilter');
        if (!empty($userActivityFilter)) {
            if ($userActivityFilter == 1) {
                $users = User::sortable()->where('is_active', $userActivityFilter)->whereNull('deleted_at')->paginate(10);
            } else if ($userActivityFilter == 2) {
                $users = User::sortable()->where('is_active', 0)->whereNull('deleted_at')->sortable()->paginate(10);
            } else {
                $users = User::sortable()->whereNull('deleted_at')->paginate(10);
            }
            return view('user.usersfilter', compact('users'))->render();
        }

        $users = User::sortable()->whereNull('deleted_at')->paginate(10);
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
        $modules = DB::table('modules')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $modulePermissions = DB::table('permissions')->whereNull('deleted_at')->orderBy('id', 'desc')->get();

        return view('user.userslist', compact('users', 'roles', 'userRoleRelations', 'userRoles', 'modules', 'modulePermissions'));
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

}
