<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\UsersFollowing;
use Session;
use App\Services\UserService;

class ConnectController extends Controller {

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
    public function index(Request $request) {

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

        $allExpertArr = array();
        $usersList = [];
        $allExpertise = DB::table('user_expertise')->select('expertise')->distinct()->whereNull('deleted_at')->get();
        if ($allExpertise) {
            foreach ($allExpertise as $key => $allExpertise) {
                $allExpertArr[$key] = $allExpertise->expertise;
            }
        }

        // check the request coming from header user search or not
        $keyword = $request->searchData;
        if (!empty($keyword)) {

            $usersData = User::select('user_details.profile_pic', 'users.first_name', 'users.last_name', 'users.id')
                            ->leftjoin('user_details', 'user_details.user_id', '=', 'users.id')
                            ->where('users.deleted_at', '=', NULL)
                            ->where('users.is_active', '=', 1)
                            ->where('users.id', '!=', Auth::id())
                            ->where('users.id', '!=', $this->superAdminId) // avoid super admin 
                            ->where(function($query) use($keyword) {
                                $query->where('first_name', 'LIKE', "%$keyword%")
                                ->orWhere('last_name', 'LIKE', "%$keyword%");
                            })
//                            ->where('first_name', 'LIKE', "%$keyword%")->orWhere('last_name', 'LIKE', "%$keyword%")
//                            ->where('first_name', 'LIKE', "%$keyword%")
                            ->orderBy('users.id', 'DESC')->get();

            if ($usersData) {
                foreach ($usersData as $data) {
                    // get user expertises 
                    $userExpertvalues = array();
                    $userExpertise = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', $data->id)->orderBy('id', 'desc')->get();
                    if ($userExpertise) {
                        foreach ($userExpertise as $usrExpertise) {
                            $userExpertvalues[] = $usrExpertise->expertise;
                        }
                    }
                    $userCurrentExpertise = implode(", ", $userExpertvalues);
                    // get followers count
                    $followersCount = UsersFollowing::where('following_user_id', '=', $data->id)->count();
                    // check logged user follow users
                    $isFollowing = 0;
                    $followExists = DB::table('users_following')->where([['user_id', '=', Auth::id()], ['following_user_id', '=', $data->id]])->first();
                    if ($followExists) {
                        $isFollowing = 1;
                    }
                    // get lastest following list
                    $latestFollowings = UsersFollowing::select('user_details.profile_pic', 'users.first_name', 'users.last_name')
                            ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.following_user_id')
                            ->leftjoin('users', 'users.id', '=', 'users_following.following_user_id')
                            ->where('users_following.user_id', '=', $data->id)
                            ->orderBy('users_following.id', 'DESC')
                            ->take(5)
                            ->get();

                    $res['id'] = $data->id;
                    $res['image'] = $data->profile_pic;
                    $res['name'] = $data->first_name . " " . $data->last_name;
                    $res['expertise'] = $userCurrentExpertise;
                    $res['followersCount'] = $followersCount;
                    $res['isFollowing'] = $isFollowing;
                    $res['latestFollowings'] = $latestFollowings;
                    $usersList[] = $res;
                }
            }
        }
        // get Show All as default
        else {
            $getData = User::select('user_details.profile_pic', 'users.first_name', 'users.last_name', 'users.id')
                            ->leftjoin('user_details', 'user_details.user_id', '=', 'users.id')
                            ->where('users.deleted_at', '=', NULL)
                            ->where('users.is_active', '=', 1)
                            ->where('users.id', '!=', Auth::id())
                            ->where('users.id', '!=', $this->superAdminId) // avoid super admin 
                            ->orderBy('users.id', 'DESC')->get();
            if ($getData) {
                foreach ($getData as $data) {

                    // get user expertises 
                    $userExpertvalues = array();
                    $userExpertise = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', $data->id)->orderBy('id', 'desc')->get();
                    if ($userExpertise) {
                        foreach ($userExpertise as $usrExpertise) {
                            $userExpertvalues[] = $usrExpertise->expertise;
                        }
                    }
                    $userCurrentExpertise = implode(", ", $userExpertvalues);
                    // get followers count
                    $followersCount = UsersFollowing::where('following_user_id', '=', $data->id)->count();
                    // check logged user follow users
                    $isFollowing = 0;
                    $followExists = DB::table('users_following')->where([['user_id', '=', Auth::id()], ['following_user_id', '=', $data->id]])->first();
                    if ($followExists) {
                        $isFollowing = 1;
                    }
                    // get lastest following list
                    $latestFollowings = UsersFollowing::select('user_details.profile_pic', 'users.first_name', 'users.last_name')
                            ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.following_user_id')
                            ->leftjoin('users', 'users.id', '=', 'users_following.following_user_id')
                            ->where('users_following.user_id', '=', $data->id)
                            ->orderBy('users_following.id', 'DESC')
                            ->take(5)
                            ->get();

                    $res['id'] = $data->id;
                    $res['image'] = $data->profile_pic;
                    $res['name'] = $data->first_name . " " . $data->last_name;
                    $res['expertise'] = $userCurrentExpertise;
                    $res['followersCount'] = $followersCount;
                    $res['isFollowing'] = $isFollowing;
                    $res['latestFollowings'] = $latestFollowings;
                    $usersList[] = $res;
                }
            }
        }

        return view('connect.index', compact('allExpertArr', 'usersList', 'LoginUserProfilePic', 'unreadMessages', 'unreadMessagesCount', 'latestFollowers', 'unreadNotifications'));
    }

    /*
     * connect search functionality 
     * 
     */

    public function search(Request $request) {

        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $list = "";
        $formData = $request->all();
        $all = $formData['all'];
        $followers = $formData['followers'];
        $following = $formData['following'];
        $userCurrentExpertise = $formData['userCurrentExpertise'];
        $searchByPersonLocationLevel = $formData['searchByPersonLocationLevel'];

        // search values put on session for map view 
        Session::put('connectAll', $all);
        Session::put('connectFollowers', $followers);
        Session::put('connectFollowing', $following);
        Session::put('connectUserCurrentExpertise', $userCurrentExpertise);
        Session::put('connectSearchByPersonLocationLevel', $searchByPersonLocationLevel);

        // get search list
        $usersList = $this->getList($all, $followers, $following, $userCurrentExpertise, $searchByPersonLocationLevel);

        $list = view('connect.search_list', compact('usersList'));
        return $list;
    }

    /*
     * map view
     * 
     */

    public function mapView(Request $request) {

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

        // get session values for map view 
        $all = session('connectAll');
        $followers = session('connectFollowers');
        $following = session('connectFollowing');
        $userCurrentExpertise = session('connectUserCurrentExpertise');
        $searchByPersonLocationLevel = session('connectSearchByPersonLocationLevel');
        // set default as view all
        if ((empty($all)) && (empty($followers)) && (empty($following))) {
            $all = 1;
        }
        $usersList = $this->getList($all, $followers, $following, $userCurrentExpertise, $searchByPersonLocationLevel);

        // clear session values 
        $request->session()->forget('connectAll');
        $request->session()->forget('connectFollowers');
        $request->session()->forget('connectFollowing');
        $request->session()->forget('connectUserCurrentExpertise');
        $request->session()->forget('connectSearchByPersonLocationLevel');

        $searchExpertiseArr = "";
        if (!empty($userCurrentExpertise)) {
            $searchExpertiseArr = explode(",", $userCurrentExpertise);
        }

        return view('connect.map', compact('LoginUserProfilePic', 'unreadNotifications', 'latestFollowers', 'unreadMessages', 'unreadMessagesCount', 'usersList', 'all', 'followers', 'following', 'searchExpertiseArr', 'searchByPersonLocationLevel'));
    }

    /*
     * get search list 
     * 
     */

    private function getList($all = '', $followers = '', $following = '', $userCurrentExpertise = '', $searchByPersonLocationLevel = '') {

        $usersList = [];
        $searchExpertiseArr = "";
        if (!empty($userCurrentExpertise)) {
            $searchExpertiseArr = explode(",", $userCurrentExpertise);
        }

        // Show All
        if (!empty($all)) {

            $getData = User::select('user_details.profile_pic', 'users.first_name', 'users.last_name', 'users.id')
                    ->leftjoin('user_details', 'user_details.user_id', '=', 'users.id')
                    ->where('users.deleted_at', '=', NULL)
                    ->where('users.is_active', '=', 1)
                    ->where('users.id', '!=', Auth::id())
                    ->where('users.id', '!=', $this->superAdminId) // avoid super admin 
            ;

            if (!empty($searchByPersonLocationLevel)) {
                $getData->where(function($query) use($searchByPersonLocationLevel) {
                    $query->where('first_name', 'LIKE', "%$searchByPersonLocationLevel%")
                            ->orWhere('last_name', 'LIKE', "%$searchByPersonLocationLevel%");
                });
            }
            $getData = $getData->orderBy('users.id', 'DESC')->get();
            if ($getData) {
                foreach ($getData as $data) {

                    $isValidData = 1;
                    // apply expertise search
                    if (!empty($searchExpertiseArr)) {
                        $isValidData = 0;
                    }

                    // get user expertises 
                    $userExpertvalues = array();
                    $userExpertise = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', $data->id)->orderBy('id', 'desc')->get();
                    if ($userExpertise) {
                        foreach ($userExpertise as $usrExpertise) {
                            $userExpertvalues[] = $usrExpertise->expertise;

                            if (!empty($searchExpertiseArr)) {
                                if (in_array($usrExpertise->expertise, $searchExpertiseArr)) {
                                    $isValidData = 1;
                                }
                            }
                        }
                    }
                    $userCurrentExpertise = implode(", ", $userExpertvalues);
                    // get followers count
                    $followersCount = UsersFollowing::where('following_user_id', '=', $data->id)->count();
                    // check logged user follow users
                    $isFollowing = 0;
                    $followExists = DB::table('users_following')->where([['user_id', '=', Auth::id()], ['following_user_id', '=', $data->id]])->first();
                    if ($followExists) {
                        $isFollowing = 1;
                    }
                    // get lastest following list
                    $latestFollowings = UsersFollowing::select('user_details.profile_pic', 'users.first_name', 'users.last_name')
                            ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.following_user_id')
                            ->leftjoin('users', 'users.id', '=', 'users_following.following_user_id')
                            ->where('users_following.user_id', '=', $data->id)
                            ->orderBy('users_following.id', 'DESC')
                            ->take(5)
                            ->get();

                    // get location details
                    $userLocation = '';
                    $userLatitude = '';
                    $userLongitude = '';
                    $userLocationData = DB::table('user_last_locations')->where('user_id', $data->id)->orderBy('id', 'desc')->first();
                    if ($userLocationData) {
                        $userLocation = $userLocationData->location;
                        $userLatitude = $userLocationData->latitude;
                        $userLongitude = $userLocationData->longitude;
                    }

                    if ($isValidData == 1) {
                        $res['id'] = $data->id;
                        $res['image'] = $data->profile_pic;
                        $res['name'] = $data->first_name . " " . $data->last_name;
                        $res['expertise'] = $userCurrentExpertise;
                        $res['followersCount'] = $followersCount;
                        $res['isFollowing'] = $isFollowing;
                        $res['latestFollowings'] = $latestFollowings;

                        $res['userLocation'] = $userLocation;
                        $res['userLatitude'] = $userLatitude;
                        $res['userLongitude'] = $userLongitude;
                        $res['followingText'] = $isFollowing == 1 ? 'FOLLOWING' : '';
//                        $res['imageMap'] = $data->profile_pic ? \URL::to('') . '/images/profile/' . $data->profile_picr : \URL::to('') . '/images/profile/no-profile.png';


                        $usersList[] = $res;
                    }
                }
            }
        }
        // Show Followers Only 
        else if (!empty($followers)) {

            $followersData = UsersFollowing::select('user_details.profile_pic', 'users.id', 'users.first_name', 'users.last_name')
                    ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.user_id')
                    ->leftjoin('users', 'users.id', '=', 'users_following.user_id')
                    ->where('users_following.following_user_id', '=', Auth::id())
//                    ->where('users_following.following_user_id', '!=', $this->superAdminId) // avoid super admin 
            ;
            if (!empty($searchByPersonLocationLevel)) {
                $followersData->where(function($query) use($searchByPersonLocationLevel) {
                    $query->where('first_name', 'LIKE', "%$searchByPersonLocationLevel%")
                            ->orWhere('last_name', 'LIKE', "%$searchByPersonLocationLevel%");
                });
            }
            $followersData = $followersData->orderBy('users_following.id', 'DESC')->get();

            if ($followersData) {
                foreach ($followersData as $data) {

                    $isValidData = 1;
                    // apply expertise search
                    if (!empty($searchExpertiseArr)) {
                        $isValidData = 0;
                    }

                    // get user expertises 
                    $userExpertvalues = array();
                    $userExpertise = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', $data->id)->orderBy('id', 'desc')->get();
                    if ($userExpertise) {
                        foreach ($userExpertise as $usrExpertise) {
                            $userExpertvalues[] = $usrExpertise->expertise;

                            if (!empty($searchExpertiseArr)) {
                                if (in_array($usrExpertise->expertise, $searchExpertiseArr)) {
                                    $isValidData = 1;
                                }
                            }
                        }
                    }
                    $userCurrentExpertise = implode(", ", $userExpertvalues);
                    // get followers count
                    $followersCount = UsersFollowing::where('following_user_id', '=', $data->id)->count();
                    // check logged user follow users
                    $isFollowing = 0;
                    $followExists = DB::table('users_following')->where([['user_id', '=', Auth::id()], ['following_user_id', '=', $data->id]])->first();
                    if ($followExists) {
                        $isFollowing = 1;
                    }
                    // get lastest following list
                    $latestFollowings = UsersFollowing::select('user_details.profile_pic', 'users.first_name', 'users.last_name')
                            ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.following_user_id')
                            ->leftjoin('users', 'users.id', '=', 'users_following.following_user_id')
                            ->where('users_following.user_id', '=', $data->id)
                            ->orderBy('users_following.id', 'DESC')
                            ->take(5)
                            ->get();

                    // get location details
                    $userLocation = '';
                    $userLatitude = '';
                    $userLongitude = '';
                    $userLocationData = DB::table('user_last_locations')->where('user_id', $data->id)->orderBy('id', 'desc')->first();
                    if ($userLocationData) {
                        $userLocation = $userLocationData->location;
                        $userLatitude = $userLocationData->latitude;
                        $userLongitude = $userLocationData->longitude;
                    }

                    if ($isValidData == 1) {
                        $res['id'] = $data->id;
                        $res['image'] = $data->profile_pic;
                        $res['name'] = $data->first_name . " " . $data->last_name;
                        $res['expertise'] = $userCurrentExpertise;
                        $res['followersCount'] = $followersCount;
                        $res['isFollowing'] = $isFollowing;
                        $res['latestFollowings'] = $latestFollowings;

                        $res['userLocation'] = $userLocation;
                        $res['userLatitude'] = $userLatitude;
                        $res['userLongitude'] = $userLongitude;
                        $res['followingText'] = $isFollowing == 1 ? 'FOLLOWING' : '';
//                        $res['imageMap'] = $data->profile_pic ? \URL::to('') . '/images/profile/' . $data->profile_picr : \URL::to('') . '/images/profile/no-profile.png';

                        $usersList[] = $res;
                    }
                }
            }
        }
        //Show Following Only 
        else if (!empty($following)) {

            $followingData = UsersFollowing::select('user_details.profile_pic', 'users.id', 'users.first_name', 'users.last_name')
                    ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.following_user_id')
                    ->leftjoin('users', 'users.id', '=', 'users_following.following_user_id')
                    ->where('users_following.user_id', '=', Auth::id())
//                    ->where('users_following.user_id', '!=', $this->superAdminId) // avoid super admin 
            ;
            if (!empty($searchByPersonLocationLevel)) {
                $followingData->where(function($query) use($searchByPersonLocationLevel) {
                    $query->where('first_name', 'LIKE', "%$searchByPersonLocationLevel%")
                            ->orWhere('last_name', 'LIKE', "%$searchByPersonLocationLevel%");
                });
            }
            $followingData = $followingData->orderBy('users_following.id', 'DESC')->get();

            if ($followingData) {
                foreach ($followingData as $data) {

                    $isValidData = 1;
                    // apply expertise search
                    if (!empty($searchExpertiseArr)) {
                        $isValidData = 0;
                    }

                    // get user expertises 
                    $userExpertvalues = array();
                    $userExpertise = DB::table('user_expertise')->whereNull('deleted_at')->where('user_id', $data->id)->orderBy('id', 'desc')->get();
                    if ($userExpertise) {
                        foreach ($userExpertise as $usrExpertise) {
                            $userExpertvalues[] = $usrExpertise->expertise;
                            if (!empty($searchExpertiseArr)) {
                                if (in_array($usrExpertise->expertise, $searchExpertiseArr)) {
                                    $isValidData = 1;
                                }
                            }
                        }
                    }
                    $userCurrentExpertise = implode(", ", $userExpertvalues);
                    // get followers count
                    $followersCount = UsersFollowing::where('following_user_id', '=', $data->id)->count();
                    // check logged user follow users
                    $isFollowing = 0;
                    $followExists = DB::table('users_following')->where([['user_id', '=', Auth::id()], ['following_user_id', '=', $data->id]])->first();
                    if ($followExists) {
                        $isFollowing = 1;
                    }
                    // get lastest following list
                    $latestFollowings = UsersFollowing::select('user_details.profile_pic', 'users.first_name', 'users.last_name')
                            ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.following_user_id')
                            ->leftjoin('users', 'users.id', '=', 'users_following.following_user_id')
                            ->where('users_following.user_id', '=', $data->id)
                            ->orderBy('users_following.id', 'DESC')
                            ->take(5)
                            ->get();

                    // get location details
                    $userLocation = '';
                    $userLatitude = '';
                    $userLongitude = '';
                    $userLocationData = DB::table('user_last_locations')->where('user_id', $data->id)->orderBy('id', 'desc')->first();
                    if ($userLocationData) {
                        $userLocation = $userLocationData->location;
                        $userLatitude = $userLocationData->latitude;
                        $userLongitude = $userLocationData->longitude;
                    }

                    if ($isValidData == 1) {
                        $res['id'] = $data->id;
                        $res['image'] = $data->profile_pic;
                        $res['name'] = $data->first_name . " " . $data->last_name;
                        $res['expertise'] = $userCurrentExpertise;
                        $res['followersCount'] = $followersCount;
                        $res['isFollowing'] = $isFollowing;
                        $res['latestFollowings'] = $latestFollowings;

                        $res['userLocation'] = $userLocation;
                        $res['userLatitude'] = $userLatitude;
                        $res['userLongitude'] = $userLongitude;
                        $res['followingText'] = $isFollowing == 1 ? 'FOLLOWING' : '';
//                        $res['imageMap'] = $data->profile_pic ? \URL::to('') . '/images/profile/' . $data->profile_picr : \URL::to('') . '/images/profile/no-profile.png';

                        $usersList[] = $res;
                    }
                }
            }
        }
        return $usersList;
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
    }

}
