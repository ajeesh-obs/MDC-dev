@extends('layouts.app')

@section('content')
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>-->
@if (session('status'))  {{ session('status') }} @endif

<div class="jumbotron p-3 pt-5 mb-0 text-white rounded-0">
    <div class="d-flex">
        <div class="flex-fill">
            <div class="d-flex flex-row align-items-center">
                <div class="text-center mr-4">
                    <div class="bg-cover bg-center rounded-circle mb-3 position-relative"
                         style="background-image: url('img/profile6.jpg'); width: 260px; height: 260px;">
                        <a tabindex="0" href="javascript://" class="position-absolute" data-toggle="popover"
                           data-placement="bottom" title="Level 3: Lorem ipsum"
                           data-content="<a class='small text-muted' href='#'>LEARN MORE</a>"
                           style="bottom: 0; left: 0">
                            <img src="img/badge-coach.png" height="100">
                        </a>
                    </div>
                    <p class="mb-0">
                        <i class="icon icon-placeholder"></i>
                        Detroit, MI, United States
                    </p>
                    <p class="text-muted mb-0">Eastern Timezone</p>
                </div>
                <div class="flex-fill mr-3">
                    <div class="row">
                        <div class="col-5">
                            <h1 class="mb-2">John Doe</h1>
                            <p>Occupation Title</p>
                        </div>
                        <div class="col-7">
                            <ul class="list-inline mb-0 social-menu">
                                <li class="list-inline-item mr-0">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="Share Profile to Social media">
                                        <i class="icon icon-social filter-gold"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="Share Profile to Social media">
                                        <i class="icon icon-social filter-gold"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="Share Profile to Social media">
                                        <i class="icon icon-social filter-gold"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="Share Profile to Social media">
                                        <i class="icon icon-social filter-gold"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                       title="Share Profile to Social media">
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
                                <li>Gratitude Expert</li>
                                <li>Marketing</li>
                                <li>Web Development</li>
                            </ul>
                        </div>
                        <div class="col-7">
                            <ul class="list-unstyled">
                                <li>Public Speaking</li>
                                <li>Personal Development</li>
                                <li>Visualization Expert</li>
                            </ul>
                        </div>
                    </div>
                    <ul class="list-inline mb-4">
                        <li class="accent-color font-weight-bold">Languages Spoken</li>
                        <li class="list-inline-item">English,</li>
                        <li class="list-inline-item">Spanish,</li>
                        <li class="list-inline-item">French</li>
                    </ul>
                    <a href="profile-edit.html" class="btn btn-outline-warning rounded-pill w-50 accent">
                        Edit Profile</a>
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
                    <img src="img/badge-coach.png" height="48" class="mr-2">
                    <h3 class="text-white">Enable Appointment Scheduling</h3>
                </li>
                <li class="bg-transparent border-0 px-0 list-group-item d-flex align-items-center">
                    <img src="img/badge-coach.png" height="48" class="mr-2">
                    <h3 class="text-white font-weight-bold">Level 3: Black Diamond</h3>
                </li>
                <li class="bg-transparent border-0 px-0 py-0 list-group-item d-flex align-items-center">
                    <img src="img/founding_members.png" height="36" class="mr-2">
                    <h3 class="text-white font-weight-bold mb-0">Founding Member</h3>
                </li>
                <li class="bg-transparent border-0 px-0 py-2 list-group-item d-flex align-items-center">
                    <img src="img/legacy_champion.png" height="36" class="mr-2">
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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                    ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
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
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                    ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                </p>
            </section>
            <section class="mb-5">
                <h2>Education</h2>
                <ul class="list-unstyled p">
                    <li>Lorem ipsum dolor sit amet.</li>
                </ul>
            </section>
            <section class="mb-5">
                <h2>Certifications</h2>
                <ul class="list-unstyled p">
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Lorem ipsum dolor sit amet.</li>
                </ul>
            </section>
            <section class="mb-5">
                <h2>Awards And Honors</h2>
                <ul class="list-unstyled p">
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Maecenas euismod</li>
                </ul>
            </section>
            <section class="mb-5">
                <h2>Conferences And Events</h2>
                <ul class="list-unstyled p">
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Maecenas euismod</li>
                </ul>
            </section>
            <section class="mb-5">
                <h2>Volunteer Activities</h2>
                <ul class="list-unstyled p">
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Maecenas euismod</li>
                </ul>
            </section>
            <section class="mb-5">
                <h2>Hobbies And Interests</h2>
                <ul class="list-unstyled p">
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Maecenas euismod</li>
                </ul>
            </section>
            <section class="mb-5">
                <h2>Income</h2>
                <p>
                    $000.000
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
<!--<div class="chat-window-wrapper position-fixed" style="bottom: 0; right: 8rem;">
    <div class="card card-chat-widget">
        <div class="card-header d-flex flex-row align-items-center justify-content-around">
            <div class="d-flex flex-row align-items-center text-decoration-none">
                <img class="rounded-circle" src="img/profile2.jpeg" alt="" width="40"
                     height="40">
                <h6 class="ml-2 text-white font-weight-bold small mb-0">Username</h6>
            </div>
        </div>
        <div class="card-body">

        </div>
        <div class="card-footer">

        </div>
    </div>
</div>-->

@endsection
