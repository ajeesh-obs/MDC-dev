<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\UserDetails;
use Illuminate\Support\Facades\DB;
use Session;
use View;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\UserExpertise;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        if (Auth::user()->first_time_login) {
//        if (!Auth::user()->last_login) {
            //This will redirect the user profile edit page, if they haven't logged in before.
            return redirect()->route('profileedit');
        }

        // redirect to profile page
        return redirect()->route('myprofile');
//        return view('home');
    }

    /**
     * account settings details
     */
    public function accountSettings() {

        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $user = Auth::user();
        $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();
        $facebook_link = $twitter_link = $instagram_link = $youtube_link = $linkedin_link = "";
        if ($userDetails) {
            $facebook_link = $userDetails->facebook_link;
            $twitter_link = $userDetails->twitter_link;
            $instagram_link = $userDetails->instagram_link;
            $youtube_link = $userDetails->youtube_link;
            $linkedin_link = $userDetails->linkedin_link;
        }

        return view('accountsettings', compact('user', 'facebook_link', 'twitter_link', 'instagram_link', 'youtube_link', 'linkedin_link'));
    }

    /*
     * save account settings details
     * 
     */

    public function accountSettingsSave() {

        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $this->validate(request(), [
            'first_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // save user basic details
        $user = Auth::user();
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->password = bcrypt(request('password'));

        $user->save();

        // save user social links
        $facebook_link = request('facebook_link');
        $twitter_link = request('twitter_link');
        $instagram_link = request('instagram_link');
        $youtube_link = request('youtube_link');
        $linkedin_link = request('linkedin_link');
        if ((!empty($facebook_link)) || (!empty($twitter_link)) || (!empty($instagram_link)) || (!empty($youtube_link)) || (!empty($linkedin_link))) {

            $saveSocialLink = UserDetails::updateOrCreate(['user_id' => Auth::id()],
                            [
                                'facebook_link' => $facebook_link,
                                'twitter_link' => $twitter_link,
                                'instagram_link' => $instagram_link,
                                'youtube_link' => $youtube_link,
                                'linkedin_link' => $linkedin_link,
            ]);
        }


        return redirect()->route('accountsettings')->with('message', 'Account settings modified successfully');
    }

    /*
     * my profile page 
     * 
     */

    public function myProfile() {

        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $user = Auth::user();
        $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();
        $userExpertise = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();

        return view('myprofile', compact('user', 'userDetails', 'userExpertise'));
    }

    /*
     * my profile edit
     * 
     */

    public function myProfileEdit() {

        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $allExpertArr = array();
        $userExpertArr = array();
        $userExpertvalues = array();
        $user = Auth::user();
        $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();
        $userExpertise = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        if ($userExpertise) {
            foreach ($userExpertise as $usrExpertise) {
                $spr['expertise'] = $usrExpertise->expertise;
                $userExpertArr[] = $spr;
                $userExpertvalues[] = $usrExpertise->expertise;
            }
        }
        $userCurrentExpertise = implode(",", $userExpertvalues);

        $allExpertise = DB::table('user_expertise')->select('expertise')->distinct()->whereNull('deleted_at')->whereNotIn('expertise', $userExpertArr)->get();
        if ($allExpertise) {
            foreach ($allExpertise as $key => $allExpertise) {
                $allExpertArr[$key] = $allExpertise->expertise;
            }
        }

        $languages_spoken = $about_username = $goals_vision = $education = $certifications = $awards_honor = $conferences_events = $volunteer_activities = $hobbies_interests = $income = "";
        if ($userDetails) {
            $languages_spoken = $userDetails->languages_spoken;
            $about_username = $userDetails->about_username;
            $goals_vision = $userDetails->goals_vision;
            $education = $userDetails->education;
            $certifications = $userDetails->certifications;
            $awards_honor = $userDetails->awards_honor;
            $conferences_events = $userDetails->conferences_events;
            $volunteer_activities = $userDetails->volunteer_activities;
            $hobbies_interests = $userDetails->hobbies_interests;
            $income = $userDetails->income;
        }

        return view('myprofile_edit', compact('user', 'userDetails', 'languages_spoken', 'about_username', 'goals_vision', 'education', 'certifications', 'awards_honor', 'conferences_events', 'volunteer_activities', 'hobbies_interests', 'income', 'userExpertise', 'allExpertArr', 'userCurrentExpertise'));
    }

    /*
     * my profile edit update 
     * 
     */

    public function profileUpdate(Request $request) {

        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        if ($request->isMethod('post')) {

            $programFormData = $request->all();
            if (!empty($programFormData['income'])) {
                $validation = Validator::make($programFormData, [
                            'income' => ['numeric']
                ]);

                if ($validation->fails()) {
                    return redirect()->route('profile.edit')->withErrors($validation)->withInput();
                }
            }

            $save = UserDetails::updateOrCreate(['user_id' => Auth::id()],
                            [
                                'languages_spoken' => $programFormData['languages_spoken'],
                                'about_username' => $programFormData['about_username'],
                                'goals_vision' => $programFormData['goals_vision'],
                                'education' => $programFormData['education'],
                                'certifications' => $programFormData['certifications'],
                                'awards_honor' => $programFormData['awards_honor'],
                                'conferences_events' => $programFormData['conferences_events'],
                                'volunteer_activities' => $programFormData['volunteer_activities'],
                                'hobbies_interests' => $programFormData['hobbies_interests'],
                                'income' => $programFormData['income']
            ]);

            if ($save) {

                // check user expertise modified or not
                $modifiedExperise = $programFormData['userCurrentExpertise'];
                $userExpertvalues = array();
                $userExpertise = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
                if ($userExpertise) {
                    foreach ($userExpertise as $usrExpertise) {
                        $userExpertvalues[] = $usrExpertise->expertise;
                    }
                }
                $userCurrentExpertise = implode(",", $userExpertvalues);
                // user expertise modifed
                if ($modifiedExperise != $userCurrentExpertise) {

                    DB::table('user_expertise')->where('user_id', '=', Auth::id())->update(array('deleted_at' => date('y-m-d')));
                    // insaert new experetise
                    $userExpertiseNew = explode(",", $modifiedExperise);
                    if ($userExpertiseNew) {
                        foreach ($userExpertiseNew as $key => $value) {
                            if (!empty($value)) {
                                $saveUserExpertise = UserExpertise::create([
                                            'user_id' => Auth::id(),
                                            'expertise' => $value
                                ]);
                            }
                        }
                    }
                }
                return redirect()->route('profile.edit')->with('message', 'Profile details modified successfully');
            } else {
                return redirect()->route('profile.edit')->withErrors($validation)->withInput();
            }
        }
        return redirect()->route('profile.edit');
    }

    /*
     * mindset page 
     * 
     */

    public function mindset() {
        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }
        return view('mindset');
    }

    /*
     * after admin login pagr
     * 
     */

    public function adminHome() {

        $isadmin = session('isadmin');
        if (!empty($isadmin)) {
            $user = Auth::user();
            $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();

            return view('admin.home', compact('user', 'userDetails'));
        }
        return Redirect::to('/');
        //$message = "Page Not Found";
        //return View::make('error_user', compact('message'));
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
        return Redirect::to('/admin/dashboard');

        //$message = "Page Not Found";
        //return View::make('error_admin', compact('message'));
    }

}
