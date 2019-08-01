@if($messageList)
@foreach($messageList as $index => $list)

@if($list['sender_user_id'] == Auth::user()->id)
<div class="card card-light rounded-0 mb-4">
    <div class="table-responsive">
        <table class="table table-hover mb-2">
            <tr>
                <td class='whitecolor' style="border:none !important;">

                    @if($list['profile_pic'])
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$list['profile_pic']) }}"alt="" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="" width="40" height="40">
                    @endif
                    <span>{{$list['name']}}</span> 
                    <span style="font-size:12px;"><i>{{date('d-m-Y h:i A', strtotime($list['created_at']))}}</i></span>
                    <br>
                    <span class="boldClass">&nbsp;{{$list['message']}}</span>
                </td>
                <td class='whitecolor' style="border:none !important;">
                    <span style="float:right;">
                        <a href="javascript:void()" data-type='self' data-id="{{$list['id']}}" class="btn btn-sm btn-outline-warning rounded-pill text-white py-2 px-3 replayBtn">Reply</a>
                    </span>
                </td>
            </tr>
            @if($list['replays']->count() > 0)  
            @foreach($list['replays'] as $index => $replay)
            @if($replay->sender_user_id == $replay->receiver_user_id && $replay->sender_user_id == Auth::user()->id && !$replay->is_sender_dismissed)
            <tr>
                <td class='whitecolor' style="border:none !important;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    @if($replay->profile_pic)
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$replay->profile_pic) }}"alt="" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="" width="40" height="40">
                    @endif
                    <span>{{$replay->first_name}} {{$replay->last_name}}</span> 
                    <span style="font-size:12px;"><i>{{date('d-m-Y h:i A', strtotime($replay->created_at))}}</i></span>
                    <!--<br>-->
                    &nbsp;{{$replay->message}} 
                </td>
                <td class='whitecolor' style="border:none !important;">
                    <span style="float:right;">
                        <a href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$replay->id}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    </span>
                </td>
            </tr>
            @elseif($replay->sender_user_id != $replay->receiver_user_id && $replay->sender_user_id != Auth::user()->id && !$replay->is_receiver_dismissed)
            <tr>
                <td class='whitecolor' style="border:none !important;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    @if($replay->profile_pic)
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$replay->profile_pic) }}"alt="" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="" width="40" height="40">
                    @endif
                    <span>{{$replay->first_name}} {{$replay->last_name}}</span> 
                    <span style="font-size:12px;"><i>{{date('d-m-Y h:i A', strtotime($replay->created_at))}}</i></span>
                    <!--<br>-->
                    &nbsp;{{$replay->message}} 
                </td>
                <td class='whitecolor' style="border:none !important;">
                    <span style="float:right;">
                        <a href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$replay->id}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    </span>
                </td>
            </tr>
            @endif
            @endforeach
            @endif
        </table>
    </div>
</div>
@else

@if(!$list['is_receiver_dismissed'])
<div class="card card-light rounded-0 mb-4">
    <div class="table-responsive">
        <table class="table table-hover mb-2">
            <tr>
                <td class='whitecolor' style="border:none !important;">
                    @if($list['profile_pic'])
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$list['profile_pic']) }}"alt="Generic placeholder image" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="Generic placeholder image" width="40" height="40">
                    @endif
                    <span>{{$list['name']}}</span> 
                    <span style="font-size:12px;"><i>{{date('d-m-Y h:i A', strtotime($list['created_at']))}}</i></span>
                    <br>
                    <span class="boldClass">&nbsp;{{$list['message']}}</span>
                </td>
                <td class='whitecolor' style="border:none !important;">
                    <span style="float:right;">
                        <a href="javascript:void()" data-type='replay' data-id="{{$list['id']}}" class="btn btn-sm btn-outline-warning rounded-pill text-white py-2 px-3 replayBtn">Reply</a>
                        <a href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$list['id']}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    </span>
                </td>
            </tr>
            @if($list['replays']->count() > 0)  
            @foreach($list['replays'] as $index => $replay)
            @if($replay->sender_user_id == $replay->receiver_user_id && $replay->sender_user_id != Auth::user()->id && !$replay->is_receiver_dismissed)
            <tr>
                <td class='whitecolor' style="border:none !important;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    @if($replay->profile_pic)
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$replay->profile_pic) }}"alt="" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="" width="40" height="40">
                    @endif
                    <span>{{$replay->first_name}} {{$replay->last_name}}</span> 
                    <span style="font-size:12px;"><i>{{date('d-m-Y h:i A', strtotime($replay->created_at))}}</i></span>
                    <!--<br>-->
                    &nbsp;{{$replay->message}} 
                </td> 
                <td class='whitecolor' style="border:none !important;">
                    <span style="float:right;">
                        <a href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$replay->id}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    </span>
                </td>
            </tr>
            @elseif($replay->sender_user_id != $replay->receiver_user_id && $replay->sender_user_id == Auth::user()->id && !$replay->is_sender_dismissed)
            <tr>
                <td class='whitecolor' style="border:none !important;">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    @if($replay->profile_pic)
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$replay->profile_pic) }}"alt="" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="" width="40" height="40">
                    @endif
                    <span>{{$replay->first_name}} {{$replay->last_name}}</span> 
                    <span style="font-size:12px;"><i>{{date('d-m-Y h:i A', strtotime($replay->created_at))}}</i></span>
                    <!--<br>-->
                    &nbsp;{{$replay->message}} 
                </td> 
                <td class='whitecolor' style="border:none !important;">
                    <span style="float:right;">
                        <a href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$replay->id}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    </span>
                </td>
            </tr>
            @endif
            @endforeach
            @endif
        </table>
    </div>
</div>
@endif
@endif

@endforeach
@endif