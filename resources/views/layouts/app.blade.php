<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="OBS Virtual">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('img/favicon.png') }}">  
        <title>The Million Dollar Club</title>

        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/script.js') }}" defer></script>

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- Custom fonts for this template -->
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300,400,700" rel="stylesheet">
        <style>
            .navbar-main .nav-link{
                padding: 0 0.4rem !important; 
            }
            ul{
                list-style-type:none;
            }
            ul li a{
                color:#fff;
            }
            ul li a:hover, ul li a:focus {
                color:#ebc243;
                text-decoration: none;
            }
        </style>
    </head>

    <body>

        <div class="container">
            @if (Auth::check())
            <nav class="navbar navbar-expand-md navbar-main">
                <a class="navbar-brand p-0 text-center" href="{{ route('index') }}">
                    <img class="" src="{{ asset('img/logo.png') }}" alt="MDC">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="mr-auto position-relative">
                        <ul class="navbar-nav primary-menu">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('mindset') }}">
                                    <i class="icon icon-mindset filter-white"></i>
                                    MINDSET</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void()">
                                    <i class="icon icon-connect filter-white"></i>
                                    CONNECT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void()">
                                    <i class="icon icon-mastermind filter-white"></i>
                                    MASTERMIND</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void()">
                                    <i class="icon icon-masterclass filter-white"></i>
                                    MASTERCLASS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void()">
                                    <i class="icon icon-legacy filter-white"></i>
                                    LEGACY</a>
                            </li>
                        </ul>
                        <div class="collapse position-absolute w-100" id="collapseSearch" style="top: -5px;">
                            <input type="search" class="form-control-sm bg-color-4 border-color-1 rounded-custom w-100 text-white collapseSearchUsers">
                            <div id="suggesstion-box" style="background-color:#514c4c;border:1px solid #514c4c;cursor: pointer;"></div>
                        </div>
                    </div>
                    <ul class="navbar-nav mr-auto secondary-menu">
                        <li class="nav-item active">
                            <a class="nav-link" data-toggle="collapse" href="#collapseSearch" role="button"
                               aria-expanded="false" aria-controls="collapseSearch" id="usersSearchBtn">
                                <i class="icon icon-search filter-light"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-chat">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="navbarDropdown3" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="icon icon-chat filter-light">
                                </i>
                                <span class="badge rounded-circle">3</span>
                            </a>
                            <div class="dropdown-menu text-center dropdown-menu-left p-0" aria-labelledby="navbarDropdown3"
                                 style="min-width: 390px; min-height: 360px;">
                                <div class="arrow"></div>
                                <div class="collapse show multi-collapse-chat-search p-3" id="multiCollapseChat">
                                    <h6 class="text-uppercase text-white text-center font-weight-bold mb-3">
                                        Messages
                                        <a class="float-right" data-toggle="collapse" href=".multi-collapse-chat-search"
                                           role="button" aria-expanded="false"
                                           aria-controls="multiCollapseChat multiCollapseSearch">
                                            <i class="icon icon-dollar filter-white"></i>
                                        </a>
                                    </h6>
                                    <div class="chat-list-wrapper pre-scrollable">
                                        <ul class="list-unstyled">
                                            <li class="d-flex flex-row align-items-center mb-3">
                                                <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="50"
                                                     height="50">
                                                <div class="ml-3 text-left">
                                                    <h6 class="text-white font-weight-bold small mb-1">Username</h6>
                                                    <p class="small mb-0 font-weight-light lh-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                        tempor
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="d-flex flex-row align-items-center mb-3">
                                                <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="50"
                                                     height="50">
                                                <div class="ml-3 text-left">
                                                    <h6 class="text-white font-weight-bold small mb-1">Username</h6>
                                                    <p class="small mb-0 font-weight-light lh-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                        tempor
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="d-flex flex-row align-items-center mb-3">
                                                <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="50"
                                                     height="50">
                                                <div class="ml-3 text-left">
                                                    <h6 class="text-white font-weight-bold small mb-1">Username</h6>
                                                    <p class="small mb-0 font-weight-light lh-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                        tempor
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="d-flex flex-row align-items-center mb-3">
                                                <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="50"
                                                     height="50">
                                                <div class="ml-3 text-left">
                                                    <h6 class="text-white font-weight-bold small mb-1">Username</h6>
                                                    <p class="small mb-0 font-weight-light lh-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                        tempor
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="d-flex flex-row align-items-center mb-3">
                                                <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="50"
                                                     height="50">
                                                <div class="ml-3 text-left">
                                                    <h6 class="text-white font-weight-bold small mb-1">Username</h6>
                                                    <p class="small mb-0 font-weight-light lh-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                        tempor
                                                    </p>
                                                </div>
                                            </li>
                                            <li class="d-flex flex-row align-items-center">
                                                <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="50"
                                                     height="50">
                                                <div class="ml-3 text-left">
                                                    <h6 class="text-white font-weight-bold small mb-1">Username</h6>
                                                    <p class="small mb-0 font-weight-light lh-1">
                                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                        tempor
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="collapse multi-collapse-chat-search" id="multiCollapseSearch">
                                    <div class="pt-3 border-bottom">
                                        <div class="text-uppercase px-3 d-flex flex-row align-items-center">
                                            <a class="pr-2 text-white font-weight-bold text-decoration-none" data-toggle="collapse" href=".multi-collapse-chat-search"
                                               role="button" aria-expanded="false"
                                               aria-controls="multiCollapseChat multiCollapseSearch">
                                                <
                                            </a>
                                            <input type="search" class="form-control form-control-sm border-0">
                                            <a class="pl-2" href="#">
                                                <i class="icon icon-search filter-white"></i>
                                            </a>
                                        </div>
                                        <div class="px-3 py-2 text-left">
                                            <a href="#" class="mx-1 text-decoration-none text-white small font-weight-bold">Select All Followers</a>
                                        </div>
                                    </div>
                                    <div class="py-3 search-list-wrapper pre-scrollable">
                                        <ul class="list-unstyled">
                                            <li class="py-1">
                                                <div class="d-flex flex-row align-items-center text-decoration-none px-3 py-1">
                                                    <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="40"
                                                         height="40">
                                                    <h6 class="ml-2 text-white font-weight-bold small mb-1">Username</h6>
                                                    <a href="#" class="ml-auto open-chat">
                                                        <span class="badge bg-muted color-muted rounded-circle">
                                                            >
                                                        </span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="py-1">
                                                <div class="d-flex flex-row align-items-center text-decoration-none px-3 py-1">
                                                    <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="40"
                                                         height="40">
                                                    <h6 class="ml-2 text-white font-weight-bold small mb-1">Username</h6>
                                                    <a href="#" class="ml-auto open-chat">
                                                        <span class="badge bg-muted color-muted rounded-circle">
                                                            >
                                                        </span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="py-1">
                                                <div class="d-flex flex-row align-items-center text-decoration-none px-3 py-1">
                                                    <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="40"
                                                         height="40">
                                                    <h6 class="ml-2 text-white font-weight-bold small mb-1">Username</h6>
                                                    <a href="#" class="ml-auto open-chat">
                                                        <span class="badge bg-muted color-muted rounded-circle">
                                                            >
                                                        </span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="py-1">
                                                <div class="d-flex flex-row align-items-center text-decoration-none px-3 py-1">
                                                    <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="40"
                                                         height="40">
                                                    <h6 class="ml-2 text-white font-weight-bold small mb-1">Username</h6>
                                                    <a href="#" class="ml-auto open-chat">
                                                        <span class="badge bg-muted color-muted rounded-circle">
                                                            >
                                                        </span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="py-1">
                                                <div class="d-flex flex-row align-items-center text-decoration-none px-3 py-1">
                                                    <img class="rounded-circle" src="{{ asset('img/profile2.jpeg') }}" alt="" width="40"
                                                         height="40">
                                                    <h6 class="ml-2 text-white font-weight-bold small mb-1">Username</h6>
                                                    <a href="#" class="ml-auto open-chat">
                                                        <span class="badge bg-muted color-muted rounded-circle">
                                                            >
                                                        </span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="icon icon-notification filter-light"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="icon icon-cart filter-light"></i>
                                <span class="badge rounded-circle">1</span>
                            </a>
                        </li>
                        <li class="nav-item position-relative">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="navbarDropdown1" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon icon-dollar filter-gold"></i>
                            </a>
                            <div class="dropdown-menu p-0 dropdown-menu-center dropdown-menu-sm"
                                 aria-labelledby="navbarDropdown1">
                                <div class="dropdown-item-text d-flex flex-column align-items-center px-2">
                                    <span class="text-white d-inline-block">BALANCE</span>
                                    <span class="accent-color  d-inline-block font-weight-bold">36 COINS</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto user-menu">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                <img class="rounded-circle ml-2"
                                     src="{{ asset('img/profile1.jpg') }}"
                                     alt="Generic placeholder image" width="40" height="40">
                            </a>
                            <div class="dropdown-menu text-center dropdown-menu-right profileSettingsDiv" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="{{ route('myprofile') }}">My Profile</a>
                                <a class="dropdown-item" href="{{ route('accountsettings') }}">Account Settings</a>
                                <!--<a class="dropdown-item" href="{{ route('users') }}">Users</a>-->
                                <!--<a class="dropdown-item" href="{{ route('users') }}">Users</a>-->
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            @endif
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <!--<main class="py-4" role="main" class="container">-->
        @yield('content')
        <!--</main>-->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

        <script type="text/javascript">
                                    $(document).ready(function () {
                                    $("#navbarDropdown2").click(function () {
                                    $(".profileSettingsDiv").toggle();
                                    });
                                    //hide message div automaticaly
                                    $('.displayMsgDiv').delay(2000).fadeOut('slow');
                                    $(".memberPasswordUpdateBtn").click(function() {
                                    var email = $("#memberresetpasswordemail").val();
                                    var password = $("#memberresetpassword").val();
                                    var passwordconfirm = $("#memberresetpasswordconfirm").val();
                                    var id = $("#memberresetpasswordid").val();
                                    if (id && email){
                                    $.ajax({
                                    headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                            type: 'post',
                                            url: '{{ route('member.passordreset') }}',
                                            data: {'email': email, 'password':password, 'passwordconfirm': passwordconfirm, 'id': id},
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
                                            setTimeout(function(){
                                            window.location.href = '{{url("/")}}'; //window.location.reload();
                                            }, 1000);
                                            }
                                            }
                                    })
                                    }
                                    });
                                    $("#usersSearchBtn").click(function () {
                                    $(".collapseSearchUsers").val('');
                                    $("#collapseSearch").toggle();
                                    });
                                    $(document).on('keyup', '.collapseSearchUsers', function (e) {
                                    e.preventDefault();
                                    var val = $(this).val();
                                    if (val){
                                    $.ajax({
                                    headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                            type: "POST",
                                            url: '{{ route('users.search') }}',
                                            data: {'keyword': val},
                                            beforeSend: function(){
                                            $("#collapseSearch").css("background", "#FFF");
                                            },
                                            success: function(data){
                                            $("#suggesstion-box").show();
                                            $("#suggesstion-box").html(data);
                                            $("#collapseSearch").css("background", "#FFF");
                                            }
                                    });
                                    }
                                    else {
                                    $("#suggesstion-box").html("");
                                    }
                                    });
                                    $(document).on('click', '.userSuggesionLink', function (e) {
                                    e.preventDefault();
                                    var searchData = $(".collapseSearchUsers").val();
                                    if (searchData){
                                    window.location.href = '{{url("/users/search/result")}}?searchData=' + searchData;
                                    }
                                    });
                                    });
        </script>

        @yield('script')
    </body>
</html>
