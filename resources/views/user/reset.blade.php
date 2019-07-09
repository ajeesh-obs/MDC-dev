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
        padding-left: 30% !important;
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
        <div class="p-3 sectionDiv float-left">
            <a class="navbar-brand p-0 text-center" href="{{ route('index') }}">
                <img class="" src="{{ asset('img/logo.png') }}" alt="MDC">
            </a>
        </div>
        <div class="bg-color-2 p-3 sectionDiv">
            <div>
                <h4 class="text-white mb-0 mr-4">{{ __('Member New Password') }}</h4>
            </div>
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
            <div class="card-body">
                <form method="POST" action="{{ route('member.passordreset') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right text-white">{{ __('E-Mail Address') }}</label>
                        <div class="col-md-6">
                            <input id="memberresetpasswordemail" type="email" class="form-control form-control-sm text-white-50 @error('email') is-invalid @enderror" name="memberresetpasswordemail" value="{{ $user->email }}" required autocomplete="email" autofocus readonly>

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
                            <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="memberresetpassword" name="memberresetpassword" required >

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
                            <input type="password" class="form-control form-control-sm" id="memberresetpasswordconfirm" name="memberresetpasswordconfirm" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" class="btn rounded-custom btn-dark btn-block memberPasswordUpdateBtn">
                                {{ __('Save Password') }}
                            </button>
                        </div>
                    </div>
                    <input id="memberresetpasswordid" type="hidden" name="memberresetpasswordid" value="{{ $user->id }}">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
