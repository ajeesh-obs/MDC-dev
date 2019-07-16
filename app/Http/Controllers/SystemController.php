<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
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

        $levels = DB::table('level')->whereNull('deleted_at')->orderBy('id', 'asc')->get();
        return view('system.index', compact('levels'));
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

}
