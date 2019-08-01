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
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!-- Custom fonts for this template -->
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:300,400,700" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/script.js') }}" defer></script>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-main">
                <a class="navbar-brand p-0 text-center" href="{{ route('admin.dashboard') }}">
                    <img class="" src="{{ asset('img/logo.png') }}" alt="MDC">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="ml-4 mr-auto position-relative">
                        <ul class="navbar-nav primary-menu">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    DASHBOARD</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void()">  
                                    LEADERBOARD</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.userslist') }}">
                                    USERS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void()">
                                    ENROLLMENT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void()">
                                    FINANCIAL</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.system') }}">
                                    SYSTEM</a>
                            </li>
                        </ul>
                    </div>
                    <ul class="navbar-nav mr-auto secondary-menu">
                        <li class="nav-item dropdown dropdown-chat border-left border-right">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="navbarDropdown3" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="icon icon-chat filter-white">
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
                                            <a class="pr-2 text-white font-weight-bold text-decoration-none"
                                               data-toggle="collapse" href=".multi-collapse-chat-search"
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
                                            <a href="#" class="mx-1 text-decoration-none text-white small font-weight-bold">Select
                                                All Followers</a>
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
                        <li class="nav-item border-right">
                            <a class="nav-link" href="#">
                                <i class="icon icon-cart filter-white"></i>
                                <span class="badge rounded-circle">1</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto user-menu">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Welcome, {{ str_limit(Auth::user()->first_name, $limit = 20, $end = '...') }} {{ str_limit(Auth::user()->last_name, $limit = 15, $end = '...') }}

                                @if($LoginUserProfilePic)
                                <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$LoginUserProfilePic) }}"alt="Generic placeholder image" width="40" height="40">
                                @else
                                <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="Generic placeholder image" width="40" height="40">
                                @endif
                            </a>
                            <div class="dropdown-menu text-center dropdown-menu-right profileSettingsDiv" aria-labelledby="navbarDropdown2">
                                <!--<a class="dropdown-item" href="{{ route('myprofile') }}">My Profile</a>-->
                                <!--<a class="dropdown-item" href="{{ route('accountsettings') }}">Account Settings</a>-->
                                <!--<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>-->
                                <a class="dropdown-item" href="{{ route('admin.logout') }}">Log Out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
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
        <script src="js/script.js" type="text/javascript"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
            $("#navbarDropdown2").click(function () {
            $(".profileSettingsDiv").toggle();
            });
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
            //hide message div automaticaly
            $('.displayMsgDiv').delay(2000).fadeOut('slow');
            $(".userActivityFilter").change(function () {
            userFilterList();
            /*var userActivityFilter = $(".userActivityFilter").val();
            $.ajax({
            url:'/userslist?userActivityFilter='+userActivityFilter,
            success:function(data)
            {  
            $(".userlisttbody").html("");
            $(".userlisttbody").html(data);
            }
            })*/
            });
            $(".userRoleFilter").change(function () {
            userFilterList();
            /*var userRoleFilter = $(".userRoleFilter").val();
            $.ajax({
            url:'/userslist?userRoleFilter='+userRoleFilter,
            success:function(data)
            {  
            $(".userlisttbody").html("");
            $(".userlisttbody").html(data);
            }
            })*/
            });
            function userFilterList(){
            var userActivityFilter = $(".userActivityFilter").val();
            var userRoleFilter = $(".userRoleFilter").val();
            $.ajax({
            url:'/admin/userslist?userRoleFilter=' + userRoleFilter + '&userActivityFilter=' + userActivityFilter,
            success:function(data)
            {
            $(".userlisttbody").html("");
            $(".userlisttbody").html(data);
            }
            })
            }

            $(document).on('click', '.user-delete', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var currentactivity = $(this).data('currentactivity');
            var msg = "";
            if (currentactivity == 1){
            msg = "Do you want to Inactive the user";
            }
            else {
            msg = "Do you want to Active the user";
            }
            swal({
            title: "Are you sure?",
            text: msg,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function (isConfirm) {
            if (isConfirm) {
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'delete',
            url: '/admin/users/changeactivity/' + id,
            success: function (data) {
            swal({
            text: data.message,
            title: 'Success!',
            type: "success",
            timer: 2000,
            showCancelButton: false, //There won't be any cancle button
            showConfirmButton: false
            },
            function () {
            location.reload();
            })
            }
            });
            } else {
            swal({
            title: 'Cancelled!',
            type: "info", showConfirmButton: false, timer: 1000
            });
            e.preventDefault();
            }
            });
            });
            $(document).on('change', 'input:checkbox.userRoleSetting', function (e) {
            e.preventDefault();
            var ischecked = $(this).is(':checked');
            var role_id = $(this).val();
            var user_id = $(this).attr("data-userid");
            if (role_id && user_id){
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '{{ route('role.modify') }}',
            data: {'ischecked': ischecked, 'role_id': role_id, 'user_id': user_id},
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
            window.location.reload();
            }, 1000);
            }
            }
            })
            }
            });
            $("input:checkbox.roleModulePermissionSetting").change(function(e) {
            e.preventDefault();
            var ischecked = $(this).is(':checked');
            var module_id = $(this).val();
            var role_id = $(this).attr("data-roleid");
            if (role_id && module_id){
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '{{ route('permission.modify') }}',
            data: {'ischecked': ischecked, 'role_id': role_id, 'module_id': module_id},
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
            window.location.reload();
            }, 1000);
            }
            }
            })
            }
            });
            $("#saveRoleBtn").click(function() {
            var roleName = $("#roleName").val();
            var is_service_provider = $('#is_service_provider:checkbox:checked').length;
            if (roleName){
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '{{ route('admin.role.save') }}',
            data: {'roleName': roleName, 'is_service_provider':is_service_provider},
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
            window.location.reload();
            }, 1000);
            }
            }
            })
            }
            });
            $("#saveMemberBtn").click(function() {
            var firstName = $("#firstName").val();
            var lastName = $("#lastName").val();
            var email = $("#email").val();
            var confirmEmail = $("#confirmEmail").val();
            var userRole = $("#userRole").val();
            if (email && firstName){
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '{{ route('member.save') }}',
            data: {'firstName': firstName, 'lastName':lastName, 'email': email, 'confirmEmail': confirmEmail, 'userRole': userRole},
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
            window.location.reload();
            }, 1000);
            }
            }
            })
            }
            });
            $(".editmember").click(function() {

            var id = $(this).data('id');
            var lname = $(this).data('lname');
            var fname = $(this).data('fname');
            var email = $(this).data('email');
            if (id){

            $("#editServiceProviderfirstName").val(fname);
            $("#editServiceProviderlastName").val(lname);
            $("#editServiceProvideremail").val(email);
            $("#editServiceProviderid").val(id);
            $("#collapseEditMember").show();
            $('html, body').animate({
            scrollTop: $("#collapseEditMember").offset().top
            }, 1000); 
            
            }
            });
            $("#editServiceProviderBtn").click(function() {
            var firstName = $("#editServiceProviderfirstName").val();
            var lastName = $("#editServiceProviderlastName").val();
            var id = $("#editServiceProviderid").val();
            if (id && firstName){
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '{{ route('member.update') }}',
            data: {'firstName': firstName, 'lastName':lastName, 'id': id},
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
            window.location.reload();
            }, 1000);
            }
            }
            })
            }
            });
            $(document).on('click', '.edituser', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var lname = $(this).data('lname');
            var fname = $(this).data('fname');
            var email = $(this).data('email');
            if (id){

            $("#editUserfirstName").val(fname);
            $("#editUserlastName").val(lname);
            $("#editUseremail").val(email);
            $("#editUserid").val(id);
            $("#collapseEditUser").show();
            $('html, body').animate({
            scrollTop: $("#collapseEditUser").offset().top
            }, 1000); 

            }
            });
            $("#editUserBtn").click(function() {
            var firstName = $("#editUserfirstName").val();
            var lastName = $("#editUserlastName").val();
            var id = $("#editUserid").val();
            if (id && firstName){
            $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'post',
            url: '{{ route('member.update') }}',
            data: {'firstName': firstName, 'lastName':lastName, 'id': id},
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
            window.location.reload();
            }, 1000);
            }
            }
            })
            }
            });
            $(document).on('click', '.addMemberCloseBtn', function (e) {
            e.preventDefault();
            $(".addMemberDiv").hide();
            });
            $(document).on('click', '.addMemberAddBtn', function (e) {
            e.preventDefault();
            $(".addMemberDiv").show();
            });
            $(document).on('click', '.editMemberCloseBtn', function (e) {
            e.preventDefault();
            $("#collapseEditUser").hide();
            });
            $(document).on('click', '.addRoleCloseBtn', function (e) {
            e.preventDefault();
            $("#collapseAddRole").hide();
            });
            $(document).on('click', '.addRoleBtn', function (e) {
            e.preventDefault();
            $("#collapseAddRole").show();
            });
            $(document).on('click', '.editServiceProvidersCloseBtn', function (e) {
            e.preventDefault();
            $("#collapseEditMember").hide();
            });
            });
        </script>

        @yield('script')
    </body>
</html>
