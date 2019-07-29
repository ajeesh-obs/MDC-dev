<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use App\Level;

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

        if (empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $LoginUserProfilePic = "";
        $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();
        if ($userDetails) {
            if ($userDetails->profile_pic) {
                $LoginUserProfilePic = $userDetails->profile_pic;
            }
        }
        // get unread messages 
//        $unreadMessages = $this->userService->getUnreadMessages();
//        $unreadMessagesCount = count($unreadMessages);

        $levels = DB::table('level')->whereNull('deleted_at')->where('is_default', 0)->orderBy('id', 'asc')->get();
        $levelsDefault = DB::table('level')->whereNull('deleted_at')->where('is_default', 1)->orderBy('id', 'asc')->first();

        return view('system.index', compact('levels', 'levelsDefault', 'LoginUserProfilePic'));
    }

    /*
     * create new level
     * 
     */

    public function newLevel(Request $request) {

        if ($request->isMethod('post')) {

            $formData = $request->all();
            $validation = Validator::make($formData, [
                        'title' => ['required', 'string', 'max:255'],
                        'level' => ['required', 'string', 'max:255'],
                        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'description' => ['required', 'string', 'max:8000'],
                        'price' => ['numeric'],
                        'legacy' => ['numeric'],
                        'coins' => ['numeric'],
            ]);
            if ($validation->fails()) {
                return redirect()->route('admin.system')->withErrors($validation)->withInput();
            }
            // check level alredy exists or not
            $sameExists = DB::table('level')->where([['level', '=', $formData['level']], ['deleted_at', '=', NULL]])->first();
            if ($sameExists) {
                return redirect()->route('admin.system')->withErrors("Level already exists")->withInput();
            }

            $filename = NULL;
            if (isset($formData['image'])) {
                $file = $formData['image'];
                $image_path = '';
                if ($file) {
                    $fileArray = array('image' => $file);
                    $rand = rand(11111, 99999);
                    $filename = md5(Auth::id() . '-' . strtotime(date('Y-m-d H:i:s')) . $rand) . '.' . $file->getClientOriginalExtension();
                    $thumbFilename = 'thumbnail_' . md5(Auth::id() . '-' . strtotime(date('Y-m-d H:i:s')) . $rand) . '.' . $file->getClientOriginalExtension();

                    $imagePath = 'images/level/' . $filename;
                    $thumbImagePath = 'images/level/' . $thumbFilename;

                    $image = Image::make($file->getRealPath());
                    $image->save($imagePath);
                    $image->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbImagePath);
                }
            }
            // save new level 
            $save = Level::create([
                        'title' => $formData['title'],
                        'level' => $formData['level'],
                        'price' => $formData['price'],
                        'legacy' => $formData['legacy'],
                        'coins' => $formData['coins'],
                        'description' => $formData['description'],
                        'discount_code' => $formData['discount_code'],
                        'badge' => $filename,
            ]);

            if ($save) {
                return redirect()->route('admin.system')->with('message', 'Level saved successfully');
            } else {
                return redirect()->route('admin.system')->withErrors($validation)->withInput();
            }
        }
        return redirect()->route('admin.system');
    }

    /*
     * update deafult level
     * 
     */

    public function updateDefaultLevel(Request $request) {

        if ($request->isMethod('post')) {

            $formData = $request->all();
            $validation = Validator::make($formData, [
//                        'title' => ['required', 'string', 'max:255'],
                        'defaultLevel' => ['required', 'string', 'max:255'],
                        'defaultimage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'defaultDescription' => ['required', 'string', 'max:8000'],
                        'defaultPrice' => ['numeric'],
//                        'legacy' => ['numeric'],
//                        'coins' => ['numeric'],
            ]);
            if ($validation->fails()) {
                return redirect()->route('admin.system')->withErrors($validation)->withInput();
            }

            $update = DB::table('level')->where('is_default', '=', 1)->update(
                    array(
                        'title' => $formData['defaultTitle'],
                        'level' => $formData['defaultLevel'],
                        'price' => $formData['defaultPrice'],
                        'description' => $formData['defaultDescription'],
                        'discount_code' => $formData['defaultDiscountCode'],
                    )
            );
            //if ($update) {
            // upload image if exists
            $filename = NULL;
            if (isset($formData['defaultimage'])) {
                $file = $formData['defaultimage'];
                $image_path = '';
                if ($file) {
                    $fileArray = array('image' => $file);
                    $rand = rand(11111, 99999);
                    $filename = md5(Auth::id() . '-' . strtotime(date('Y-m-d H:i:s')) . $rand) . '.' . $file->getClientOriginalExtension();
                    $thumbFilename = 'thumbnail_' . md5(Auth::id() . '-' . strtotime(date('Y-m-d H:i:s')) . $rand) . '.' . $file->getClientOriginalExtension();

                    $imagePath = 'images/level/' . $filename;
                    $thumbImagePath = 'images/level/' . $thumbFilename;

                    $image = Image::make($file->getRealPath());
                    $image->save($imagePath);
                    $image->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($thumbImagePath);
                }
            }

            if (!empty($filename)) {
                DB::table('level')->where('is_default', '=', 1)->update(array('badge' => $filename));
            }
            return redirect()->route('admin.system')->with('message', 'Level modified successfully');
//            } else {
//                return redirect()->route('admin.system')->withErrors($validation)->withInput();
//            }
        }
        return redirect()->route('admin.system');
    }

    /*
     * delete level
     * 
     */

    public function deleteLevel($id) {
        $selData = DB::table('level')->where('id', '=', $id)->first();
        if ($selData) {

            DB::table('level')->where('id', '=', $id)->update(array('deleted_at' => date('y-m-d')));
            return response()->json(array('status' => true, 'message' => 'Level deleted successfully'));
        }
        return response()->json(false, 401);
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
    }

}
