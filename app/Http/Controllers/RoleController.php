<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Role;
use App\User;
use App\UserRoleRelation;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /*
     * New roles create 
     * 
     */

    public function create(Request $request) {

        if ($request->isMethod('post')) {
            $formData = $request->all();

            $validation = Validator::make($formData, [
                        'name' => ['required', 'string', 'max:255']
            ]);

            if ($validation->fails()) {
                return redirect()->route('role.create')->withErrors($validation)->withInput();
            }

            $save = Role::create([
                        'name' => $formData['name']
            ]);

            if ($save) {
                return redirect()->route('users')->with('success', 'Role created successfully!');
            } else {
                return redirect()->route('role.create')->withErrors($validation)->withInput();
            }
        }

        return view('role.create');
    }

    /*
     * user role modificatins
     * 
     */

    public function roleModify(Request $request) {

        $ischecked = $request->input('ischecked');
        $roleId = $request->input('role_id');
        $userId = $request->input('user_id');

        $User = User::find($userId);
        $role = Role::find($roleId);
        if ((empty($roleId)) || (empty($userId)) || (empty($User)) || (empty($role))) {
            return response()->json(array('status' => 'error', 'message' => 'Required details missing'));
        }
        $formData = $request->all();
        // give role to selected user
        if ($ischecked == 'true') {

            $validation = Validator::make($formData, [
                        'user_id' => ['required', 'numeric'],
                        'role_id' => ['required', 'numeric']
            ]);
            if ($validation->fails()) {
                return redirect()->route('userslist')->withErrors($validation)->withInput();
            }
            // check user have same role already exists
            $roleExists = DB::table('user_role_relations')->where([['user_id', '=', $formData['user_id']], ['role_id', '=', $formData['role_id']], ['deleted_at', '=', NULL]])->first();
            if ($roleExists) {
                return response()->json(array('status' => 'error', 'message' => 'User already role exists'));
            }

            $save = UserRoleRelation::create([
                        'user_id' => $formData['user_id'],
                        'role_id' => $formData['role_id'],
            ]);
            if ($save) {
                return response()->json(array('status' => 'success', 'message' => 'User role saved successfully'));
            } else {
                return response()->json(array('status' => 'error', 'message' => 'User role not saved, Please try again later'));
            }
        }
        // remove role from selected user
        else {

            $update = DB::table('user_role_relations')
                    ->where('user_id', $formData['user_id'])
                    ->where('role_id', $formData['role_id'])
                    ->update(['deleted_at' => date('y-m-d')]);

            if ($update) {
                return response()->json(array('status' => 'success', 'message' => 'User role removed successfully'));
            } else {
                return response()->json(array('status' => 'error', 'message' => 'User role not removed, Please try again later'));
            }
        }
    }

    /*
     * create new roles
     * 
     */

    public function roleNew(Request $request) {

        $formData = $request->all();
        $validation = Validator::make($formData, [
                    'roleName' => ['required', 'string', 'max:255']
        ]);
        if ($validation->fails()) {
            return redirect()->route('userslist')->withErrors($validation)->withInput();
        }
        // check same role name already exists
        $roleExists = DB::table('roles')->where([['name', '=', $formData['roleName']], ['deleted_at', '=', NULL]])->first();
        if ($roleExists) {
            return response()->json(array('status' => 'error', 'message' => 'Role name already exists'));
        }

        $save = Role::create([
                    'name' => strtoupper($formData['roleName']),
                    'is_service_provider' => $formData['is_service_provider'],
        ]);
        if ($save) {
            return response()->json(array('status' => 'success', 'message' => 'Role saved successfully'));
        } else {
            return response()->json(array('status' => 'error', 'message' => 'Role not saved, Please try again later'));
        }
    }

}
