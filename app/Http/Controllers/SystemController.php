<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /*
     * system landing page
     * 
     */

    public function index(Request $request) {

        return view('system.index');
    }

}
