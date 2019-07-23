<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\UsersFollowing;

class ConnectController extends Controller {

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

        if (!empty($this->loggedUserCheck())) {
            return $this->errorFunction();
        }

        $allExpertArr = array();
        $allExpertise = DB::table('user_expertise')->select('expertise')->distinct()->whereNull('deleted_at')->get();
        if ($allExpertise) {
            foreach ($allExpertise as $key => $allExpertise) {
                $allExpertArr[$key] = $allExpertise->expertise;
            }
        }
        return view('connect.index', compact('allExpertArr'));
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
        $usersList = [];
        $formData = $request->all();
        $all = $formData['all'];
        $followers = $formData['followers'];
        $following = $formData['following'];
        $userCurrentExpertise = $formData['userCurrentExpertise'];
        $searchByPersonLocationLevel = $formData['searchByPersonLocationLevel'];
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
                    ->where('users.id', '!=', Auth::id());
            if (!empty($searchByPersonLocationLevel)) {
//                $getData->where('first_name', 'LIKE', "%$searchByPersonLocationLevel%")->orWhere('last_name', 'LIKE', "%$searchByPersonLocationLevel%");
                $getData->where('first_name', 'LIKE', "%$searchByPersonLocationLevel%");
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

                    if ($isValidData == 1) {
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
        }
        // Show Followers Only 
        else if (!empty($followers)) {

            $followersData = UsersFollowing::select('user_details.profile_pic', 'users.id', 'users.first_name', 'users.last_name')
                    ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.user_id')
                    ->leftjoin('users', 'users.id', '=', 'users_following.user_id')
                    ->where('users_following.following_user_id', '=', Auth::id());
            if (!empty($searchByPersonLocationLevel)) {
//                $followersData->where('first_name', 'LIKE', "%$searchByPersonLocationLevel%")->orWhere('last_name', 'LIKE', "%$searchByPersonLocationLevel%");
                $followersData->where('first_name', 'LIKE', "%$searchByPersonLocationLevel%");
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

                    if ($isValidData == 1) {
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
        }
        //Show Following Only 
        else if (!empty($following)) {

            $followingData = UsersFollowing::select('user_details.profile_pic', 'users.id', 'users.first_name', 'users.last_name')
                    ->leftjoin('user_details', 'user_details.user_id', '=', 'users_following.following_user_id')
                    ->leftjoin('users', 'users.id', '=', 'users_following.following_user_id')
                    ->where('users_following.user_id', '=', Auth::id());
            if (!empty($searchByPersonLocationLevel)) {
//                $followersData->where('first_name', 'LIKE', "%$searchByPersonLocationLevel%")->orWhere('last_name', 'LIKE', "%$searchByPersonLocationLevel%");
                $followingData->where('first_name', 'LIKE', "%$searchByPersonLocationLevel%");
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

                    if ($isValidData == 1) {
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
        }
        $list = view('connect.search_list', compact('usersList'));
        return $list;
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
