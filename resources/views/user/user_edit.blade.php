@extends('layouts.app')

@section('content')

<main role="main" class="container py-5">
    <div class="d-flex flex-column align-items-center">
        <div class="w-75 px-5">
            <div>
                <form method="post" action="{{ route('users.edit', $user->id) }}" id="userEditForm">
                    <section class="mb-5">
                        <h1 class="mb-4">User Edit</h1>
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

                        <div class="form-group row no-gutters">
                            <label for="colFormLabel1" class="col-2 text-right col-form-label col-form-label-sm">First Name</label>
                            <div class="col-10 pl-2">
                                <input autofocus type="text" id="first_name" name="first_name" required class="form-control form-control-sm" id="colFormLabel1" placeholder="First Name" value="{{ old('first_name', $user->first_name) }}">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="colFormLabel2" class="col-2 text-right col-form-label col-form-label-sm">Last Name</label>
                            <div class="col-10 pl-2">
                                <input type="text" id="last_name" name="last_name" class="form-control form-control-sm" id="colFormLabel2" placeholder="Last Name" value="{{ $user->last_name }}">
                            </div>
                        </div>

                        <div class="form-group row no-gutters">
                            <label for="colFormLabel3"
                                   class="col-2 text-right col-form-label col-form-label-sm">Email</label>
                            <div class="col-10 pl-2">
                                <input type="email" id="email" name="email" required class="form-control form-control-sm" id="colFormLabel3" placeholder="Email" value="{{ $user->email }}" readonly="readonly">
                            </div>
                        </div>
                    </section>
                    <div class="text-center">
                        <a href="javascript:void()" class="btn btn-outline-warning rounded-pill px-5 py-2 w-50 text-uppercase btn-sm" onclick="document.getElementById('userEditForm').submit();">
                            Save
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
