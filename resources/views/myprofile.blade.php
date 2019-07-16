@extends('layouts.app')

@section('content')

<main role="main" class="container">
    <div class="jumbotron p-3 pt-5 mb-0 text-white rounded-0">
        <div class="d-flex">
            <div class="flex-fill">
                <div class="d-flex flex-row align-items-center">
                    <div class="text-center mr-4">
                        <div class="bg-cover bg-center rounded-circle mb-3 position-relative"
                             style="background-image: url('/img/profile6.jpg'); width: 260px; height: 260px;">
                            <a tabindex="0" href="javascript://" class="position-absolute" data-toggle="popover"
                               data-placement="bottom" title="Level 3: Lorem ipsum"
                               data-content="<a class='small text-muted' href='#'>LEARN MORE</a>"
                               style="bottom: 0; left: 0">
                                <img src="{{ asset('img/badge-coach.png') }}" height="100">
                            </a>
                        </div>
                        <p class="mb-0">
                            <i class="icon icon-placeholder"></i>
                            @if( !empty($userLocation->location)) {{ $userLocation->location }} @endif
                            <!--Detroit, MI, United States-->
                        </p>
                        <p class="text-muted mb-0">Eastern Timezone</p>
                    </div>
                    <div class="flex-fill mr-3">
                        <div class="row">
                            <div class="col-5">
                                <h1 class="mb-2">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                                <p>Occupation Title</p>
                            </div>
                            <div class="col-7">
                                <ul class="list-inline mb-0 social-menu">
                                    <li class="list-inline-item mr-0">
                                        <a data-toggle="tooltip" data-placement="top" title="Share Profile to Social media" target="_blank" @if( !empty($userDetails->facebook_link)) href="{{$userDetails->facebook_link}}" @endif>
                                           <i class="icon icon-social filter-gold"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a data-toggle="tooltip" data-placement="top"title="Share Profile to Social media" target="_blank" @if( !empty($userDetails->twitter_link)) href="{{$userDetails->twitter_link}}" @endif>
                                           <i class="icon icon-social filter-gold"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a data-toggle="tooltip" data-placement="top" title="Share Profile to Social media" target="_blank" @if( !empty($userDetails->instagram_link)) href="{{$userDetails->instagram_link}}" @endif>
                                           <i class="icon icon-social filter-gold"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <a data-toggle="tooltip" data-placement="top" title="Share Profile to Social media" target="_blank" @if( !empty($userDetails->youtube_link)) href="{{$userDetails->youtube_link}}" @endif>
                                           <i class="icon icon-social filter-gold"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a data-toggle="tooltip" data-placement="top" title="Share Profile to Social media" target="_blank" @if( !empty($userDetails->linkedin_link)) href="{{$userDetails->linkedin_link}}" @endif>
                                           <i class="icon icon-social filter-gold"></i>
                                        </a>
                                    </li>
                                </ul>
                                <p>
                                    <a href="#" class="text-white text-underline">www.website.com</a>
                                </p>
                            </div>
                        </div>
                        <h3 class="accent-color font-weight-bold">Expertise</h3>
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
<!--                            <div class="col-7">
                                <ul class="list-unstyled">
                                    <li>Marketing</li>   
                                </ul>
                            </div>-->
                        </div>
                        <ul class="list-inline mb-4">
                            <li class="accent-color font-weight-bold">Languages Spoken</li>
                            <li class="list-inline-item">@if( !empty($userDetails->languages_spoken)) {{ $userDetails->languages_spoken }} @endif</li>
                        </ul>
                        <a href="{{ route('myprofile.edit') }}" class="btn btn-outline-warning rounded-pill w-50 accent">
                            Edit Profile </a>
                    </div>
                </div>
            </div>
            <div class="border-left pl-3 d-flex flex-column justify-content-between">
                <ul class="list-group mb-5">
                    <li class="bg-transparent border-0 px-0 py-0 list-group-item d-flex align-items-center">
                        <a id="appointment-scheduling" href="javascript://" class="stretched-link"
                           data-placement="left" tabindex="1"
                           data-popover-content="#appointment-scheduling-popover-content">
                        </a>
                        <div id="appointment-scheduling-popover-content" class="d-none">
                            <div>Paste your calendly link here</div>
                            <input type='text'>
                            <div class='text-muted'>Don't have a calendly link?</div>
                            <a class='text-dark font-weight-bold' href='#'>Sign up for a free account here</a>
                        </div>
                        <img src="{{ asset('img/badge-coach.png') }}" height="48" class="mr-2">
                        <h3 class="text-white">Enable Appointment Scheduling</h3>
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
                            <p class="mb-2">Followers . 105</p>
                        </div>
                        <div class="col ml-auto">
                            <a href=".multi-collapse" class="small text-muted float-right dropdown-toggle"
                               role="button" aria-controls="multiCollapseExample1 multiCollapseExample2"
                               data-toggle="collapse" aria-expanded="false">VIEW ALL</a>
                        </div>
                    </div>
                    <ul class="list-inline d-flex flex-row justify-content-between mb-2">
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
                        </li>
                        <li class="list-inline-item">
                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                 alt="Generic placeholder image" width="50" height="50">
                        </li>
                    </ul>
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <ul class="list-inline d-flex flex-row justify-content-between mb-2">
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
                            </li>
                            <li class="list-inline-item">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                     alt="Generic placeholder image" width="50" height="50">
                            </li>
                        </ul>
                    </div>
                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <ul class="list-inline d-flex flex-row justify-content-between mb-2">
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
                            </li>
                            <li class="list-inline-item">
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                     alt="Generic placeholder image" width="50" height="50">
                            </li>
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
                    <h2>About Username</h2>
                    <p>
                        @if( !empty($userDetails->about_username)) {{ $userDetails->about_username }} @endif
                    </p>
                </section>
                <section class="mb-5">
                    <h2>Classes Currently Enrolled</h2>
                    <ul class="list-unstyled p">
                        <li>Sample One</li>
                        <li>Sample Two</li>
                        <li>Sample Three</li>
                    </ul>
                </section>
                <section class="mb-5">
                    <h2>Goals & Vision</h2>
                    <p>
                        @if( !empty($userDetails->goals_vision)) {{ $userDetails->goals_vision }} @endif
                    </p>
                </section>
                <section class="mb-5">
                    <h2>Education</h2>
                    <ul class="list-unstyled p">
                        <li> @if( !empty($userDetails->education)) {{ $userDetails->education }} @endif </li>
                    </ul>
                </section>
                <section class="mb-5">
                    <h2>Certifications</h2>
                    <ul class="list-unstyled p">
                        <li>@if( !empty($userDetails->certifications)) {{ $userDetails->certifications }} @endif</li>
                    </ul>
                </section>
                <section class="mb-5">
                    <h2>Awards And Honors</h2>
                    <ul class="list-unstyled p">
                        <li>@if( !empty($userDetails->awards_honor)) {{ $userDetails->awards_honor }} @endif </li>
                    </ul>
                </section>
                <section class="mb-5">
                    <h2>Conferences And Events</h2>
                    <ul class="list-unstyled p">
                        <li>@if( !empty($userDetails->conferences_events)) {{ $userDetails->conferences_events }} @endif </li>
                    </ul>
                </section>
                <section class="mb-5">
                    <h2>Volunteer Activities</h2>
                    <ul class="list-unstyled p">
                        <li>@if( !empty($userDetails->volunteer_activities)) {{ $userDetails->volunteer_activities }} @endif </li>
                    </ul>
                </section>
                <section class="mb-5">
                    <h2>Hobbies And Interests</h2>
                    <ul class="list-unstyled p">
                        <li>@if( !empty($userDetails->hobbies_interests)) {{ $userDetails->hobbies_interests }} @endif </li>
                    </ul>
                </section>
                <section class="mb-5">
                    <h2>Income</h2>
                    <p>
                        @if( !empty($userDetails->income)) ${{ number_format($userDetails->income, 2) }} @endif  
                    </p>
                </section>
            </div>
            <div class="col-5">
                <section class="mb-5">
                    <h2 class="mb-3">Groups Enrolled In</h2>
                    <ul class="list-unstyled text-white small mb-4">
                        <li class="font-weight-bold mb-1">
                            <i class="icon icon-mastermind filter-gold"></i> MASTERMIND
                        </li>
                        <li class="small">
                            Mastermind Group 1
                        </li>
                    </ul>
                    <ul class="list-unstyled text-white small">
                        <li class="font-weight-bold mb-1">
                            <i class="icon icon-masterclass filter-gold"></i> MASTERCLASS
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
                    <h2 class="mb-3">Recent Activity</h2>
                    <ul class="list-unstyled text-white small mb-4">
                        <li class="font-weight-bold mb-1">
                            <i class="icon icon-mindset filter-gold"></i> MINDSET
                        </li>
                        <li>
                            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                 alt="Generic placeholder image" width="250" height="130">
                        </li>
                    </ul>
                    <ul class="list-unstyled text-white small mb-4">
                        <li class="font-weight-bold mb-1">
                            <i class="icon icon-mastermind filter-gold"></i> MASTERMIND
                        </li>
                        <li>
                            <span class="small text-muted mb-1 d-inline-block">John Doe asked a question</span>
                            <p>
                                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud?"
                            </p>
                        </li>
                    </ul>
                    <ul class="list-unstyled text-white mb-4">
                        <li>
                            <i class="icon icon-mastermind filter-gold"></i>
                            John Doe started following <a href="#" class="text-white text-underline font-weight-bold">Username</a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-block btn-outline-warning rounded-pill accent">
                        Load More</a>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
