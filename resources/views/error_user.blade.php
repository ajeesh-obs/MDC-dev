
@extends('layouts.app')

@section('content')

<main role="main" class="container">
    <div class="px-3 py-4">
        <section class="users mb-5">
            <h2 class="mb-3 text-white">{{ __('Error') }}</h2>

        </section>
        @if ($message)
        <div class="alert alert-danger displayMsgDiv">
            {{$message}}
        </div>
        @endif
    </div>
</main>
@endsection
