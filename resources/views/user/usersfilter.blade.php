
@if($users->count() > 0)
@foreach($users as $index => $user)
<tr>
    <td>{{ $index + 1 }}</td>
    <td> {{ $user->first_name }} {{ $user->last_name }} </td>
    <td> {{ $user->email }} </td>
    <td> </td>
    <td> </td>
    <td> 
        @if($user->is_active == 1) Active 
        @else  Inactive
        @endif 
    </td>
    <td class="text-center">
        <a href="{{ route('users.edit', array($user->id)) }}"><label class="btn btn-sm"><i class="fa fa-pencil"></i>Edit</label></a>                                        
        <a href="javascript:void(0)" class="user-delete" data-id="{{ $user->id }}">
            <label class="btn btn-sm"><i class="fa fa-trash-alt"></i>Delete</label>
        </a>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="7" class="text-center">No Records Found!</td>
</tr>
@endif
