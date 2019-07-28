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
                                    <input id="toUser" name="toUser" type="text" placeholder="To" class="form-control form-control-sm text-white-50 bg-transparent locationText">
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
        <div class="recentactivityDiv"></div>
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
    $("#suggesstion-box").html("");
    }
    });
    $(document).on('click', '.getusersList', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var val = $(this).data('name');
    if (id && val) {

    // show history
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            type: "POST",
            url: '{{ route('message.history') }}',
            data: {'toUserId':id},
            success: function (data) {
            $(".recentactivityDiv").html(data);
            }
    });
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
    if (toUserId && message){
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
            setTimeout(function(){
            window.location.reload();
            }, 1000);
            }
            }
    })
    }
    });
    });
</script>
@endsection