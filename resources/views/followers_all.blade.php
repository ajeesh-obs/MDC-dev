@if($followers->count() > 0) 
@foreach($followers as $follower)
<li class="list-inline-item">
    <img title="{{$follower->first_name}} {{$follower->last_name}}" @if ($follower->profile_pic) src="{{ asset('images/profile/thumbnail_'.$follower->profile_pic) }}"  @else src="{{ asset('images/profile/no-profile.png') }}" @endif alt="Generic placeholder image" width="50" height="50">
</li>
@endforeach
@endif