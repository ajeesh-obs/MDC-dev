<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Niju">
        <title>The Million Dollar Club</title> 
        <!-- Favicon -->
        <link href="{{ asset('favicon.png') }}" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
        <!-- Icons -->
        <!--<link href="{{ asset('vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">-->
        <!--<link href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">-->
        <!-- Argon CSS -->
        <!--<link type="text/css" href="{{ asset('css/argon.css') }}" rel="stylesheet">-->

        <link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet">

        <style>
            .navbar-header {
                float: left;
                padding: 15px;
                text-align: center;
                width: 100%;
            }

            .navbar-brand {
                float: none;
            }
        </style>
    </head>

    <body class="bg-default">

        <div class="main-content" style="display:none;">
            <!-- Header -->
            <div class="header bg-gradient-primary py-7 py-lg-5">
                <div class="container">
                    <div class="header-body text-center mb-7">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-6">
                                <a class="navbar-brand" href="{{ url('/') }}">
                                    <img src="{{ asset('img/logo.png') }}" height="60"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center"><h3>{{ __('Million Dollar Club') }}</h3></div>
                        <div class="card-body text-center">
                            <h4>Hi {{ $user['first_name'].' '.$user['last_name']}},</h4>
                            <p>Please follow the link to verify your email address</p>
                            <p>
                                <a class="navbar-brand" href="{{ route('users.email.verification', array($user['randomNumber'])) }}"> 
                                    <button type="button" class="btn btn-primary">
                                        {{ __('Click Here') }}
                                    </button>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="py-5">
            <div class="container">
                <div class="row align-items-center justify-content-xl-between">
                    <div class="col-xl-6">
                        <div class="copyright text-center text-xl-left text-muted">
                            &copy; {{ date('Y') }} <a href="#" class="font-weight-bold ml-1" target="_blank">The Million Dollar Club </a> | <a href="http://www.obsvirtual.com/" class="font-weight-bold ml-1" target="_blank"> Powered by OBS</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Argon Scripts -->
        <!-- Core -->
        <!--<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>-->
        <!--<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>-->
        <!-- Argon JS -->
        <!--<script src="{{ asset('js/argon.js') }}"></script>-->

    </body>

</html>

