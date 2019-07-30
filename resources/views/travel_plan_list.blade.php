<table class="table table-hover mb-2">
    <thead>
        <tr>
            <th  style="color:#ebc243;">Location</th>
            <th  style="color:#ebc243;">Depart</th>
            <th  style="color:#ebc243;">Return</th>
            <th  style="color:#ebc243;">Status</th>
            <th  style="color:#ebc243;"></th>
        </tr>
    </thead>
    <tbody>
        @if($travelPlans->count() > 0)  
        @foreach($travelPlans as $index => $travelPlan)
        <tr>
            <td  style="color:#fff;">{{$travelPlan->travel_location}}</td>
            <td  style="color:#fff;">{{$travelPlan->travel_depart}}</td>
            <td  style="color:#fff;">{{$travelPlan->travel_deturn}}</td>
            <td  style="color:#fff;">{{$travelPlan->travel_status}}</td>
            <td  style="color:#fff;">
                <a href="javascript:void(0)" class="ml-3 delete-travel-plan" data-id="{{$travelPlan->id}}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                <a href="javascript:void(0)" class="ml-3 edit-travel-plan" data-location="{{$travelPlan->travel_location}}" data-id="{{$travelPlan->id}}" data-return="{{$travelPlan->travel_deturn}}" data-depart="{{$travelPlan->travel_depart}}" >
                    <img src="{{ asset('img/grey-pencil.png') }}">
                </a>
            </td>
        </tr>
        @endforeach
        @else
        <tr><td style="color:#fff;text-align:center;" colspan="5">No details found</td></tr>
        @endif
    </tbody>
</table>