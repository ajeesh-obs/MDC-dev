@extends('layouts.app')

<style type="text/css">
    .sectionDiv{
        float: right; 
        width: 45%; 
    }
    .navbar-brand > img {
        height: 242px !important;
    }
    .contentSection{
        margin-top: 5% !important;
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
        <div class="bg-color-2 p-3 sectionDiv contentSection">
            <div>
                <h4 class="text-white mb-0 mr-4">{{ __('Admin Reset Password') }}</h4>
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                <form method="POST" action="{{ route('admin.passwordsent') }}">
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

                    <div class="form-group row mb-0">
                        <div class="col-md-7 offset-md-4">
                            <button type="submit" class="btn rounded-custom btn-dark btn-block">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
