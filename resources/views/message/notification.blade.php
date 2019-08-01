@extends('layouts.app')
<style>
    .whitecolor{
        color:#fff;
    }
</style>
@section('content')
<main role="main" class="container">
    <div class="px-2 py-4">
        <section class="suggested mb-4">
            <h5 class="text-white font-weight-bold mb-2">Notification</h5>
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
        </section>
        <div class="card card-light rounded-0 mb-4">
            <div class="table-responsive">
                <table class="table align-items-center table-flush table-striped">
                    <thead>
                    <td class="whitecolor" style="font-weight:bold">Sl No</td>
                    <td class="whitecolor" style="font-weight:bold">Notification</td>
                    </thead>
                    <tbody>
                        @if($notificationList->count() > 0)
                        @foreach($notificationList as $index => $notification)
                        <tr>
                            <td class="whitecolor">{{ $index + 1 }}</td>
                            <td class="whitecolor">{{ $notification->notification }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="2" class="text-center">No Records Found!</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="col-lg-12">
                    {{ $notificationList->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection