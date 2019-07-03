<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Module;

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

}
