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
                <h4 class="text-white mb-0 mr-4">{{ __('Register') }}</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}"> 
                    @csrf

                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right text-white">{{ __('First Name') }}</label>
                        <div class="col-md-6">
                            <input id="first_name" type="text" class="form-control form-control-sm text-white-50 @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="First Name">

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right text-white">{{ __('Last Name') }}</label>

                        <div class="col-md-6">
                            <input id="last_name" type="last_name" class="form-control form-control-sm @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" placeholder="Last Name">

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right text-white">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-Mail Address">

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
                            <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right text-white">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control form-control-sm" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-3 offset-md-4">
                            <button type="submit" class="btn rounded-custom btn-dark btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
