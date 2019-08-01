@extends('layouts.app_admin')

@section('content')

<main role="main" class="container">
    <div class="px-3 py-4">
        <section class="users mb-5">
            <h2 class="mb-3 text-white">User Management</h2>
            @if ($errors->any())
            <div class="alert alert-danger displayMsgDiv">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(session()->has('message'))
            <div class="alert alert-success displayMsgDiv">
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover mb-2">
                    <thead class="text-white">
                        <tr>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>
                                @sortablelink('first_name', 'NAME')
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>
                                @sortablelink('email', 'EMAIL')
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">

                                <select class="form-control form-control-sm text-white-50 userLevelFilter" name="userLevelFilter">
                                    <option value="all">Level</option>
                                    <option value="PREMIUM">PREMIUM</option>
                                    <option value="SILVER">SILVER</option>
                                    <option value="GOLD">GOLD</option>
                                    <option value="INVESTOR BANKER">INVESTOR BANKER</option>
                                </select>

                                <!--                                <div class="dropdown">
                                                                    <a class="nav-link dropdown-toggle arrow-none small text-white text-decoration-none"
                                                                       href="#" id="tableDropdown1" role="button"
                                                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <span>Level</span>
                                                                        <span class="smaller mt-1 float-right">▼</span>
                                                                    </a>
                                                                    <div class="dropdown-menu p-0 dropdown-menu-center dropdown-menu-sm"
                                                                         aria-labelledby="tableDropdown1">
                                                                        <div class="dropdown-item-text d-flex flex-column align-items-center px-2">
                                                                            <a class="dropdown-item" href="#">PREMIUM</a>
                                                                            <a class="dropdown-item" href="#">SILVER</a>
                                                                            <a class="dropdown-item" href="#">GOLD</a>
                                                                            <a class="dropdown-item" href="#">INVESTOR BANKER</a>
                                                                            <a class="dropdown-item" href="#">INVESTOR BANKER</a>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <select class="form-control form-control-sm text-white-50 userRoleFilter" name="userRoleFilter">
                                    <option value="all">Role</option>
                                    @if($roles->count() > 0)
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <!--                                <div class="dropdown">
                                                                    <a class="nav-link dropdown-toggle arrow-none small text-white text-decoration-none"
                                                                       href="#" id="tableDropdown2" role="button"
                                                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <span>Role</span>
                                                                        <span class="smaller mt-1 float-right">▼</span>
                                                                    </a>
                                                                    <div class="dropdown-menu p-0 dropdown-menu-center dropdown-menu-sm"
                                                                         aria-labelledby="tableDropdown2">
                                                                        <div class="dropdown-item-text d-flex flex-column align-items-center px-2">
                                                                            @if($roles->count() > 0)
                                                                            @foreach($roles as $roleindex => $role)
                                                                            <a class="dropdown-item" href="">{{ $role->name }}</a>
                                                                            @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <select class="form-control form-control-sm text-white-50 userActivityFilter" name="userActivityFilter">
                                    <option value="all">ACTIVITY</option>
                                    <option value="1">ACTIVE</option>
                                    <option value="2">INACTIVE</option>
                                </select>
                                <!--                                <div class="dropdown">
                                                                    <a class="nav-link dropdown-toggle arrow-none small text-white text-decoration-none"
                                                                       href="#" id="tableDropdown3" role="button"
                                                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <span>Activity</span>
                                                                        <span class="smaller mt-1 float-right">▼</span>
                                                                    </a>
                                                                    <div class="dropdown-menu p-0 dropdown-menu-center dropdown-menu-sm" aria-labelledby="tableDropdown3">
                                                                        <div class="dropdown-item-text d-flex flex-column align-items-center px-2">
                                                                            <a class="dropdown-item" href="#">ACTIVE</a>
                                                                            <a class="dropdown-item" href="#">INACTIVE</a>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="text-white small userlisttbody">

                        @if($users->count() > 0)
                        @foreach($users as $index => $user)
                        <tr class="hover-permission">
                            <td> 
                                <img class="rounded-circle mr-3" src="{{ asset('img/profile6.jpg') }}" alt="" width="25" height="25">
                                {{ str_limit($user->first_name, $limit = 20, $end = '...') }} {{ str_limit($user->last_name, $limit = 15, $end = '...') }}
                            </td>
                            <td> {{ $user->email }} </td>
                            <td class="text-center"> <img src="{{ asset('img/badge-coach.png') }}" height="30"></td>
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
                                <a href="javascript:void(0)" style="cursor: pointer;" class="edituser" data-id="{{$user->id}}" data-email="{{$user->email}}" data-lname="{{$user->last_name}}" data-fname="{{$user->first_name}}"><img src="{{ asset('img/grey-pencil.png') }}"></a>                                        
                                <a href="javascript:void(0)" class="ml-3 user-delete" data-id="{{ $user->id }}" data-currentactivity="{{ $user->is_active }}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center">No Users Found</td>
                        </tr>
                        @endif
                    </tbody>
                    <tr class="form collapse addMemberDiv" id="collapseAddUser"> 
                        <td colspan="6">
                            <div class="px-2 py-3">
                                <a data-toggle="collapse" href="#collapseAddUser" class="close text-white addMemberCloseBtn" role="button" aria-expanded="false" aria-controls="collapseAddUser">&times;</a>
                                <h2 class="mb-3 font-weight-normal">Add Member</h2>
                                <form class="w-50">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputEmail4">First Name</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="First Name" name="firstName" id="firstName">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputPassword4">Last Name</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Last Name" name="lastName" id="lastName">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputEmail4">Email</label>
                                            <input type="email" class="form-control form-control-sm" placeholder="Email" name="email" id="email">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputPassword4">Confirm Email</label>
                                            <input type="email" class="form-control form-control-sm" placeholder="Confirm Email" name="confirmEmail" id="confirmEmail">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputEmail4">Role</label>
                                            <select class="custom-select custom-select-sm" id="userRole" name="userRole">
                                                @if($roles->count() > 0)
                                                @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <button type="button" id="saveMemberBtn" class="btn accent-bg border-0 text-dark rounded-pill px-5 small font-weight-bold">Save</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <tr class="form" id="collapseEditUser" style="display:none;"> 
                        <td colspan="6">
                            <div class="px-2 py-3">
                                <a data-toggle="collapse" href="#collapseEditUser" class="close text-white editMemberCloseBtn" role="button" aria-expanded="false" aria-controls="collapseEditUser">&times;</a>
                                <h2 class="mb-3 font-weight-normal">Edit User</h2>
                                <form class="w-50">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputEmail4">First Name</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="First Name" name="editUserfirstName" id="editUserfirstName">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputPassword4">Last Name</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Last Name" name="editUserlastName" id="editUserlastName">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputEmail4">Email</label>
                                            <input type="email" class="form-control form-control-sm" placeholder="Email" name="editUseremail" id="editUseremail" readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" name="editUserid" id="editUserid">
                                    <button type="button" id="editUserBtn" class="btn accent-bg border-0 text-dark rounded-pill px-5 small font-weight-bold">Save</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <!--<a href="#" class="small float-right text-uppercase text-white-50" style="border:1px solid red;">-->
            {{ $users->links() }}
            <!--</a>-->
            <a class="btn btn-outline-warning rounded-pill smaller px-5 addMemberAddBtn" data-toggle="collapse" href="#collapseAddUser" role="button" aria-expanded="false" aria-controls="collapseAddUser">
                + Add New</a>
        </section>
        <section class="users mb-5">
            <h2 class="mb-3 text-white">Role Permissions</h2>
            <div class="table-responsive">
                <table class="table mb-2">
                    <thead class="text-white">
                        <tr>
                            <th class="text-uppercase font-weight-light" width="20%" scope="col"></th>
                            <th class="text-uppercase font-weight-light" scope="col"></th>
                            <th class="text-uppercase font-weight-light" scope="col"></th>
                            <th class="text-uppercase font-weight-light" scope="col"></th>
                            <th class="text-uppercase font-weight-light" scope="col"></th>
                            <th class="text-uppercase font-weight-light" scope="col"></th>
                            <th class="text-uppercase font-weight-light" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="text-white small">
                        @if($roles->count() > 0)
                        @foreach($roles as $role)
                        <tr>
                            <td> {{ $role->name }} </td>
                            @if($modules->count() > 0)
                            @foreach($modules as $module)

                            <?php $permissionExists = 0; ?>
                            @if($modulePermissions->count() > 0)
                            @foreach($modulePermissions as $modlePermsion)
                            @if($modlePermsion->module_id == $module->id and  $modlePermsion->role_id == $role->id)
                            <?php $permissionExists = 1; ?>   
                            @endif
                            @endforeach
                            @endif

                            <td>
                                <div class="">
                                    <input type="checkbox" class="roleModulePermissionSetting" id="{{$module->id}}" value="{{$module->id}}" data-roleid="{{$role->id}}" @if($permissionExists == 1)) checked @endif>
                                           <label class="custom-control-label1 font-weight-light" for="{{$module->id}}">{{$module->module_name}}</label>
                                </div>
                            </td>
                            @endforeach
                            @endif
                        </tr>
                        @endforeach
                        @endif
                        <tr class="form collapse" id="collapseAddRole"> 
                            <td colspan="7">
                                <div class="px-2 py-3">
                                    <a data-toggle="collapse" href="#collapseAddRole" class="close text-white addRoleCloseBtn" role="button" aria-expanded="false" aria-controls="collapseAddRole">&times;</a>
                                    <h2 class="mb-3 font-weight-normal">Add Role</h2>
                                    <form class="w-50">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase" for="inputEmail4">Role Name</label>
                                                <input type="text" class="form-control form-control-sm" placeholder="Role Name" name="roleName" id="roleName">
                                            </div>

                                        </div>
                                        <div class="">
                                            <input type="checkbox" class="" id="is_service_provider" value="1" name="is_service_provider">
                                            <label class="custom-control-label1 font-weight-light" for="is_service_provider">Service Provider</label>
                                        </div>
                                        <button type="button" id="saveRoleBtn" class="btn accent-bg border-0 text-dark rounded-pill px-5 small font-weight-bold">Save</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a class="btn btn-outline-warning rounded-pill smaller px-5 addRoleBtn" data-toggle="collapse" href="#collapseAddRole" role="button" aria-expanded="false" aria-controls="collapseAddRole">
                + Add New</a>
        </section>
        <section class="users mb-5">
            <h2 class="mb-3 text-white">Service Providers</h2>
            <div class="table-responsive">
                <table class="table mb-2">

                    <tr class="form" id="collapseEditMember" style="display:none;"> 
                        <td colspan="6">
                            <div class="px-2 py-3">
                                <a data-toggle="collapse" href="#collapseEditMember" class="close text-white editServiceProvidersCloseBtn" role="button" aria-expanded="false" aria-controls="collapseEditMember">&times;</a>
                                <h2 class="mb-3 font-weight-normal">Edit Service Provider</h2>
                                <form class="w-50">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputEmail4">First Name</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="First Name" name="editServiceProviderfirstName" id="editServiceProviderfirstName">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputPassword4">Last Name</label>
                                            <input type="text" class="form-control form-control-sm" placeholder="Last Name" name="editServiceProviderlastName" id="editServiceProviderlastName">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label class="text-uppercase" for="inputEmail4">Email</label>
                                            <input type="email" class="form-control form-control-sm" placeholder="Email" name="editServiceProvideremail" id="editServiceProvideremail" readonly>
                                        </div>
                                    </div>
                                    <input type="hidden" name="editServiceProviderid" id="editServiceProviderid">
                                    <button type="button" id="editServiceProviderBtn" class="btn accent-bg border-0 text-dark rounded-pill px-5 small font-weight-bold">Save</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <thead class="text-white">
                        <tr>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>
                                @sortablelink('first_name', 'NAME')
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>
                                @sortablelink('email', 'EMAIL')
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <!--<a href="#" class="mr-2"><img src="img/gold-arrow-up.jpg"></a>-->
                                Role
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>
                                Location
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-white small">
                        @if($serviceProviders->count() > 0)
                        @foreach($serviceProviders as $serviceProvider)
                        <tr>
                            <td><img class="rounded-circle mr-3" src="{{ asset('img/profile6.jpg') }}" alt="" width="25" height="25">
                                <a style="cursor: pointer;" class="editmember" data-email="{{$serviceProvider->email}}" data-id="{{$serviceProvider->id}}" data-lname="{{$serviceProvider->last_name}}" data-fname="{{$serviceProvider->first_name}}">
                                    {{ str_limit($serviceProvider->first_name, $limit = 15, $end = '...') }} {{ str_limit($serviceProvider->last_name, $limit = 15, $end = '...') }}
                                </a>
                            </td>
                            <td>
                                {{ $serviceProvider->email }}
                            </td>
                            <td>
                                @if ($serviceProvider->name != "")
                                @foreach(explode(',', $serviceProvider->name) as $providerRole) 
                                <span class="badge badge-primary smaller text-white px-2 py-1">{{$providerRole}}</span>   
                                @endforeach
                                @endif
                    <!--<span class="badge badge-primary smaller text-white px-2 py-1">{{$serviceProvider->name}}</span>-->
                            </td>
                            <td></td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">No Records Found!</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>
@endsection