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
use Intervention\Image\Facades\Image;
use App\UsersFollowing;
use App\Services\UserService;
use App\UserActivityLog;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService) {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->superAdminId = 1;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        // check email is verified or not
        if (empty(auth()->user()->email_verified_at)) {
            Auth::logout();
            return redirect()->route('login')->with('errormessage', 'Your email is not verified');
        }

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

        $LoginUserProfilePic = "";
        $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();
        if ($userDetails) {
            if ($userDetails->profile_pic) {
                $LoginUserProfilePic = $userDetails->profile_pic;
            }
        }
        // get unread messages 
        $unreadMessages = $this->userService->getUnreadMessages();
        $unreadMessagesCount = count($unreadMessages);
        // get latest followers list
        $latestFollowers = $this->userService->getLatestFollowers();
        // get unread notifiactions
        $unreadNotifications = $this->userService->getUnreadNotifications();

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

        return view('accountsettings', compact('user', 'facebook_link', 'twitter_link', 'instagram_link', 'youtube_link', 'linkedin_link', 'LoginUserProfilePic', 'unreadMessages', 'unreadMessagesCount', 'latestFollowers', 'unreadNotifications'));
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
     * users search suggestions list
     */

    public function usersSearchSuggestions(Request $request) {
        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $formData = $request->all();
        $keyword = $formData['keyword'];
        $list = "<ul id='country-list' clas='suggestion'>";
        if ($keyword) {
            // get users list from suggestions
//            $users = User::whereNull('deleted_at')->where('is_active', '=', 1)->where('id', '!=', Auth::id())->where('first_name', 'LIKE', "%$keyword%")->orWhere('last_name', 'LIKE', "%$keyword%")->orderBy('users.id', 'desc')->get();
//            $users = User::whereNull('deleted_at')->where('is_active', '=', 1)->where('id', '!=', Auth::id())->where('first_name', 'LIKE', "%$keyword%")->orderBy('users.id', 'desc')->get();
            $users = User::whereNull('deleted_at')
                    ->where('is_active', '=', 1)
                    ->where('id', '!=', Auth::id())
                    ->where('id', '!=', $this->superAdminId) // avoid super admin 
                    ->where(function($query) use($keyword) {
                        $query->where('first_name', 'LIKE', "%$keyword%")
                        ->orWhere('last_name', 'LIKE', "%$keyword%");
                    })
                    ->orderBy('users.id', 'desc')
                    ->get();


            if ($users) {
                foreach ($users as $user) {
                    $name = $user->first_name . " " . $user->last_name;
                    $list .= "<li><a  data-id= '$user->id' data-name='$name' class='userSuggesionLink getusersList' href='javascript:void(0)'>" . $user->first_name . " " . $user->last_name . "</a></li>";
                }
            }
        }
        $list .= "</ul>";
        return $list;
    }

    /*
     * view others profile 
     * 
     */

    public function usersSearchResult(Request $request) {
        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $keyword = $request->searchData;
        $userData = [];
        if ($keyword) {
            $users = User::whereNull('deleted_at')->where('is_active', '=', 1)->where('id', '!=', Auth::id())->where('first_name', 'LIKE', "%$keyword%")->orWhere('last_name', 'LIKE', "%$keyword%")->orderBy('users.id', 'desc')->get();

            if ($users) {
                foreach ($users as $user) {
                    //get user details
                    $userDetails = DB::table('user_details')->where('user_id', $user->id)->first();
                    $userExpertises = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', $user->id)->orderBy('id', 'desc')->get();
                    $userExpertvalues = array();
                    if ($userExpertises) {
                        foreach ($userExpertises as $userExpertise) {
                            $userExpertvalues[] = $userExpertise->expertise;
                        }
                    }
                    $userCurrentExpertise = implode(", ", $userExpertvalues);
                    $followersCount = UsersFollowing::where('following_user_id', '=', $user->id)->count();

//                    $latestFollowings = UsersFollowing::select('user_details.profile_pic', 'users_following.id', 'users.first_name', 'users.last_name', 'users.id as userId')
//                            ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.user_id')
//                            ->leftjoin('users', 'users.id', '=', 'users_following.user_id')
//                            ->where('users_following.user_id', '=', $user->id)
//                            ->orderBy('users_following.id', 'DESC')
//                            ->take(5)
//                            ->get();

                    $p['id'] = $user->id;
                    $p['name'] = $user->first_name . " " . $user->last_name;
                    $p['expertise'] = $userCurrentExpertise;
                    $p['followersCount'] = $followersCount;
//                    $p['latestFollowings'] = $latestFollowings;
//                    $p['latestFollowingsCount'] = count($latestFollowings);
                    $p['image'] = "";
                    if ($userDetails) {
                        $p['image'] = $userDetails->profile_pic ? $userDetails->profile_pic : '';
                    }
                    $userData[] = $p;
                }
            }
        }
//        print_r($userData); exit;
        return view('user_search_result', compact('userData'));
    }

    /*
     * others profile view 
     * 
     */

    public function otherProfileView($id = '') {

        if (!empty($this->loggedUserCheck())) {
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
        $unreadMessages = $this->userService->getUnreadMessages();
        $unreadMessagesCount = count($unreadMessages);
        // get latest followers list
        $latestFollowers = $this->userService->getLatestFollowers();
        // get unread notifiactions
        $unreadNotifications = $this->userService->getUnreadNotifications();

        $selUserId = base64_decode($id);
        // check user exists or not
        $user = DB::table('users')->where('id', $selUserId)->first();
        if (empty($user)) {
            $message = "Selected user not found";
            return View::make('error_user', compact('message'));
        }
        // check selected user active or not
        if (empty($user->is_active)) {
            $message = "Selected user not active";
            return View::make('error_user', compact('message'));
        }
        // get selected user profile details 
        $userDetails = DB::table('user_details')->where('user_id', $selUserId)->first();
        $userExpertise = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', $selUserId)->orderBy('id', 'desc')->get();
        $userLocation = DB::table('user_last_locations')->where('user_id', $selUserId)->orderBy('id', 'desc')->first();
        $following = 0;
        $followExists = DB::table('users_following')->where([['user_id', '=', Auth::id()], ['following_user_id', '=', $selUserId]])->first();
        if ($followExists) {
            $following = 1;
        }
        $latestFollowersOther = UsersFollowing::select('user_details.profile_pic', 'users_following.id', 'users.first_name', 'users.last_name')
                ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.user_id')
                ->leftjoin('users', 'users.id', '=', 'users_following.user_id')
                ->where('users_following.following_user_id', '=', $selUserId)
                ->orderBy('users_following.id', 'DESC')
                ->take(5)
                ->get();

        // get latest activity log
        $latestActivityLog = UserActivityLog::select('user_activity_log.module', 'user_activity_log.activity', 'users.first_name', 'users.last_name')
                ->leftjoin('users', 'users.id', '=', 'user_activity_log.user_id')
                ->where('user_activity_log.user_id', '=', $selUserId)
                ->orderBy('user_activity_log.id', 'DESC')
                ->take(5)
                ->get();

        $followersCount = UsersFollowing::where('following_user_id', '=', $selUserId)->count();

        return view('other_profile', compact('user', 'userDetails', 'userExpertise', 'userLocation', 'following', 'latestFollowersOther', 'followersCount', 'LoginUserProfilePic', 'latestActivityLog', 'unreadMessages', 'unreadMessagesCount', 'latestFollowers', 'unreadNotifications'));
    }

    /*
     * get all followers of a user 
     * 
     */

    public function followersAll(Request $request) {

        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $formData = $request->all();
        $id = $formData['id'];
        $followersCount = UsersFollowing::where('following_user_id', '=', $id)->count();
        $list = "";
        if ($id) {
            $followers = UsersFollowing::select('user_details.profile_pic', 'users_following.id', 'users_following.id', 'users.first_name', 'users.last_name')
                    ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.user_id')
                    ->leftjoin('users', 'users.id', '=', 'users_following.user_id')
                    ->where('users_following.following_user_id', '=', $id)
                    ->orderBy('users_following.id', 'DESC')
                    ->skip(5)
                    ->take($followersCount)
                    ->get();
            if ($followers) {
                $list = view('followers_all', compact('followers'));
            }
        }
        return $list;
    }

    /*
     * get all recent activities
     * 
     */

    public function recentActivitiesAll(Request $request) {

        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $formData = $request->all();
        $type = $formData['type'];
        if ($type == 'self') {
            $id = Auth::id();
        } else {
            $id = $formData['id'];
        }

        $count = UserActivityLog::where('user_id', '=', $id)->count();
        $list = "";
        if ($id) {
            $recentactivity = UserActivityLog::select('user_activity_log.module', 'user_activity_log.activity', 'users.first_name', 'users.last_name')
                    ->leftjoin('users', 'users.id', '=', 'user_activity_log.user_id')
                    ->where('user_activity_log.user_id', '=', $id)
                    ->orderBy('user_activity_log.id', 'DESC')
                    ->skip(5)
                    ->take($count)
                    ->get();
            if ($recentactivity) {
                if ($type == 'self') {
                    $list = view('recent_activity_all', compact('recentactivity'));
                } else {
                    $list = view('other_recent_activity_all', compact('recentactivity'));
                }
            }
        }
        return $list;
    }

    /*
     * follow user 
     * 
     */

    public function followUser(Request $request) {

        if ($request->isMethod('post')) {

            $formData = $request->all();
            $validation = Validator::make($formData, [
                        'id' => ['required'],
            ]);
            if ($validation->fails()) {
                return response()->json(array('status' => 'error', 'message' => "Form validation Failed, Please enter proper details"));
            }
            $user = User::find($formData['id']);
            if (empty($user)) {
                return response()->json(array('status' => 'error', 'message' => "Selected user details not getting, Please try again later"));
            }
            $selUserName = $user->first_name . " " . $user->last_name;
            // check user is active or not
            if (empty($user->is_active)) {
                return response()->json(array('status' => 'error', 'message' => "Selected user profile is not active"));
            }
            // check already follow or not
            $followExists = DB::table('users_following')->where([['user_id', '=', Auth::id()], ['following_user_id', '=', $formData['id']]])->first();
            if ($followExists) {
                return response()->json(array('status' => 'error', 'message' => 'Selected user already following'));
            }
            // check user id & follow id are same
            if (Auth::id() == $formData['id']) {
                return response()->json(array('status' => 'error', 'message' => 'This opeartion is not allowed'));
            }
            // save in user following
            $saveFollowing = UsersFollowing::create([
                        'user_id' => Auth::id(),
                        'following_user_id' => $formData['id'],
            ]);
            if ($saveFollowing) {
                // update useractivity 
                $this->userService->saveUserActivityLog('User Following', auth()->user()->first_name . ' ' . auth()->user()->last_name . ' started following ' . $selUserName);

                return response()->json(array('status' => 'success', 'message' => 'User following saved successfully'));
            } else {
                return response()->json(array('status' => 'error', 'message' => 'User following not saved, Please try again later'));
            }
        }
        return response()->json(array('status' => 'error', 'message' => 'Some error found, Please try again later'));
    }

    /*
     * my profile page 
     * 
     */

    public function myProfile() {

        if (!empty($this->loggedUserCheck())) {
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
        $unreadMessages = $this->userService->getUnreadMessages();
        $unreadMessagesCount = count($unreadMessages);
        // get unread notifiactions
        $unreadNotifications = $this->userService->getUnreadNotifications();

        $user = Auth::user();
        $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();
        $userExpertise = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $userLocation = DB::table('user_last_locations')->where('user_id', Auth::id())->orderBy('id', 'desc')->first();

        $latestFollowers = UsersFollowing::select('user_details.profile_pic', 'users_following.id', 'users.first_name', 'users.last_name')
                ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.user_id')
                ->leftjoin('users', 'users.id', '=', 'users_following.user_id')
                ->where('users_following.following_user_id', '=', Auth::id())
                ->orderBy('users_following.id', 'DESC')
                ->take(5)
                ->get();

        $followersCount = UsersFollowing::where('following_user_id', '=', Auth::id())->count();

        // get latest activity log
        $latestActivityLog = UserActivityLog::select('user_activity_log.module', 'user_activity_log.activity', 'users.first_name', 'users.last_name')
                ->leftjoin('users', 'users.id', '=', 'user_activity_log.user_id')
                ->where('user_activity_log.user_id', '=', Auth::id())
                ->orderBy('user_activity_log.id', 'DESC')
                ->take(5)
                ->get();

        return view('myprofile', compact('user', 'userDetails', 'userExpertise', 'userLocation', 'latestFollowers', 'followersCount', 'LoginUserProfilePic', 'latestActivityLog', 'unreadMessages', 'unreadMessagesCount', 'unreadNotifications'));
    }

    /*
     * my profile edit
     * 
     */

    public function myProfileEdit() {

        if (!empty($this->loggedUserCheck())) {
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
        $unreadMessages = $this->userService->getUnreadMessages();
        $unreadMessagesCount = count($unreadMessages);
        // get unread notifiactions
        $unreadNotifications = $this->userService->getUnreadNotifications();

        $latestFollowers = UsersFollowing::select('user_details.profile_pic', 'users_following.id', 'users.first_name', 'users.last_name')
                ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.user_id')
                ->leftjoin('users', 'users.id', '=', 'users_following.user_id')
                ->where('users_following.following_user_id', '=', Auth::id())
                ->orderBy('users_following.id', 'DESC')
                ->take(5)
                ->get();

        $followersCount = UsersFollowing::where('following_user_id', '=', Auth::id())->count();

        // get user travel plans
        $travelPlans = DB::table('travel_plans')->whereNull('deleted_at')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();

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

        $languages_spoken = $about_username = $goals_vision = $education = $certifications = $awards_honor = $conferences_events = $volunteer_activities = $hobbies_interests = $income = $profilePic = "";
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
            if (!empty($userDetails->profile_pic)) {
                $profilePic = $userDetails->profile_pic;
            }
        }
        return view('myprofile_edit', compact('user', 'userDetails', 'languages_spoken', 'about_username', 'goals_vision', 'education', 'certifications', 'awards_honor', 'conferences_events', 'volunteer_activities', 'hobbies_interests', 'income', 'userExpertise', 'allExpertArr', 'userCurrentExpertise', 'location', 'latitude', 'longitude', 'profilePic', 'latestFollowers', 'followersCount', 'LoginUserProfilePic', 'unreadMessages', 'unreadMessagesCount', 'travelPlans', 'unreadNotifications'));
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
            $validation = Validator::make($formData, [
                        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'income' => ['numeric']
            ]);
            if ($validation->fails()) {
                return redirect()->route('myprofile.edit')->withErrors($validation)->withInput();
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
                                'income' => $formData['income'],
            ]);

            if ($save) {
                // upload profile pic if exists
                $filename = NULL;
                if (isset($formData['image'])) {
                    $file = $formData['image'];
                    $image_path = '';
                    if ($file) {
                        $fileArray = array('image' => $file);
                        $rand = rand(11111, 99999);
                        $filename = md5(Auth::id() . '-' . strtotime(date('Y-m-d H:i:s')) . $rand) . '.' . $file->getClientOriginalExtension();
                        $thumbFilename = 'thumbnail_' . md5(Auth::id() . '-' . strtotime(date('Y-m-d H:i:s')) . $rand) . '.' . $file->getClientOriginalExtension();

                        $imagePath = 'images/profile/' . $filename;
                        $thumbImagePath = 'images/profile/' . $thumbFilename;

                        $image = Image::make($file->getRealPath());
                        $image->save($imagePath);
                        $image->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($thumbImagePath);
                    }
                }
                if (!empty($filename)) {
                    DB::table('user_details')->where('user_id', '=', Auth::id())->update(array('profile_pic' => $filename));
                }

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
                    $isLocationSave = 1;
                    // check location details modified or not
                    $userLastLocation = DB::table('user_last_locations')->where('user_id', Auth::id())->orderBy('id', 'desc')->first();
                    if ($userLastLocation) {
                        if (($formData['location'] == $userLastLocation->location) && ($formData['latitude'] == $userLastLocation->latitude) && ($formData['longitude'] == $userLastLocation->longitude)) {
                            $isLocationSave = 0;
                        }
                    }
                    if ($isLocationSave == 1) {
                        $saveUserLocation = UserLastLocations::create([
                                    'location' => $formData['location'],
                                    'latitude' => $formData['latitude'],
                                    'longitude' => $formData['longitude'],
                                    'user_id' => Auth::id(),
                                    'location_date' => date('y-m-d')
                        ]);
                        // update current location details in user table
                        DB::table('users')->where('id', '=', Auth::id())->update(
                                array(
                                    'current_location' => $formData['location'],
                                    'current_latitude' => $formData['latitude'],
                                    'current_longitude' => $formData['longitude'],
                                )
                        );
                    }
                }
                // update useractivity
//                $this->userService->saveUserActivityLog('Profile', 'Profile details modified');

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
        $LoginUserProfilePic = "";
        $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();
        if ($userDetails) {
            if ($userDetails->profile_pic) {
                $LoginUserProfilePic = $userDetails->profile_pic;
            }
        }
        // get unread messages 
        $unreadMessages = $this->userService->getUnreadMessages();
        $unreadMessagesCount = count($unreadMessages);
        // get latest followers list
        $latestFollowers = $this->userService->getLatestFollowers();
        // get unread notifiactions
        $unreadNotifications = $this->userService->getUnreadNotifications();

        return view('mindset', compact('LoginUserProfilePic', 'unreadMessages', 'unreadMessagesCount', 'latestFollowers', 'unreadNotifications'));
    }

    /*
     * after admin login pagr
     * 
     */

    public function adminHome() {

        $isadmin = session('isadmin');
        if (!empty($isadmin)) {

            $LoginUserProfilePic = "";
            $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();
            if ($userDetails) {
                if ($userDetails->profile_pic) {
                    $LoginUserProfilePic = $userDetails->profile_pic;
                }
            }
            // get unread messages 
            $unreadMessages = $this->userService->getUnreadMessages();
            $unreadMessagesCount = count($unreadMessages);

            $user = Auth::user();
            $userDetails = DB::table('user_details')->where('user_id', Auth::id())->first();

            return view('admin.home', compact('user', 'userDetails', 'LoginUserProfilePic', 'unreadMessages', 'unreadMessagesCount'));
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
