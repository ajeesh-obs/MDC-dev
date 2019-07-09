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
                <h4 class="text-white mb-0 mr-4">{{ __('Error') }}</h4>
            </div>
            @if ($message)
            <div class="alert alert-danger displayMsgDiv">
                {{$message}}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
