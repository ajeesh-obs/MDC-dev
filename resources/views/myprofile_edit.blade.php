@extends('layouts.app')

<style type="text/css">

    .hiddenClass{
        display: none;
    }
    .locationText {
        width: 260px !important;
    }
</style>
@section('content')
<main role="main" class="container">
    <form id="account" method="POST" action="{{ route('myprofile.update') }}">
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
                                Detroit, MI, United States
                                <!--<input id="country" type="text" class="form-control form-control-sm text-white-50 bg-transparent locationText" onFocus="initializeAutocomplete()">-->
                            </p>
                            <p class="text-muted">Eastern Timezone</p>
                            <a href="javascript:void()" class="btn btn-sm btn-outline-warning rounded-pill text-white py-2 px-3">
                                Update Travel Plans
                            </a>
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
                                        <a href="#" class="text-white text-white-50">www.website.com</a>
                                    </p>
                                </div>
                            </div>
                            <h3 class="text-white-50 font-weight-bold">Expertise</h3>
                            <div class="row">
                                <div class="col-5 userExpertiseDiv">
                                    <ul class="list-unstyled">  
                                        @if($userExpertise->count() > 0) 
                                        @foreach($userExpertise as $experise)
                                        <li><a href="javascript:void()" class="text-white mr-2 userExpertise">&times;</a><span> {{$experise->expertise}}</span></li>    
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <!--                                <div class="col-7">
                                                                    <ul class="list-unstyled">
                                                                        <li><a href="#" class="text-white mr-2">&times;</a> Public Speaking</li>
                                                                        <li><a href="#" class="text-white mr-2">&times;</a> Personal Development</li>
                                                                        <li><a href="#" class="text-white mr-2">&times;</a> Visualization Expert</li>
                                                                    </ul>
                                                                </div>-->
                            </div>
                            <div class="autocomplete mb-3">
                                <input id="searchExpertise" type="search" class="form-control form-control-sm text-white-50 bg-transparent" placeholder="Search Expertise">
                                <span class="expertiseErrorDiv" style="display:none;color:red;">Maximum 3 expertise are allowed</span>
                            </div>
                            <ul class="list-inline mb-1">
                                <li class="text-white-50 font-weight-bold">Languages Spoken</li>
                            </ul>
                            <input type="text" class="form-control form-control-sm mb-5 w-50 rounded bg-muted" value="{{ old('languages_spoken', $languages_spoken)}}" name="languages_spoken">
                            <a href="javascript:void()" class="btn btn-outline-warning rounded-pill w-50 accent" onclick="document.getElementById('account').submit();">Save</a>
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
                        <div class="collapse show multi-collapse" id="multiCollapseExample1">
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
                        <div class="collapse show multi-collapse" id="multiCollapseExample2">
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
                        <textarea class="form-control bg-muted rounded text-white border-0" rows="4" name="about_username"> {{ old('about_username', $about_username)}}</textarea>
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
                        <textarea class="form-control bg-muted rounded text-white border-0" rows="4" name="goals_vision"> {{ old('goals_vision', $goals_vision)}}</textarea>
                    </section>
                    <section class="mb-5">
                        <div class="d-flex flex-row align-items-center mb-2">
                            <a href="javascript:void()" class="accent-circle mr-3 profileEducationPopup">&#43;</a>
                            <h2 class="mb-0">Education</h2>
                        </div>
                        <div class="position-relative profileEducationDiv hiddenClass"> 
                            <textarea class="form-control bg-muted rounded text-white border-0" rows="4" name="education">{{ old('education', $education)}}</textarea>
                            <a href="javascript:void()" class="white-circle position-absolute profileEducationPopup" style="top: -10px; right: -10px;">&times;</a>
                        </div>
                    </section>
                    <section class="mb-5">
                        <div class="d-flex flex-row align-items-center mb-2">
                            <a href="javascript:void()" class="accent-circle mr-3 profileCertificationsPopup">&#43;</a>
                            <h2 class="mb-0">Certifications</h2>
                        </div>
                        <div class="position-relative profileCertificationsDiv">
                            <textarea class="form-control bg-muted rounded text-white border-0" rows="4" name="certifications">{{ old('certifications', $certifications)}}</textarea>
                            <a href="javascript:void()" class="white-circle position-absolute profileCertificationsPopup" style="top: -10px; right: -10px;">&times;</a>
                        </div>
                    </section>
                    <section class="mb-5">
                        <div class="d-flex flex-row align-items-center mb-2">
                            <a href="javascript:void()" class="accent-circle mr-3 profileAwardsPopup">&#43;</a>
                            <h2 class="mb-0">Awards & Honors</h2>
                        </div>
                        <div class="position-relative profileAwardsDiv">
                            <textarea class="form-control bg-muted rounded text-white border-0" rows="4" name="awards_honor">{{ old('awards_honor', $awards_honor)}}</textarea>
                            <a href="javascript:void()" class="white-circle position-absolute profileAwardsPopup" style="top: -10px; right: -10px;">&times;</a>
                        </div>
                    </section>
                    <section class="mb-5">
                        <div class="d-flex flex-row align-items-center mb-2">
                            <a href="javascript:void()" class="accent-circle mr-3 profileConferencesPopup">&#43;</a>
                            <h2 class="mb-0">Conferences And Events</h2>
                        </div>
                        <div class="position-relative profileConferencesDiv hiddenClass">
                            <textarea class="form-control bg-muted rounded text-white border-0" rows="4" name="conferences_events">{{ old('conferences_events', $conferences_events)}}</textarea>
                            <a href="javascript:void()" class="white-circle position-absolute profileConferencesPopup" style="top: -10px; right: -10px;">&times;</a>
                        </div>
                    </section>
                    <section class="mb-5">
                        <div class="d-flex flex-row align-items-center mb-2">
                            <a href="javascript:void()" class="accent-circle mr-3 profileVolunteerPopup">&#43;</a>
                            <h2 class="mb-0">Volunteer Activities</h2>
                        </div>
                        <div class="position-relative profileVolunteerDiv hiddenClass">
                            <textarea class="form-control bg-muted rounded text-white border-0" rows="4" name="volunteer_activities">{{ old('volunteer_activities', $volunteer_activities)}}</textarea>
                            <a href="javascript:void()" class="white-circle position-absolute profileVolunteerPopup" style="top: -10px; right: -10px;">&times;</a>
                        </div>
                    </section>
                    <section class="mb-5">
                        <div class="d-flex flex-row align-items-center mb-2">
                            <a href="javascript:void()" class="accent-circle mr-3 profileHobbiesPopup">&#43;</a>
                            <h2 class="mb-0">Hobbies And Interests</h2>
                        </div>
                        <div class="position-relative profileHobbiesDiv hiddenClass">
                            <textarea class="form-control bg-muted rounded text-white border-0" rows="4" name="hobbies_interests">{{ old('hobbies_interests', $hobbies_interests)}}</textarea>
                            <a href="javascript:void()" class="white-circle position-absolute profileHobbiesPopup" style="top: -10px; right: -10px;">&times;</a>
                        </div>
                    </section>
                    <section class="mb-5">
                        <div class="d-flex flex-row align-items-center mb-2">
                            <a href="javascript:void()" class="accent-circle mr-3 profileIncomePopup">&#43;</a>
                            <h2 class="mb-0">Income</h2>
                        </div>
                        <div class="position-relative profileIncomeDiv">
                            <textarea class="form-control bg-muted rounded text-white border-0" rows="1" name="income">{{ old('income', $income)}}</textarea>
                            <a href="javascript:void()" class="white-circle position-absolute profileIncomePopup" style="top: -10px; right: -10px;">&times;</a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <input type="hidden" name="userCurrentExpertise" id="userCurrentExpertise" value="{{$userCurrentExpertise}}">
    </form>
</main>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        var expertise = @json($allExpertArr);
                if (document.getElementById("searchExpertise")) {
            autocomplete(document.getElementById("searchExpertise"), expertise);
        }

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

            var totalExpertise = $('.userExpertiseDiv ul li').length;
            if (totalExpertise > 2) {
                $(".expertiseErrorDiv").show();
                return;
            } else {
                $(".userExpertiseDiv ul").append('<li><a href="javascript:void()" class="text-white mr-2 userExpertise">&times;</a><span>' + val + '</span></li>');
                $("#searchExpertise").val('');
                $("#searchExpertise").focus();
                getExpertiseValues();
            }
        }

        $(document).on('click', '.userExpertise', function (e) {
            e.preventDefault();

            $(this).parent().remove();
            getExpertiseValues();
        });

        function getExpertiseValues() {
            var values = $('.userExpertiseDiv li span').map(function () {
                return $(this).text();
            }).get().join(',');
            $("#userCurrentExpertise").val(values);
        }

        // profile edit page toggle items  
        $(".profileEducationPopup").click(function () {
            $(".profileEducationDiv").toggle();
        });
        $(".profileCertificationsPopup").click(function () {
            $(".profileCertificationsDiv").toggle();
        });
        $(".profileAwardsPopup").click(function () {
            $(".profileAwardsDiv").toggle();
        });
        $(".profileConferencesPopup").click(function () {
            $(".profileConferencesDiv").toggle();
        });
        $(".profileVolunteerPopup").click(function () {
            $(".profileVolunteerDiv").toggle();
        });
        $(".profileHobbiesPopup").click(function () {
            $(".profileHobbiesDiv").toggle();
        });
        $(".profileIncomePopup").click(function () {
            $(".profileIncomeDiv").toggle();
        });
    });
</script>
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEDVd3ns05bhTmlTSlS_zopAJxkbkp5hw&libraries=geometry,places"></script>-->
<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnHdUdzSaSeFuC3IfK-91bv2wpX3gB91E&libraries=geometry,places"></script>
<script type="text/javascript">

    function initializeAutocomplete() {
        var input = document.getElementById('country');
        // var options = {
        //   types: ['(regions)'],
        //   componentRestrictions: {country: "IN"}
        // };
        var options = {}

        var autocomplete = new google.maps.places.Autocomplete(input, options);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var placeId = place.place_id;

//            alert(lat);
            //alert(lng);
            //alert(placeId);
        });
    }
</script>-->
@endsection
