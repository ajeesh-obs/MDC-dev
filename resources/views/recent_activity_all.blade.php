@if($recentactivity->count() > 0) 
@foreach($recentactivity as $activity)
<ul class="list-unstyled text-white small mb-4">
    <li>
        <i class="icon icon-mastermind filter-gold"></i>
        {{$activity->activity}}
    </li>
</ul>
@endforeach
@endif