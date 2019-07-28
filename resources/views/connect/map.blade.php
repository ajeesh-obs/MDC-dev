@extends('layouts.app')
<style>
    .del-underscore{
        text-decoration: none !important;
    }

    #mymap {
        width: 1150px;
        height: 500px;  
    }
</style>
<script src="{{ asset('js/gmaps.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEDVd3ns05bhTmlTSlS_zopAJxkbkp5hw"></script>
<!--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCnHdUdzSaSeFuC3IfK-91bv2wpX3gB91E"></script>-->
@section('content')

<main role="main" class="container">
    <div class="px-2 py-4">
        <section class="search" style="min-height: 150px;">
            <div class="row no-gutters">
                <div class="col-4">
                    <div class="autocomplete">
                        <input id="search" type="search" class="form-control form-control-sm text-white-50 mb-2"
                               placeholder="Search Expertise">
                    </div>
                </div>
                @if($searchExpertiseArr)
                <div class="col-8">
                    @foreach($searchExpertiseArr as $expert)

                    <div class="badge badge-pill border text-white bg-color font-weight-normal h3 px-3 py-2 mr-2">
                        <a href="javascript:void()" class="text-white">&times;</a>
                        {{$expert}}
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </section>
        <section class="suggested mb-4">
            <h5 class="text-white font-weight-bold mb-2">Suggested Matches</h5>
            <div class="d-flex flex-row justify-content-between align-items-center">
                <div class="">
                    <div class="badge badge-pill border bg-color font-weight-normal px-3 p-2 mr-2">
                        <a href="javascript:void()" class="text-white del-underscore">@if($all)<span style='color:#ebc243'>Show All</span>@else Show All @endif </a>
                    </div>
                    <div class="badge badge-pill border bg-color font-weight-normal px-3 p-2 mr-2">
                        <a href="javascript:void()" class="text-white del-underscore">@if($followers)<span style='color:#ebc243'>Show Followers Only</span> @else Show Followers Only @endif </a>
                    </div>
                    <div class="badge badge-pill border bg-color font-weight-normal px-3 p-2">
                        <a href="javascript:void()" class="text-white del-underscore">@if($following)<span style='color:#ebc243'>Show Following Only</span> @else Show Following Only @endif </a>
                    </div>
                    <div class="badge badge-pill border bg-color font-weight-normal px-3 p-2">
                        <a href="{{ route('connect') }}" class="text-white del-underscore"><span style='color:red'>Close</span></a>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <i class="icon icon-search filter-white icon-24"></i>
                    <input value= "{{$searchByPersonLocationLevel}}" type="search" class="form-control form-control-sm text-white-50 ml-2" placeholder="Search by person, location or level">
                </div>
            </div>
        </section>
        <section class="map mb-4">
            <div id="mymap"></div>
            <div class="card card-dark mb-3" style="display:none;">
                <div class="card-img position-relative">


<!--<img class="w-100"-->
                    <!--src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="-->
                    <!--alt="Generic placeholder image" width="1200" height="742">-->
                    <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d23827.256641122374!2d-118.24396239727248!3d34.045326717248805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1558111508255!5m2!1sen!2sin" width="1200" height="742" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <div class="card-img-overlay text-center"
                         style="left: auto">
                        <a href="{{ route('connect') }}" class="h1 text-white-50">
                            &times;
                        </a>
                    </div>
                    <div class="card-img-overlay text-center"
                         style="top: auto; right:auto">
                        <ul class="list-unstyled">
                            <li>
                                <a href="javascript://" class="h1 text-white-50">
                                    +
                                </a>
                            </li>
                            <li>
                                <a href="javascript://" class="h1 text-white-50">
                                    -
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-img-overlay text-center w-max h-max" style="left: 50%; top: 50%; transform: translate(-50%, -50%);">
                        <a tabindex="0" id="user-pin" href="javascript://" class="h1 text-white-50" data-placement="top" data-popover-content="#user-pin-popover-content">
                            <img class="rounded-circle"
                                 src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mM0/g8AAWsBNAUUB5MAAAAASUVORK5CYII="
                                 width="24" height="24">
                        </a>
                        <div id="user-pin-popover-content" class="d-none">
                            <div class="card bg-transparent border-0">
                                <div class="card-body px-2 py-1">
                                    <img class="rounded-circle mb-1"
                                         src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN89h8AAtEB5wrzxXEAAAAASUVORK5CYII="
                                         width="54" height="54">
                                    <div class="d-flex flex-row justify-content-between align-items-center mb-2">
                                        <h6 class="card-title text-white font-weight-bold mb-0">Username 1</h6>
                                        <a href="javascript://"
                                           class="text-uppercase text-white bg-transparent border-0 small">
                                            Following
                                        </a>
                                    </div>
                                    <h6 class="card-text text-white-50 text-left mb-2">
                                        Gratitude Expert 123
                                    </h6>
                                    <div class="card-text text-white-50 d-flex flex-row justify-content-between align-items-center">
                                        <small>Location</small>
                                        <small>Level 1</small>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        </section>
    </div>
</main>
@endsection
@section('script')
<script>
$(document).ready(function () {

    var locations = <?php print_r(json_encode($usersList)) ?>;
    var mymap = new GMaps({
        el: '#mymap',
        lat: 21.170240,
        lng: 72.831061,
        zoom: 6
    });

    $.each(locations, function (index, value) {
        if (value.userLatitude && value.userLongitude) {
            var marker = mymap.addMarker({
                lat: value.userLatitude,
                lng: value.userLongitude,
                title: value.name,
                infoWindow: {
                    content: "<div style='background-color:#000' class='user-pin-popover-content'><div class='card bg-transparent border-0'><div class='card-body px-2 py-1'>\n\
                                <img class='rounded-circle mb-1' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN89h8AAtEB5wrzxXEAAAAASUVORK5CYII=' width='54' height='54'>\n\
                                <div class='d-flex flex-row justify-content-between align-items-center mb-2'>\n\
                                <h6 class='card-title text-white font-weight-bold mb-0'>" + value.name + "</h6>\n\
                                <a class='text-uppercase text-white bg-transparent border-0 small'>" + value.followingText + "</a></div>\n\
                                <h6 class='card-text text-white-50 text-left mb-2'>" + value.expertise + "</h6>\n\
                                <div class='card-text text-white-50 d-flex flex-row justify-content-between align-items-center'><small>" + value.userLocation + "</small>\n\
                                </div></div></div></div>"
                }

            });
        }
    });
});
</script>
@endsection