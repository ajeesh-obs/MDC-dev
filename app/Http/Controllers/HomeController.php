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
use App\UserLastLocations;

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

        $route = 'myprofile';
        // check user is logged in first or not
        if (empty(auth()->user()->last_login)) {
            $route = 'myprofile.edit';
        }
        // update last login date
        DB::table('users')->where('id', '=', Auth::id())->update(array('last_login' => date('y-m-d')));

        return redirect()->route($route);
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
        $userLocation = DB::table('user_last_locations')->where('user_id', Auth::id())->orderBy('id', 'desc')->first();

        return view('myprofile', compact('user', 'userDetails', 'userExpertise', 'userLocation'));
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

        $location = $latitude = $longitude = "";
        $userLocation = DB::table('user_last_locations')->where('user_id', Auth::id())->orderBy('id', 'desc')->first();
        if ($userLocation) {
            $location = $userLocation->location;
            $latitude = $userLocation->latitude;
            $longitude = $userLocation->longitude;
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

        return view('myprofile_edit', compact('user', 'userDetails', 'languages_spoken', 'about_username', 'goals_vision', 'education', 'certifications', 'awards_honor', 'conferences_events', 'volunteer_activities', 'hobbies_interests', 'income', 'userExpertise', 'allExpertArr', 'userCurrentExpertise', 'location', 'latitude', 'longitude'));
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

            $formData = $request->all();
            if (!empty($formData['income'])) {
                $validation = Validator::make($formData, [
                            'income' => ['numeric']
                ]);

                if ($validation->fails()) {
                    return redirect()->route('myprofile.edit')->withErrors($validation)->withInput();
                }
            }

            $save = UserDetails::updateOrCreate(['user_id' => Auth::id()],
                            [
                                'languages_spoken' => $formData['languages_spoken'],
                                'about_username' => $formData['about_username'],
                                'goals_vision' => $formData['goals_vision'],
                                'education' => $formData['education'],
                                'certifications' => $formData['certifications'],
                                'awards_honor' => $formData['awards_honor'],
                                'conferences_events' => $formData['conferences_events'],
                                'volunteer_activities' => $formData['volunteer_activities'],
                                'hobbies_interests' => $formData['hobbies_interests'],
                                'income' => $formData['income']
            ]);

            if ($save) {

                // check user expertise modified or not
                $modifiedExperise = $formData['userCurrentExpertise'];
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
                // save user location details
                if ((!empty($formData['location'])) && (!empty($formData['latitude'])) && (!empty($formData['longitude']))) {
                    $saveUserLocation = UserLastLocations::create([
                                'location' => $formData['location'],
                                'latitude' => $formData['latitude'],
                                'longitude' => $formData['longitude'],
                                'user_id' => Auth::id(),
                                'location_date' => date('y-m-d')
                    ]);
                }

                return redirect()->route('myprofile')->with('message', 'Profile details modified successfully');
            } else {
                return redirect()->route('myprofile.edit')->withErrors($validation)->withInput();
            }
        }
        return redirect()->route('myprofile.edit');
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
