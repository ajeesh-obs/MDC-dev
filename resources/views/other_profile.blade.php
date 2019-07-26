@extends('layouts.app')

@section('content')

<main role="main" class="container">
    <div class="jumbotron p-3 pt-5 mb-0 text-white rounded-0">
        <div class="d-flex">
            <div class="flex-fill">
                <div class="d-flex flex-row align-items-center">
                    <div class="text-center mr-4">
                        <div class="bg-cover bg-center rounded-circle mb-3 position-relative" @if( !empty($userDetails->profile_pic)) style="background-image: url('/images/profile/thumbnail_{{$userDetails->profile_pic}}'); width: 260px; height: 260px;" @else style="background-image: url('/images/profile/no-profile.png'); width: 260px; height: 260px;"  @endif>
                             <a tabindex="0" href="javascript://" class="position-absolute" data-toggle="popover" data-placement="bottom" title="Level 3: Lorem ipsum" data-content="<a class='small text-muted' href='#'>LEARN MORE</a>" style="bottom: 0; left: 0">
                                 <!--<img src="{{ asset('img/badge-coach.png') }}" height="100">--> 
                            </a>
                        </div>
                        <p class="mb-0">
                            <i class="icon icon-placeholder"></i>
                            @if( !empty($userLocation->location)) {{ $userLocation->location }} @endif
                        </p>
                        <p class="text-muted mb-0">Eastern Timezone</p>
                    </div>
                    <div class="flex-fill mr-3">
                        <div class="row">
                            <div class="col-5">
                                <h1 class="mb-2">{{ $user->first_name }} {{ $user->last_name }}</h1>
                                <p>Occupation Title</p>
                            </div>
                            <div class="col-7">
                                <ul class="list-inline mb-0 social-menu">
                                    <li class="list-inline-item mr-0">
                                        <a data-toggle="tooltip" data-placement="top" title="Share Profile to Social media" @if( !empty($userDetails->facebook_link)) href="{{$userDetails->facebook_link}}" @endif>
                                           <i class="icon icon-social filter-gold"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a data-toggle="tooltip" data-placement="top" title="Share Profile to Social media" @if( !empty($userDetails->twitter_link)) href="{{$userDetails->twitter_link}}" @endif>
                                           <i class="icon icon-social filter-gold"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a data-toggle="tooltip" data-placement="top" title="Share Profile to Social media" @if( !empty($userDetails->instagram_link)) href="{{$userDetails->instagram_link}}" @endif>
                                           <i class="icon icon-social filter-gold"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a data-toggle="tooltip" data-placement="top" title="Share Profile to Social media" @if( !empty($userDetails->youtube_link)) href="{{$userDetails->youtube_link}}" @endif>
                                           <i class="icon icon-social filter-gold"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a data-toggle="tooltip" data-placement="top" title="Share Profile to Social media" @if( !empty($userDetails->linkedin_link)) href="{{$userDetails->linkedin_link}}" @endif>
                                           <i class="icon icon-social filter-gold"></i>
                                        </a>
                                    </li>
                                </ul>
                                <p>
                                    <a href="#" class="text-white text-underline">www.website.com</a>
                                </p>
                            </div>
                        </div>
                        <h3 class="text-white-50 font-weight-bold">Expertise</h3>
                        <div class="row">
                            <div class="col-5">
                                <ul class="list-unstyled">
                                    @if($userExpertise->count() > 0) 
                                    @foreach($userExpertise as $experise)
                                    <li>{{ $experise->expertise }} </li>   
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <ul class="list-inline mb-4">
                            <li class="accent-color font-weight-bold">Languages Spoken</li>
                            <li class="list-inline-item">@if( !empty($userDetails->languages_spoken)) {{ $userDetails->languages_spoken }} @endif</li>
                        </ul>
                        @if($following) 
                        <a href="javascript:void(0)" class="btn btn-outline-warning rounded-pill w-50 accent">
                            Following
                        </a>
                        @else 
                        <a id="followUser" data-id="{{ $user->id }}" href="javascript:void(0)" class="btn btn-outline-warning rounded-pill w-50 accent">
                            Follow
                        </a>
                        @endif

                    </div>
                </div>
            </div>
            <div class="border-left pl-3 d-flex flex-column justify-content-between">
                <ul class="list-group mb-5">
                    <li class="bg-transparent border-0 px-0 py-0 list-group-item d-flex align-items-center justify-content-between">
                        <a href="#" class="btn btn-outline-light border-white rounded-pill">
                            Make Appointment</a>
                        <a href="#" class="btn btn-outline-light border-white rounded-pill">
                            B</a>
                        <a href="#" class="btn btn-outline-light border-white rounded-pill">
                            B</a>
                    </li>
                    <li class="bg-transparent border-0 px-0 list-group-item d-flex align-items-center">
                        <img src="{{ asset('img/badge-coach.png') }}" height="48" class="mr-2">
                        <h3 class="text-white font-weight-bold">Level 3: Black Diamond</h3>
                    </li>
                    <li class="bg-transparent border-0 px-0 py-0 list-group-item d-flex align-items-center">
                        <img src="{{ asset('img/founding_members.png') }}" height="36" class="mr-2">
                        <h3 class="text-white font-weight-bold mb-0">Founding Member</h3>
                    </li>
                    <li class="bg-transparent border-0 px-0 py-2 list-group-item d-flex align-items-center">
                        <img src="{{ asset('img/legacy_champion.png') }}" height="36" class="mr-2">
                        <h3 class="text-white font-weight-bold mb-0">Legacy Champion</h3>
                    </li>
                </ul>
                <div>
                    <div class="row">
                        <div class="col">
                            <p class="mb-2">Followers . {{$followersCount}}</p>
                        </div>
                        @if($latestFollowers->count() > 0) 
                        <div class="col ml-auto">
                            <a data-id="{{ $user->id }}" href=".multi-collapse" class="small text-muted float-right dropdown-toggle viewAllFollowers"
                               role="button" aria-controls="multiCollapseExample1 multiCollapseExample2"
                               data-toggle="collapse" aria-expanded="false">VIEW ALL</a>
                        </div>
                        @endif
                    </div>
                    <ul class="list-inline d-flex flex-row justify-content-between mb-2">

                        @if($latestFollowers->count() > 0) 
                        @foreach($latestFollowers as $latestFollower)
                        <li class="list-inline-item">
                            <img title="{{$latestFollower->first_name}} {{$latestFollower->last_name}}" @if ($latestFollower->profile_pic) src="{{ asset('images/profile/thumbnail_'.$latestFollower->profile_pic) }}" @else src="{{ asset('images/profile/no-profile.png') }}" @endif
                                 alt="Generic placeholder image" width="50" height="50">
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <ul class="list-inline d-flex flex-row justify-content-between mb-2 viewAllFollowersDiv">
                            <!--  <li class="list-inline-item">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                     alt="Generic placeholder image" width="50" height="50">
                            </li>
                            <li class="list-inline-item">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                     alt="Generic placeholder image" width="50" height="50">
                            </li>
                            <li class="list-inline-item">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                     alt="Generic placeholder image" width="50" height="50">
                            </li>
                            <li class="list-inline-item">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                     alt="Generic placeholder image" width="50" height="50">
                            </li>
                            <li class="list-inline-item">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                     alt="Generic placeholder image" width="50" height="50">
                            </li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-2 py-4 ">
        <div class="row">
            <div class="col-7">
                <section class="mb-5">
                    <h2 class="text-white-50">About Username</h2>
                    <p>
                        @if( !empty($userDetails->about_username)) {{ $userDetails->about_username }} @endif
                    </p>
                </section>
                <section class="mb-5">
                    <h2 class="text-white-50">Classes Currently Enrolled</h2>
                    <ul class="list-unstyled p">
                        <li>Sample One</li>
                        <li>Sample Two</li>
                        <li>Sample Three</li>
                    </ul>
                </section>
                <section class="mb-5">
                    <h2 class="text-white-50">Goals & Vision</h2>
                    <p>
                        @if( !empty($userDetails->goals_vision)) {{ $userDetails->goals_vision }} @endif
                    </p>
                </section>
                <section class="mb-5">
                    <h2 class="text-white-50">Education</h2>
                    <ul class="list-unstyled p">
                        <li> @if( !empty($userDetails->education)) {{ $userDetails->education }} @endif </li>
                    </ul>
                </section>
            </div>
            <div class="col-5">
                <section class="mb-5">
                    <h2 class="mb-3 text-white-50">Groups Enrolled In</h2>
                    <ul class="list-unstyled text-white small mb-4">
                        <li class="font-weight-bold mb-1">
                            <i class="icon icon-mastermind filter-white"></i> MASTERMIND
                        </li>
                        <li class="small">
                            Mastermind Group 1
                        </li>
                    </ul>
                    <ul class="list-unstyled text-white small">
                        <li class="font-weight-bold mb-1">
                            <i class="icon icon-masterclass filter-white"></i> MASTERCLASS
                        </li>
                        <li class="small mb-2">
                            Masterclass Group 2
                        </li>
                        <li class="small">
                            Masterclass Group 3
                        </li>
                    </ul>
                </section>
                <section class="mb-5">
                    <h2 class="mb-3 text-white-50">Recent Activity</h2>

                    @if($latestActivityLog->count() > 0) 
                    @foreach($latestActivityLog as $activity)

                    <ul class="list-unstyled text-white mb-4">
                        <li>
                            <i class="icon icon-mastermind filter-white"></i>
                            {{$activity->activity}}
                        </li>
                    </ul>
                    @endforeach
                    @endif
                    <div class="mb-5 recentactivityDiv"></div>
                </section>
                @if($latestActivityLog->count() > 0) 
                <section class="mb-5">
                    <a data-id="{{ $user->id }}" href="javascript:void()" id="recentActivityLoadMore" class="btn btn-block btn-outline-light border-white rounded-pill">Load More</a>
                    <a href="javascript:void()" id="recentActivityLoadLess" class="btn btn-block btn-outline-light border-white rounded-pill" style="display:none;">Load Less</a>
                </section>
                @endif
            </div>
        </div>                        
    </div>
</main>
@endsection
@section('script')
<script>
    $(document).ready(function () {
    $("#followUser").click(function () {
    var id = $(this).data('id');
    if (id) {
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            type: 'post',
            url: '{{ route('user.follow') }}',
            data: {'id': id},
            success: function (data) {
            swal({
            text: data.message,
                    title: 'Success!',
                    type: data.status,
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
            })
                    if (data.status == 'success') {
            setTimeout(function () {
            window.location.reload();
            }, 1000);
            }
            }
    })
    }
    });
    $(document).on('click', '.viewAllFollowers', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    if (id){
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            type: "POST",
            url: '{{ route('user.followers.all') }}',
            data: {'id': id},
            success: function(data){
            $(".viewAllFollowersDiv").html(data);
            }
    });
    }
    });
    $(document).on('click', '#recentActivityLoadMore', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            type: "POST",
            url: '{{ route('recent.activity.all') }}',
            data: {'id':id, 'type':'other'},
            success: function (data) {
            $(".recentactivityDiv").append(data);
            $("#recentActivityLoadMore").hide();
            $("#recentActivityLoadLess").show();
            }
    });
    });
    $(document).on('click', '#recentActivityLoadLess', function (e) {
    $(".recentactivityDiv").html("");
    $("#recentActivityLoadMore").show();
    $("#recentActivityLoadLess").hide();
    });
    });
</script>
@endsection
