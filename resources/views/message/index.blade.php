@extends('layouts.app')
<style>

</style>
@section('content')
<main role="main" class="container">
    <div class="px-2 py-4">
        <section class="suggested mb-4">
            <h5 class="text-white font-weight-bold mb-2">Messaging</h5>
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
        <section class="profiles">
            <div class="jumbotron p-3 pt-5 mb-0 text-white rounded-0" style="background-colord:#fff !important;">  
                <div class="d-flex">
                    <div class="flex-fill">
                        <div class="d-flex flex-row align-items-center">
                            <div class="text-center mr-4">
                                <p class="mb-0" id="collapseSearch-users">
                                    <input id="toUser" name="toUser" type="text" placeholder="To" class="form-control form-control-sm text-white-50 bg-transparent locationText" @if ($selUserId) value='{{$selUserName}}' data-id='{{$selUserId}}' @endif>
                                </p>
                                <div id="suggesstion-box-users" style="background-color:#514c4c;border:1px solid #514c4c;cursor: pointer;"></div>
                                <p class="mb-0">
                                    <textarea style="color: #fff !important;" id="message" name="message" placeholder="Message" class="form-control form-control-sm bg-transparent"></textarea>
                                </p>
                                <p class="mb-0" style="text-align:left;">
                                    <a href="javascript:void()" class="btn btn-sm btn-outline-warning rounded-pill text-white py-2 px-3 sendMessage">
                                        Send
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
        <br>
        <div class="recentactivityDiv">
            @if($selUserId)
            @if($getData->count() > 0)
            @foreach($getData as $index => $list)

            @if($list->sender_user_id == Auth::user()->id)
            <div class="card card-light rounded-0 mb-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-2">
                        <tr>
                            <td style="float:right;border:none !important;">
                                &nbsp;{{$list->message}}
                                @if($list->profile_pic)
                                <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$list->profile_pic) }}"alt="Generic placeholder image" width="40" height="40">
                                @else
                                <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="Generic placeholder image" width="40" height="40">
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            @else

            @if(!$list->is_receiver_dismissed)
            <div class="card card-light rounded-0 mb-4">
                <div class="table-responsive">
                    <table class="table table-hover mb-2">
                        <tr>
                            <td style="border:none !important;">
                                @if($list->profile_pic)
                                <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$list->profile_pic) }}"alt="Generic placeholder image" width="40" height="40">
                                @else
                                <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="Generic placeholder image" width="40" height="40">
                                @endif
                                &nbsp;{{$list->message}}
                                <span style="float:right" >
                                    <a href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$list->id}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            @endif
            @endif

            @endforeach
            @endif
            @endif
        </div>
    </div>
</main>
@endsection
@section('script')
<script>
    $(document).ready(function () {
    $(document).on('keyup', '#toUser', function (e) {
    e.preventDefault();
    var val = $(this).val();
    if (val) {
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: '{{ route('users.search') }}',
    data: {'keyword': val},
    beforeSend: function () {
    //                        $("#collapseSearch-users").css("background", "#FFF");
    },
    success: function (data) {
    $("#suggesstion-box-users").show();
    $("#suggesstion-box-users").html(data);
    //                        $("#collapseSearch-users").css("background", "#FFF");
    }
    });
    } else {
    $("#suggesstion-box-users").html("");
    }
    });
    $(document).on('click', '.getusersList', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var val = $(this).data('name');
    if (id && val) {

    // show history
    getHistory(id);
    $('#toUser').data('id', id);
    $('#toUser').val(val);
    $("#suggesstion-box-users").hide();
    $("#message").focus();
    }
    });
    $(".sendMessage").click(function(e) {
    e.preventDefault();
    var toUser = $("#toUser").val();
    var toUserId = $('#toUser').data('id');
    var message = $("#message").val();
    if (toUserId == null){
    $("#toUser").focus();
    return false;
    }
    if (toUserId && message && toUser){
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'post',
    url: '{{ route('send.message') }}',
    data: {'toUserId': toUserId, 'message':message},
    success: function (data) {
    swal({
    text: data.message,
    title: 'Success!',
    type: data.status,
    timer: 2000,
    showCancelButton: false,
    showConfirmButton: false
    })
    if (data.status == 'success') {
    $("#message").val("");
    getHistory(toUserId);
    }
    }
    })
    }
    });

    $(".message-dismiss").click(function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    var toUserId = $('#toUser').data('id');  
    if (id){
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'post',
    url: '{{ route('send.message.dismiss') }}',
    data: {'id': id},
    success: function (data) {
    swal({
    text: data.message,
    title: 'Success!',
    type: data.status,
    timer: 2000,
    showCancelButton: false,
    showConfirmButton: false
    })
    if (data.status == 'success') {
    getHistory(toUserId);
    }
    }
    })
    }
    });

    });
    function getHistory(userId = ''){
    if (userId){
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: "POST",
    url: '{{ route('message.history') }}',
    data: {'toUserId':userId},
    success: function (data) {
    $(".recentactivityDiv").html(data);
    }
    });
    }
    }
</script>
@endsection