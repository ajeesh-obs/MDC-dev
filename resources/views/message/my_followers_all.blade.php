@if($followers->count() > 0) 
@foreach($followers as $follow)
<li class="py-1">
    <div class="d-flex flex-row align-items-center text-decoration-none px-3 py-1">
        @if($follow->profile_pic)
        <img class="rounded-circle" src="{{ asset('images/profile/thumbnail_'.$follow->profile_pic) }}" alt="" width="40" height="40">
        @else
        <img class="rounded-circle" src="{{ asset('images/profile/no-profile.png') }}" alt="" width="40" height="40">
        @endif
        <h6 class="ml-2 text-white font-weight-bold small mb-1">
            {{$follow->first_name}} {{$follow->last_name}}
        </h6>
        <a href="{{ route('connect.message', array(base64_encode($follow->user_id))) }}" class="ml-auto open-chat">
            <span class="badge bg-muted color-muted rounded-circle">
                >
            </span>
        </a>
    </div>
</li>
@endforeach
@endif