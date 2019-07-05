<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Module;
use App\Role;
use App\Permission;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /*
     * New module create 
     * 
     */

    public function create(Request $request) {

        if ($request->isMethod('post')) {
            $formData = $request->all();

            $validation = Validator::make($formData, [
                        'module_name' => ['required', 'string', 'max:255']
            ]);

            if ($validation->fails()) {
                return redirect()->route('module.create')->withErrors($validation)->withInput();
            }

            $save = Module::create([
                        'module_name' => $formData['module_name']
            ]);

            if ($save) {
                return redirect()->route('users')->with('success', 'Module created successfully!');
            } else {
                return redirect()->route('module.create')->withErrors($validation)->withInput();
            }
        }

        return view('module.create');
    }

    /*
     * user role modificatins
     * 
     */

    public function permissionModify(Request $request) {

        $ischecked = $request->input('ischecked');
        $roleId = $request->input('role_id');
        $moduleId = $request->input('module_id');

        $module = Module::find($moduleId);
        $role = Role::find($roleId);
        if ((empty($roleId)) || (empty($moduleId)) || (empty($module)) || (empty($role))) {
            return response()->json(array('status' => 'error', 'message' => 'Required details missing'));
        }
        $formData = $request->all();
        // give permission to selected role
        if ($ischecked == 'true') {

            $validation = Validator::make($formData, [
                        'module_id' => ['required', 'numeric'],
                        'role_id' => ['required', 'numeric']
            ]);
            if ($validation->fails()) {
                return redirect()->route('userslist')->withErrors($validation)->withInput();
            }
            // check user have same role already exists
            $roleExists = DB::table('permissions')->where([['module_id', '=', $formData['module_id']], ['role_id', '=', $formData['role_id']], ['deleted_at', '=', NULL]])->first();
            if ($roleExists) {
                return response()->json(array('status' => 'error', 'message' => 'Permission already exists'));
            }

            $save = Permission::create([
                        'module_id' => $formData['module_id'],
                        'role_id' => $formData['role_id'],
            ]);
            if ($save) {
                return response()->json(array('status' => 'success', 'message' => 'Module Permission saved successfully'));
            } else {
                return response()->json(array('status' => 'error', 'message' => 'Module Permission not saved, Please try again later'));
            }
        }
        // remove permission from selected role
        else {

            $update = DB::table('permissions')
                    ->where('module_id', $formData['module_id'])
                    ->where('role_id', $formData['role_id'])
                    ->update(['deleted_at' => date('y-m-d')]);

            if ($update) {
                return response()->json(array('status' => 'success', 'message' => 'Module Permission removed successfully'));
            } else {
                return response()->json(array('status' => 'error', 'message' => 'Module Permission not removed, Please try again later'));
            }
        }
    }

}
