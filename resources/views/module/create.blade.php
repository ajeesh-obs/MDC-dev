@extends('layouts.app')

@section('content')

<main role="main" class="container py-5">
    <div class="d-flex flex-column align-items-center">
        <div class="w-75 px-5">
            <div>
                <form method="post" action="{{ route('module.create') }}" id="moduleForm">
                    <section class="mb-5">
                        <h1 class="mb-4">Module</h1>
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
                            <label for="colFormLabel1" class="col-2 text-right col-form-label col-form-label-sm">Module Name</label>
                            <div class="col-10 pl-2">
                                <input autofocus type="text" id="module_name" name="module_name" required class="form-control form-control-sm" id="colFormLabel1" placeholder="Module Name" value="{{ old('module_name') }}">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </section>
                    <div class="text-center">
                        <a href="javascript:void()" class="btn btn-outline-warning rounded-pill px-5 py-2 w-50 text-uppercase btn-sm" onclick="document.getElementById('moduleForm').submit();">
                            Save
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
