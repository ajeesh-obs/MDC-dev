@extends('layouts.app')

@section('content')

<main role="main" class="container py-5">
    <div class="d-flex flex-column align-items-center">
        <div class="w-75 px-5">
            <div>
                <form class="account" id="account" method="POST" action="{{ route('accountsettingssave') }}">
                    <section class="mb-5">
                        <h1 class="mb-4">Account Settings</h1>
                        @csrf

                        @if ($errors->any())
                        <div class="alert alert-danger displayMsgDiv">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if(session()->has('message'))
                        <div class="alert alert-success displayMsgDiv">
                            {{ session()->get('message') }}
                        </div>
                        @endif

                        <div class="form-group row no-gutters">
                            <label for="colFormLabel1" class="col-2 text-right col-form-label col-form-label-sm">First Name</label>
                            <div class="col-10 pl-2">
                                <input type="text" id="first_name" name="first_name" required class="form-control form-control-sm" id="colFormLabel1" placeholder="First Name" value="{{ $user->first_name }}">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="colFormLabel2" class="col-2 text-right col-form-label col-form-label-sm">Last Name</label>
                            <div class="col-10 pl-2">
                                <input type="text" id="last_name" name="last_name" class="form-control form-control-sm" id="colFormLabel2" placeholder="Last Name" value="{{ $user->last_name }}">
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="colFormLabel3"
                                   class="col-2 text-right col-form-label col-form-label-sm">Email</label>
                            <div class="col-10 pl-2">
                                <input type="email" id="email" name="email" required class="form-control form-control-sm" id="colFormLabel3" placeholder="Email" value="{{ $user->email }}" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="colFormLabel4" class="col-2 text-right col-form-label col-form-label-sm">Change Password</label>
                            <div class="col-10 pl-2">
                                <input type="password" id="password" name="password" required class="form-control form-control-sm" id="colFormLabel4" placeholder="Change Password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="colFormLabel5" class="col-2 text-right col-form-label col-form-label-sm">Repeat Password</label>
                            <div class="col-10 pl-2">
                                <input type="password" id="password_confirmation" name="password_confirmation" required class="form-control form-control-sm" id="colFormLabel5" placeholder="Repeat Password">

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </section>
                    <section class="mb-5">
                        <h4 class="text-white mb-4">Link Social</h4>
                        <!--<form class="account">-->
                        <div class="form-group row no-gutters">
                            <label for="colFormLabel6" class="col-2 text-right col-form-label col-form-label-sm">Facebook URL</label>
                            <div class="col-10 pl-2">
                                <input type="url" class="form-control form-control-sm" id="colFormLabel6" placeholder="Facebook URL" name="facebook_link" value="{{ old('facebook_link', $facebook_link)}}">
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="colFormLabel7"
                                   class="col-2 text-right col-form-label col-form-label-sm">Twitter</label>
                            <div class="col-10 pl-2">
                                <input type="url" class="form-control form-control-sm" id="colFormLabel7" placeholder="Twitter" name="twitter_link" value="{{ old('twitter_link', $twitter_link)}}">
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="colFormLabel8"
                                   class="col-2 text-right col-form-label col-form-label-sm">Instagram</label>
                            <div class="col-10 pl-2">
                                <input type="url" class="form-control form-control-sm" id="colFormLabel8" placeholder="Instagram" name="instagram_link" value="{{ old('instagram_link', $instagram_link)}}">
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="colFormLabel9"
                                   class="col-2 text-right col-form-label col-form-label-sm">YouTube</label>
                            <div class="col-10 pl-2">
                                <input type="url" class="form-control form-control-sm" id="colFormLabel9" placeholder="YouTube" name="youtube_link" value="{{ old('youtube_link', $youtube_link)}}">
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="colFormLabel10"
                                   class="col-2 text-right col-form-label col-form-label-sm">LinkedIn</label>
                            <div class="col-10 pl-2">
                                <input type="url" class="form-control form-control-sm" id="colFormLabel10" placeholder="LinkedIn" name="linkedin_link" value="{{ old('linkedin_link', $linkedin_link)}}">
                            </div>
                        </div>
                    </section>
                    <section class="mb-5">
                        <h4 class="text-white mb-4">Payment Method</h4>
                        <!--<form class="account">-->
                        <div class="form-group row no-gutters">
                            <label for="colFormLabel11" class="col-2 text-right col-form-label col-form-label-sm">Credit
                                Card Number</label>
                            <div class="col-10 pl-2">
                                <input type="text" class="form-control form-control-sm" id="colFormLabel11" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="colFormLabel12" class="col-2 text-right col-form-label col-form-label-sm">Expiration
                                Date</label>
                            <div class="col-3 pl-2">
                                <input type="text" class="form-control form-control-sm" id="colFormLabel12" placeholder="">
                            </div>

                            <label for="colFormLabel13" class="col-2 text-right col-form-label col-form-label-sm">Security
                                Code</label>
                            <div class="col-2 mr-auto pl-2">
                                <input type="text" class="form-control form-control-sm" id="colFormLabel13" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label for="colFormLabel14" class="col-2 text-right col-form-label col-form-label-sm">Card
                                Holder's Name</label>
                            <div class="col-10 pl-2">
                                <input type="text" class="form-control form-control-sm" id="colFormLabel14" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row no-gutters">
                            <label class="col-2 text-right col-form-label col-form-label-sm">Billing History</label>
                            <div class="col-3 pl-2">
                                <div class="dropdown account1">
                                    <a class="btn btn-block form-control form-control-sm dropdown-toggle py-2" href="#"
                                       role="button" id="dropdownMonth"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span id="selected">Month</span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMonth">
                                        <a class="dropdown-item" href="javascript://">January</a>
                                        <a class="dropdown-item" href="javascript://">February</a>
                                        <a class="dropdown-item" href="javascript://">March</a>
                                        <a class="dropdown-item" href="javascript://">April</a>
                                        <a class="dropdown-item" href="javascript://">May</a>
                                        <a class="dropdown-item" href="javascript://">June</a>
                                        <a class="dropdown-item" href="javascript://">July</a>
                                        <a class="dropdown-item" href="javascript://">August</a>
                                        <a class="dropdown-item" href="javascript://">September</a>
                                        <a class="dropdown-item" href="javascript://">October</a>
                                        <a class="dropdown-item" href="javascript://">November</a>
                                        <a class="dropdown-item" href="javascript://">December</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 mr-auto pl-3">
                                <div class="dropdown account2">
                                    <a class="btn btn-block form-control form-control-sm dropdown-toggle py-2" href="#"
                                       role="button" id="dropdownYear"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span id="selected">Year</span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownYear">
                                        <a class="dropdown-item" href="javascript://">2019</a>
                                        <a class="dropdown-item" href="javascript://">2018</a>
                                        <a class="dropdown-item" href="javascript://">2017</a>
                                        <a class="dropdown-item" href="javascript://">2016</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="javascript:void()" class="btn btn-outline-warning rounded-pill px-5 py-2 w-50 text-uppercase btn-sm" onclick="document.getElementById('account').submit();">
                                Save
                            </a>
                        </div>
                    </section>
                </form>
            </div>
            <section class="mb-5">
                <h4 class="text-white mb-4">Plans</h4>
                <div class="card-group">
                    <div class="card card-light plan-gold rounded-0 text-center mr-2">
                        <div class="card-body pt-3 pb-0 px-3">
                            <h6 class="card-title">GOLD</h6>
                            <div class="card-text text-white-50 mb-2">
                                $00.00
                            </div>
                            <div class="card-text text-white small mb-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut
                                labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-5">
                            <a href="#" class="btn btn-outline-light rounded-pill px-5">
                                Activate
                            </a>
                        </div>
                    </div>
                    <div class="card card-light plan-platinum rounded-0 text-center mr-2">
                        <div class="card-body pt-3 pb-0 px-3">
                            <h6 class="card-title">PLATINUM</h6>
                            <div class="card-text text-white-50 mb-2">
                                $00.00
                            </div>
                            <div class="card-text text-white small mb-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut
                                labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-5">
                            <a href="#" class="btn btn-outline-light rounded-pill px-5">
                                Activate
                            </a>
                        </div>
                    </div>
                    <div class="card card-light plan-diamond rounded-0 text-center">
                        <div class="card-body pt-3 pb-0 px-3">
                            <h6 class="card-title">DIAMOND</h6>
                            <div class="card-text text-white-50 mb-2">
                                $00.00
                            </div>
                            <div class="card-text text-white small mb-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut
                                labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 p-5">
                            <a href="#" class="btn btn-outline-light rounded-pill px-5">
                                Activate
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="mb-4">
                <h4 class="text-white mb-4">Account Status</h4>
                <h6 class="text-white-50 mb-3">FREEZE ACCOUNT</h6>
                <p class="text-white-50">
                    Your profile remains with a status of on hold if a follower happens to look at that profile.
                    Otherwise the person has no access to their account outside your profile.
                </p>
                <div class="text-center">
                    <a href="#" class="btn btn-outline-warning rounded-pill px-5 py-2 w-50 text-uppercase btn-sm">
                        Freeze Account
                    </a>
                </div>
            </section>
            <section class="mb-5">
                <h6 class="text-white-50 mb-3">CANCEL SUBSCRIPTION</h6>
                <p class="text-white-50">
                    No refund policy. No further charges happen. Subscription physically cancelled at end of the current
                    payment cycle.
                </p>
                <div class="text-center">
                    <a href="#" class="btn btn-outline-warning rounded-pill px-5 py-2 w-50 text-uppercase btn-sm">
                        Cancel Account
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection
