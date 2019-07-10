@if($users->count() > 0)
@foreach($users as $index => $user)
<tr class="hover-permission">
    <td> 
        <img class="rounded-circle mr-3" src="img/profile6.jpg" alt="" width="25" height="25">
        {{ $user->first_name }} {{ $user->last_name }} 
    </td>
    <td> {{ $user->email }} </td>
    <td class="text-center"> <img src="img/badge-coach.png" height="30"></td>
    <td>

        @if($userRoles > 0)
        @foreach($userRoles as $usrRole)
        @if($usrRole['user_id'] == $user->id)
        <span class="badge badge-info smaller text-white px-2 py-1">{{$usrRole['role_name']}}</span>
        @endif
        @endforeach
        @endif
        <!--<span class="badge badge-warning smaller text-white px-2 py-1">MEMBER</span>-->
        <!--<span class="badge badge-danger smaller text-white px-2 py-1">ADMIN</span>-->
        <!--<span class="badge badge-info smaller text-white px-2 py-1">COACH</span>-->
        <!--<span class="badge badge-success smaller text-white px-2 py-1">STORE ADMIN</span>-->
        <div class="permission-select mt-3 d-none">
            <div class="small mb-2">Permissions:</div>

            @if($roles->count() > 0)
            @foreach($roles as $role)


            <?php $roleExists = 0; ?>
            @if($userRoleRelations->count() > 0)
            @foreach($userRoleRelations as $index5 => $userole)
            @if($userole->user_id == $user->id and  $userole->role_id == $role->id)
            <?php $roleExists = 1; ?>   
            @endif
            @endforeach
            @endif

            <div class="">
                <input type="checkbox" class="userRoleSetting" id="{{$role->id}}" value="{{$role->id}}" data-userid="{{$user->id}}" @if($roleExists == 1)) checked @endif>
                       <label class="custom-control-label1 font-weight-light" for="{{$role->id}}">{{$role->name}}</label>
            </div>
            @endforeach
            @endif
        </div>
    </td>
    <td> 
        @if($user->is_active == 1) Active 
        @else  Inactive
        @endif 
    </td>
    <td>
        <a href="javascript:void(0)" style="cursor: pointer;" class="edituser" data-id="{{$user->id}}" data-email="{{$user->email}}" data-lname="{{$user->last_name}}" data-fname="{{$user->first_name}}"><img src="img/grey-pencil.png"></a> 
        <a href="javascript:void(0)" class="ml-3 user-delete" data-id="{{ $user->id }}"><img src="img/grey-trash.jpg"></a>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="6" class="text-center">No Records Found!</td>
</tr>
@endif