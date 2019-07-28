@if($getData->count() > 0)
@foreach($getData as $index => $list)
<div class="card card-light rounded-0 mb-4">
    <div class="table-responsive">
        <table class="table table-hover mb-2 levelListTable">
            @if($list->sender_user_id == Auth::user()->id)
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
            @else
            <tr>
                <td style="border:none !important;">
                    @if($list->profile_pic)
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/thumbnail_'.$list->profile_pic) }}"alt="Generic placeholder image" width="40" height="40">
                    @else
                    <img class="rounded-circle ml-2" src="{{ asset('images/profile/no-profile.png') }}"alt="Generic placeholder image" width="40" height="40">
                    @endif
                    &nbsp;{{$list->message}}
                </td>
            </tr>
            @endif
        </table>
    </div>
</div>
@endforeach
@endif