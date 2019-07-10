@extends('layouts.app')
<style type="text/css">
    .sectionDiv{
        /*width: 560px;*/
        float: right;
        width: 45%;
    }
    .navbar-brand > img {
        height: 242px !important;
    }
    .forgotPasswordDiv{
        width: 100% !important;
        text-align: center !important;
        padding-left: 26% !important;
    }
    .banner{
        margin-top: 15% !important;
    }
    .sectionDiv img {
        width: 100%;
    }
    @media only screen and (max-width: 1024px)  {
        .sectionDiv{ 
            width: 100%; 
        }
    }
</style>
@section('content')

<div class="container">
    <div class="banner">
        <div class=" p-3 sectionDiv float-left">
            <a class="navbar-brand p-0 text-center" href="{{ route('index') }}">
                <img class="" src="{{ asset('img/logo.png') }}" alt="MDC">
            </a>
        </div>
        <div class="bg-color-2 p-3 sectionDiv">
            <div>
                <h4 class="text-white mb-0 mr-4">{{ __('Admin Login') }}</h4>
            </div>
            @if(session()->has('errormessage'))
            <div class="alert alert-danger displayMsgDiv">
                {{ session()->get('errormessage') }}
            </div>
            @endif
            <div class="card-body">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right text-white">{{ __('E-Mail Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control form-control-sm text-white-50 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail Address">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right text-white">{{ __('Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control form-control-sm text-white-50 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" autofocus placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">  
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                       <label class="form-check-label text-white" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-3 offset-md-4">
                            <button type="submit" class="btn rounded-custom btn-dark btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body float-right forgotPasswordDiv">
            @if (Route::has('password.request'))
            <a class="btn btn-link text-white" href="{{ route('admin.password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
<!--            <a class="btn btn-link text-white" href="{{ route('register') }}">
                {{ __('Register') }}
            </a>-->
        </div>

        <div class="card-body float-right forgotPasswordDiv" style="display:none;">
            <div class="col-md-5 row-block float-right">
                <a href="{{ url('auth/facebook') }}" class="btn btn-lg btn-primary btn-block">
                    <strong>Login With Facebook</strong>
                </a>     
            </div>
        </div>


    </div>
</div>
@endsection
