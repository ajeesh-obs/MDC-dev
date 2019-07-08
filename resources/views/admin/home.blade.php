@extends('layouts.app_admin')

@section('content')

<main role="main" class="container">
    <div class="px-3 py-4">
        <h2 class="mb-3">Highlights</h2>
        <div class="row">
            <div class="col-4">
                <div class="card card-dark mb-3">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center px-3">
                        <div class="accent-color text-uppercase font-weight-bold small">
                            Member Spotlight
                        </div>
                        <div>
                            <a href="#" class="small text-white text-uppercase text-decoration-none border rounded
                               accent-border px-3 py-1 dropdown-toggle arrow-none" id="actionDropdown2" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Schedule Date <span
                                    class="smaller ml-3">▼</span></a>
                            <div class="dropdown-menu text-center dropdown-menu-center dropdown-menu-sm text-white"
                                 aria-labelledby="actionDropdown2">
                                __/__/___
                            </div>
                        </div>
                    </div>
                    <div class="card-input px-3 mb-2">
                        <label class="smaller text-uppercase">Enter Name</label>
                        <input type="text" class="form-control form-control-sm border-0 write-post rounded-0">
                    </div>
                    <div class="card-input px-3">
                        <label class="smaller text-uppercase">Enter Text</label>
                        <textarea class="form-control form-control-sm border-0 write-post rounded-0" size="20"
                                  style="min-height: 200px;"></textarea>
                    </div>
                    <div class="card-body d-flex flex-row justify-content-center">
                        <a href="#" class="btn btn-outline-warning rounded-pill smaller px-5">
                            Submit</a>
                    </div>
                </div>
                <div class="card card-dark mb-3">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center px-3">
                        <div class="accent-color text-uppercase font-weight-bold small">
                            Member Spotlight
                        </div>
                        <div>
                            <a href="#" class="small text-white text-uppercase text-decoration-none border rounded
                               accent-border px-3 py-1 dropdown-toggle arrow-none" id="actionDropdown3"
                               role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">Current Spotlight <span class="smaller ml-1">&#x25BC;</span></a>
                            <div class="dropdown-menu text-center dropdown-menu-center dropdown-menu-sm text-white"
                                 aria-labelledby="actionDropdown3">

                            </div>
                        </div>
                    </div>
                    <div class="card-img rounded-0 bg-cover bg-center"
                         style="background-image: url('img/profile6.jpg'); height: 190px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title small font-weight-bold">Username</h5>
                        <p class="card-text small">
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. ure dolor in reprehenderit in
                            voluptate velit esse cillum dolore.
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="#" class="text-muted small">Read More</a>
                    </div>
                </div>
                <div class="card card-dark mb-3">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center px-3">
                        <div class="accent-color text-uppercase font-weight-bold small">
                            Member Spotlight
                        </div>
                        <div>
                            <a href="#" class="small text-white text-uppercase text-decoration-none border rounded
                               accent-border px-3 py-1 dropdown-toggle arrow-none" id="actionDropdown4"
                               role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">Schedule Date <span class="smaller ml-1">&#x25BC;</span></a>
                            <div class="dropdown-menu text-center dropdown-menu-center dropdown-menu-sm text-white"
                                 aria-labelledby="actionDropdown4">

                            </div>
                        </div>
                    </div>
                    <div class="card-img rounded-0 bg-cover bg-center"
                         style="background-image: url('img/profile1.jpg'); height: 190px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title small font-weight-bold">Username</h5>
                        <p class="card-text small">
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. ure dolor in reprehenderit in
                            voluptate velit esse cillum dolore.
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="#" class="text-muted small">Read More</a>
                    </div>
                </div>
                <div class="card card-dark mb-3">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center px-3">
                        <div class="accent-color text-uppercase font-weight-bold small">
                            Member Spotlight
                        </div>
                        <div>
                            <a href="#" class="small text-white text-uppercase text-decoration-none border rounded
                               accent-border px-3 py-1 dropdown-toggle arrow-none" id="actionDropdown5"
                               role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">Schedule Date <span class="smaller ml-1">&#x25BC;</span></a>
                            <div class="dropdown-menu text-center dropdown-menu-center dropdown-menu-sm text-white"
                                 aria-labelledby="actionDropdown5">

                            </div>
                        </div>
                    </div>
                    <div class="card-img rounded-0 bg-cover bg-center"
                         style="background-image: url('img/profile3.jpg'); height: 190px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title small font-weight-bold">Username</h5>
                        <p class="card-text small">
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. ure dolor in reprehenderit in
                            voluptate velit esse cillum dolore.
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="#" class="text-muted small">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row card-deck mb-4">
                    <div class="col-6 card border accent-border bg-transparent rounded-0">
                        <div class="text-center p-3">
                            <img src="img/hour-glass.jpg" class="img-fluid mb-2">
                            <p class="text-uppercase accent-color small font-weight-bold mb-0">Pending Approvals</p>
                        </div>
                    </div>
                    <div class="col-3 card border accent-border bg-transparent rounded-0">
                        <div class="text-center p-3">
                            <img src="img/gold-tick.jpg" class="img-fluid mb-2">
                            <p class="text-uppercase accent-color small font-weight-bold mb-0">New Group is Ready to
                                Schedule</p>
                        </div>
                    </div>
                    <div class="col-3 card border accent-border bg-transparent rounded-0">
                        <div class="text-center p-3">
                            <img src="img/gold-3.jpg" class="img-fluid mb-2">
                            <p class="text-uppercase accent-color small mb-0">Days left</p>
                            <p class="text-uppercase accent-color small font-weight-bold mb-0">No Minimum Met</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="border accent-border p-2 text-center">
                            <p class="font-weight-bold">Today's To-Do</p>
                            <ul class="list-unstyled text-left px-4 text-white">
                                <li class="mb-2">
                                    <div class="small text-uppercase font-weight-normal">
                                        HEADER
                                    </div>
                                    <div class="smaller font-weight-lighter lh-1">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.
                                    </div>
                                </li>
                                <li class="mb-2">
                                    <div class="small text-uppercase font-weight-normal">
                                        HEADER
                                    </div>
                                    <div class="smaller font-weight-lighter lh-1">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.
                                    </div>
                                </li>
                                <li>
                                    <div class="small text-uppercase font-weight-normal">
                                        HEADER
                                    </div>
                                    <div class="smaller font-weight-lighter lh-1">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border accent-border p-2 text-center">
                            <p class="font-weight-bold">This Weeks Calendar</p>
                            <ul class="list-unstyled text-left px-4 text-white">
                                <li class="mb-2 pb-2 border-bottom border-light">
                                    <div class="small text-uppercase font-weight-normal">
                                        Monday
                                    </div>
                                    <div class="smaller font-weight-lighter lh-1">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.
                                    </div>
                                </li>
                                <li class="mb-2 pb-2 border-bottom border-light">
                                    <div class="small text-uppercase font-weight-normal">
                                        Tuesday
                                    </div>
                                    <div class="smaller font-weight-lighter lh-1">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.
                                    </div>
                                </li>
                                <li class="mb-2 pb-2 border-bottom border-light">
                                    <div class="small text-uppercase font-weight-normal">
                                        Wednesday
                                    </div>
                                    <div class="smaller font-weight-lighter lh-1">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.
                                    </div>
                                </li>
                                <li class="mb-2 pb-2 border-bottom border-light">
                                    <div class="small text-uppercase font-weight-normal">
                                        Thursday
                                    </div>
                                    <div class="smaller font-weight-lighter lh-1">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.
                                    </div>
                                </li>
                                <li class="mb-2 pb-2 border-bottom border-light">
                                    <div class="small text-uppercase font-weight-normal">
                                        Friday
                                    </div>
                                    <div class="smaller font-weight-lighter lh-1">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="img/gold-plus.jpg" class="img-fluid">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="chat-window-wrapper position-fixed" style="bottom: 0; right: 8rem;">-->
    <!--<div class="card card-chat-widget">-->
    <!--<div class="card-header d-flex flex-row align-items-center justify-content-around">-->
    <!--<div class="d-flex flex-row align-items-center text-decoration-none">-->
    <!--<img class="rounded-circle" src="img/profile2.jpeg" alt="" width="40"-->
    <!--height="40">-->
    <!--<h6 class="ml-2 text-white font-weight-bold small mb-0">Username</h6>-->
    <!--</div>-->
    <!--</div>-->
    <!--<div class="card-body">-->

    <!--</div>-->
    <!--<div class="card-footer">-->

    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
</main>
@endsection
