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