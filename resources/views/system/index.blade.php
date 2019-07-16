@extends('layouts.app_admin')

<style type="text/css">

    .levelClass{
        width: 50% !important;
    }
</style>

@section('content')

<main role="main" class="container">
    <div class="px-3 py-4">
        <section class="users mb-5">
            <h2 class="mb-3 text-white">Level Management</h2>
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

            <div class="table-responsive">
                <table class="table table-hover mb-2 levelClass" style="border:1px solid #fff;">
                    <tr>
                        <td>
                            <input type="text" class="form-control form-control-sm text-white-50 bg-transparent" placeholder="Title">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control form-control-sm text-white-50 bg-transparent" placeholder="Level" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="file" class="form-control form-control-sm text-white-50 bg-transparent">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control form-control-sm text-white-50 bg-transparent" placeholder="Price">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control form-control-sm text-white-50 bg-transparent" placeholder="Legacy">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control form-control-sm text-white-50 bg-transparent" placeholder="Coins">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <textarea style="width:100%;">
                                
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Discount Code
                            <input type="text" class="form-control form-control-sm text-white-50 bg-transparent" placeholder="">
                        </td>
                    </tr>
                    <tr style="text-align:center;">
                        <td>
                            <a href="javascript:void()" class="btn btn-outline-warning rounded-pill w-50 accent" onclick="document.getElementById('account').submit();">Add Level</a>
                        </td>
                    </tr>
                    
                </table>
            </div>
        </section>
    </div>
</main>
@endsection