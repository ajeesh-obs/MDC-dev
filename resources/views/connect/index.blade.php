@extends('layouts.app')
<style>
    .del-underscore{
        text-decoration: none !important;
    }
</style>
@section('content')

<main role="main" class="container">
    <div class="px-2 py-4">
        <section class="search" style="min-height: 150px;">
            <div class="row no-gutters">
                <div class="col-4">
                    <div class="autocomplete">
                        <input id="searchExpertise" type="search" class="form-control form-control-sm text-white-50" placeholder="Search Expertise" autocomplete="off">
                    </div>
                </div>
                <div class="col-8 userExpertiseDiv">
                </div>
            </div>
        </section>
        <section class="suggested mb-4">
            <h5 class="text-white font-weight-bold mb-2">Suggested Matches</h5>
            <div class="d-flex flex-row justify-content-between align-items-center">
                <div class="">
                    <div class="badge badge-pill border bg-color font-weight-normal px-3 p-2 mr-2">
                        <a href="javascript:void()" class="text-white del-underscore" id="showAll"><span style='color:#ebc243'>Show All</span></a>
                    </div>
                    <div class="badge badge-pill border bg-color font-weight-normal px-3 p-2 mr-2">
                        <a href="javascript:void()" class="text-white del-underscore" id="showFollowersOnly">Show Followers Only</a>
                    </div>
                    <div class="badge badge-pill border bg-color font-weight-normal px-3 p-2">
                        <a href="javascript:void()" class="text-white del-underscore" id="showFollowingOnly">Show Following Only</a>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <i class="icon icon-search filter-white icon-24"></i>
                    <input type="search" id="searchByPersonLocationLevel" class="form-control form-control-sm text-white-50 ml-2" placeholder="Search by person, location or level">
                </div>
            </div>
        </section>
        <section class="map mb-4 mapDiv">
            <div class="card card-dark mb-3">
                <div class="card-img position-relative">
                    <!--<img class="w-100"-->
                    <!--src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="-->
                    <!--alt="Generic placeholder image" width="1200" height="144">-->
                    <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d23827.256641122374!2d-118.24396239727248!3d34.045326717248805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1558111508255!5m2!1sen!2sin" width="1200" height="144" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <div class="card-img-overlay text-center h-max"
                         style="left: 50%; top: 50%; transform: translate(-50%, -50%);">
                        <!--<a href="map.html">-->
                        <a href="{{ route('map.view') }}">
                            <div class="badge badge-dark px-4 py-2 rounded-pill font-weight-normal text-white">View On
                                Map
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="profiles">
            <div class="card-columns card-4">
                @if($usersList > 0) 
                @foreach($usersList as $index => $user)
                <div class="card card-light rounded-0 mb-4">
                    <div class="card-body p-3">
                        <div class="bg-cover bg-center mx-auto rounded-circle position-relative mb-3" @if ($user['image']) style="background-image: url('/images/profile/thumbnail_{{$user['image']}}');width: 140px; height: 140px;" @else style="background-image: url('/images/profile/no-profile.png'); width: 140px; height: 140px;"  @endif>
                             <a tabindex="0" href="#" class="position-absolute" data-toggle="popover" data-placement="bottom" title="Level 3: Lorem ipsum" data-content="<a class='small text-muted' href='#'>LEARN MORE</a>" style="bottom: 0; left: 0">
                                 <!--<img src="{{ asset('img/badge-coach.png') }}" height="64">-->
                            </a>
                        </div>
                        <div class="d-flex flex-row justify-content-between align-items-center mb-2">
                            <a href="{{ route('other.profile.view', array(base64_encode($user['id']))) }}" style="cursor: pointer;">
                                <h5 class="card-title font-weight-bold mb-0">{{$user['name']}}</h5>
                            </a>
                            @if($user['isFollowing']) 
                            <a tabindex="0" id="user-following" href="javascript://"
                               class="text-uppercase text-white bg-transparent border-0 small" data-placement="top" data-popover-content="#user-following-popover-content{{$user['id']}}">
                                Following
                            </a>
                            <div id="user-following-popover-content{{$user['id']}}" class="d-none">
                                <ul class="list-inline m-0 following-list d-flex flex-row-reverse">

                                    @if($user['latestFollowings']->count() > 0) 
                                    @foreach($user['latestFollowings'] as $latestFollowing)
                                    <li class="list-inline-item">
                                        <a class='' href='javascript://'>
                                            <img title="{{$latestFollowing->first_name}} {{$latestFollowing->last_name}}" class="rounded-circle" width="24" height="24" @if ($latestFollowing->profile_pic) src="{{ asset('images/profile/thumbnail_'.$latestFollowing->profile_pic) }}" @else src="{{ asset('images/profile/no-profile.png') }}" @endif>
                                        </a>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            @else 
                            <a class="text-uppercase text-white bg-transparent border-0 small">
                                Follow
                            </a>
                            @endif
                        </div>
                        <p class="card-text">
                            <b>Expertise: </b>
                            <span class="text-white-50">
                                <!--{{$user['expertise']}}--> 
                                {{ str_limit($user['expertise'], $limit = 19, $end = '...') }}
                            </span>
                        </p>
                    </div>
                    <div class="card-footer">
                        <ul class="list-inline small m-0 text-uppercase d-flex flex-row justify-content-around">
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">{{$user['followersCount']}} Followers</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route('connect.message', array(base64_encode($user['id']))) }}" class="text-muted">Messages</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <input type="hidden" name="userCurrentExpertise" id="userCurrentExpertise">
        </section>
    </div>
</main>
@endsection
@section('script')
<script>
    $(document).ready(function () {
    var expertise = @json($allExpertArr);
    if (document.getElementById("searchExpertise")) {
    autocomplete(document.getElementById("searchExpertise"), expertise);
    }
    });
    $(document).on('click', '.autocomplete-item', function (e) {
    e.preventDefault();
    var val = $("#searchExpertise").val();
    if (val) {
    addExpertise(val);
    }
    });
    $(document).on('keyup', '#searchExpertise', function (e) {
    e.preventDefault();
    var val = $("#searchExpertise").val();
    if (e.keyCode == 13 && val) {
    addExpertise(val);
    }
    });
    function addExpertise(val) {

    $(".userExpertiseDiv").append('<div class="badge badge-pill border text-white bg-color font-weight-normal h3 px-3 py-2 mr-2"><a href="javascript:void()" class="text-white userExpertise">&times;</a><span>' + val + '</span></div>');
    $("#searchExpertise").val('');
    $("#searchExpertise").focus();
    getExpertiseValues();
    }
    $(document).on('click', '.userExpertise', function (e) {
    e.preventDefault();
    $(this).parent().remove();
    getExpertiseValues();
    });
    function getExpertiseValues() {
    var values = $('.userExpertiseDiv span').map(function () {
    return $(this).text();
    }).get().join(',');
    $("#userCurrentExpertise").val(values);
    }

    $(document).on('click', '#showAll', function (e) {
    e.preventDefault();
    getList(1, 0, 0);
    });
    $(document).on('click', '#showFollowersOnly', function (e) {
    e.preventDefault();
    getList(0, 1, 0);
    });
    $(document).on('click', '#showFollowingOnly', function (e) {
    e.preventDefault();
    getList(0, 0, 1);
    });
    function getList(all = '', followers = '', following = ''){

    $("#showAll").html("Show All");
    $("#showFollowersOnly").html("Show Followers Only");
    $("#showFollowingOnly").html("Show Following Only");
    if (all == 1){
    $("#showAll").html("<span style='color:#ebc243'>Show All</span>");
    }
    else if (followers == 1){
    $("#showFollowersOnly").html("<span style='color:#ebc243'>Show Followers Only</span>");
    }
    else if (following == 1){
    $("#showFollowingOnly").html("<span style='color:#ebc243'>Show Following Only</span>");
    }

    var userCurrentExpertise = $("#userCurrentExpertise").val();
    var searchByPersonLocationLevel = $("#searchByPersonLocationLevel").val();
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: '{{ route('connect.search') }}',
    data: {'all': all, 'followers':followers, 'following':following, 'userCurrentExpertise':userCurrentExpertise, 'searchByPersonLocationLevel':searchByPersonLocationLevel},
    success: function(data){
    $(".card-columns").html(data);
    $(".mapDiv").show();
    }
    });
    }


</script>
@endsection