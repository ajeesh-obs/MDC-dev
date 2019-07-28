@if($usersList > 0) 
@foreach($usersList as $index => $user)
<div class="card card-light rounded-0 mb-4">
    <div class="card-body p-3">
        <div class="bg-cover bg-center mx-auto rounded-circle position-relative mb-3" @if ($user['image']) style="background-image: url('/images/profile/thumbnail_{{$user['image']}}');width: 140px; height: 140px;" @else style="background-image: url('/images/profile/no-profile.png'); width: 140px; height: 140px;"  @endif>
             <a tabindex="0" href="#" class="position-absolute" data-toggle="popover" data-placement="bottom" title="Level 3: Lorem ipsum" data-content="<a class='small text-muted' href='#'>LEARN MORE</a>" style="bottom: 0; left: 0">
                 <!--<img src="{{ asset('img/badge-coach.png') }}" height="64">-->
            </a>
        </div>
        <div class="d-flex flex-row justify-content-between align-items-center mb-2">
            <a href="{{ route('other.profile.view', array(base64_encode($user['id']))) }}" style="cursor: pointer;">
                <h5 class="card-title font-weight-bold mb-0">{{$user['name']}}</h5>
            </a>
            @if($user['isFollowing']) 
            <a tabindex="0" id="user-following" href="javascript://"
               class="text-uppercase text-white bg-transparent border-0 small followingList" data-placement="top" data-popover-content="#user-following-popover-content{{$user['id']}}">
                Following
            </a>
            <div id="user-following-popover-content{{$user['id']}}" class="d-none followingLists">
                <ul class="list-inline m-0 following-list d-flex flex-row-reverse">

                    @if($user['latestFollowings']->count() > 0) 
                    @foreach($user['latestFollowings'] as $latestFollowing)
                    <li class="list-inline-item">
                        <a class='' href='javascript://'>
                            <img title="{{$latestFollowing->first_name}} {{$latestFollowing->last_name}}" class="rounded-circle" width="24" height="24" @if ($latestFollowing->profile_pic) src="{{ asset('images/profile/thumbnail_'.$latestFollowing->profile_pic) }}" @else src="{{ asset('images/profile/no-profile.png') }}" @endif>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
            @else 
            <a class="text-uppercase text-white bg-transparent border-0 small">
                Follow
            </a>
            @endif
        </div>
        <p class="card-text">
            <b>Expertise: </b>
            <span class="text-white-50">
                <!--{{$user['expertise']}}--> 
                {{ str_limit($user['expertise'], $limit = 19, $end = '...') }}
            </span>
        </p>
    </div>
    <div class="card-footer">
        <ul class="list-inline small m-0 text-uppercase d-flex flex-row justify-content-around">
            <li class="list-inline-item">
                <a href="#" class="text-muted">{{$user['followersCount']}} Followers</a>
            </li>
            <li class="list-inline-item">
                <a href="{{ route('connect.message', array(base64_encode($user['id']))) }}" class="text-muted">Messages</a>
            </li>
        </ul>
    </div>
</div>
@endforeach
@endif