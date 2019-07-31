@if($messageList)
@foreach($messageList as $index => $list)

@if($list['sender_user_id'] == Auth::user()->id)
<div class="card card-light rounded-0 mb-4">
    <div class="table-responsive">
        <table class="table table-hover mb-2">
            <tr>
                <td class='whitecolor' style="float:right;border:none !important;">
                    &nbsp;{{$list['message']}}
                    @if($list['profile_pic'])
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$list['profile_pic']) }}"alt="Generic placeholder image" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="Generic placeholder image" width="40" height="40">
                    @endif
                </td>

            <span>
                <button data-type='self' data-id="{{$list['id']}}" class="btn btn-primary replayBtn">Reply</button>
            </span>
            </tr>
            @if($list['replays']->count() > 0)  
            @foreach($list['replays'] as $index => $replay)
            @if($replay->sender_user_id == $replay->receiver_user_id && $replay->sender_user_id == Auth::user()->id && !$replay->is_sender_dismissed)
            <tr>
                <td class='whitecolor' style="text-align:center;">
                    <a  style="float:right;" href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$replay->id}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    &nbsp;{{$replay->message}} 
                    <span style="font-size:12px;"><i>{{date('d-m-Y h:i A', strtotime($replay->created_at))}}</i></span>
                    @if($replay->profile_pic)
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$replay->profile_pic) }}"alt="Generic placeholder image" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="Generic placeholder image" width="40" height="40">
                    @endif
                </td>
            </tr>
            @elseif($replay->sender_user_id != $replay->receiver_user_id && $replay->sender_user_id != Auth::user()->id && !$replay->is_receiver_dismissed)
            <tr>
                <td class='whitecolor' style="text-align:center;">
                    <a  style="float:right;" href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$replay->id}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    &nbsp;{{$replay->message}} 
                    <span style="font-size:12px;"><i>{{date('d-m-Y h:i A', strtotime($replay->created_at))}}</i></span>
                    @if($replay->profile_pic)
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$replay->profile_pic) }}"alt="Generic placeholder image" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="Generic placeholder image" width="40" height="40">
                    @endif
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
                    &nbsp;{{$list['message']}}
                    <span style="float:right" >
                        <button data-type='replay'  data-id="{{$list['id']}}" class="btn btn-primary replayBtn">Reply</button>
                        <a href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$list['id']}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    </span>
                </td>
            </tr>
            @if($list['replays']->count() > 0)  
            @foreach($list['replays'] as $index => $replay)
            @if($replay->sender_user_id == $replay->receiver_user_id && $replay->sender_user_id != Auth::user()->id && !$replay->is_receiver_dismissed)
            <tr>
                <td class='whitecolor' style="text-align:center;">
                    <a  style="float:right;" href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$replay->id}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    &nbsp;{{$replay->message}} 
                    <span style="font-size:12px;"><i>{{date('d-m-Y h:i A', strtotime($replay->created_at))}}</i></span>
                    @if($replay->profile_pic)
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$replay->profile_pic) }}"alt="Generic placeholder image" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="Generic placeholder image" width="40" height="40">
                    @endif
                </td>
            </tr>
            @elseif($replay->sender_user_id != $replay->receiver_user_id && $replay->sender_user_id == Auth::user()->id && !$replay->is_sender_dismissed)
            <tr>
                <td class='whitecolor' style="text-align:center;">
                    <a  style="float:right;" href="javascript:void(0)" class="ml-3 message-dismiss" data-id="{{$replay->id}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    &nbsp;{{$replay->message}} 
                    <span style="font-size:12px;"><i>{{date('d-m-Y h:i A', strtotime($replay->created_at))}}</i></span>
                    @if($replay->profile_pic)
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$replay->profile_pic) }}"alt="Generic placeholder image" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="Generic placeholder image" width="40" height="40">
                    @endif
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