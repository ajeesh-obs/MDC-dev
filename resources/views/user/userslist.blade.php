@extends('layouts.app')

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
                                <a href="#" class="mr-2"><img src="img/gold-arrow-up.jpg"></a>
                                @sortablelink('first_name', 'NAME')
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <a href="#" class="mr-2"><img src="img/gold-arrow-up.jpg"></a>
                                @sortablelink('email', 'EMAIL')
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <div class="dropdown">
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
                                </div>
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <div class="dropdown">
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
                                </div>
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <div class="dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none small text-white text-decoration-none"
                                       href="#" id="tableDropdown3" role="button"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>Activity</span>
                                        <span class="smaller mt-1 float-right">▼</span>
                                    </a>
                                    <div class="dropdown-menu p-0 dropdown-menu-center dropdown-menu-sm"
                                         aria-labelledby="tableDropdown3">
                                        <div class="dropdown-item-text d-flex flex-column align-items-center px-2">
                                            <a class="dropdown-item" href="#">ACTIVE</a>
                                            <a class="dropdown-item" href="#">INACTIVE</a>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="text-white small userlisttbody">

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

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input userRoleSetting" id="{{$role->id}}" value="{{$role->id}}" data-userid="{{$user->id}}" @if($roleExists == 1)) checked @endif>
                                               <label class="custom-control-label font-weight-light" for="{{$role->id}}">{{$role->name}}</label>
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
                                <a href="{{ route('users.edit', array($user->id)) }}"><img src="img/grey-pencil.png"></a>                                        
                                <a href="javascript:void(0)" class="ml-3 user-delete" data-id="{{ $user->id }}"><img src="img/grey-trash.jpg"></a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="text-center">No Records Found!</td>
                        </tr>
                        @endif
                        <tr class="form collapse" id="collapseAddUser">
                            <td colspan="6">
                                <div class="px-2 py-3">
                                    <a data-toggle="collapse" href="#collapseAddUser" class="close text-white" role="button" aria-expanded="false" aria-controls="collapseAddUser">&times;</a>
                                    <h2 class="mb-3 font-weight-normal">Add Member</h2>
                                    <form class="w-50">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase" for="inputEmail4">First Name</label>
                                                <input type="text" class="form-control form-control-sm" id="inputEmail4" placeholder="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase" for="inputPassword4">Last Name</label>
                                                <input type="text" class="form-control form-control-sm" id="inputPassword4" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase" for="inputEmail4">Email</label>
                                                <input type="email" class="form-control form-control-sm" id="inputEmail4" placeholder="">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase" for="inputPassword4">Confirm Email</label>
                                                <input type="email" class="form-control form-control-sm" id="inputPassword4" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase" for="inputEmail4">Role</label>
                                                <select class="custom-select custom-select-sm" id="inputGroupSelect01">
                                                    <option selected>MEMBER</option>
                                                    <option value="1">ADMIN</option>
                                                    <option value="2">COACH</option>
                                                    <option value="3">STORE ADMIN</option>
                                                    <option value="3">VIDEOGRAPHER</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn accent-bg border-0 text-dark rounded-pill px-5 small font-weight-bold">Save</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--<a href="#" class="small float-right text-uppercase text-white-50" style="border:1px solid red;">-->
            {{ $users->links() }}
            <!--</a>-->
            <a class="btn btn-outline-warning rounded-pill smaller px-5" data-toggle="collapse" href="#collapseAddUser" role="button" aria-expanded="false" aria-controls="collapseAddUser">
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
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label font-weight-light"
                                           for="customCheck1">Leaderboard</label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label font-weight-light" for="customCheck1">Users</label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label font-weight-light"
                                           for="customCheck1">Enrollment</label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label font-weight-light"
                                           for="customCheck1">Financial</label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label font-weight-light" for="customCheck1">System</label>
                                </div>
                            </td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label font-weight-light" for="customCheck1">Store</label>
                                </div>
                            </td>
                        <tr>
                            @endforeach
                            @endif
                    </tbody>
                </table>
            </div>
            <a class="btn btn-outline-warning rounded-pill smaller px-5" data-toggle="collapse" href="#collapseAddUser" role="button" aria-expanded="false" aria-controls="collapseAddUser">
                + Add New</a>
        </section>
        <section class="users mb-5">
            <h2 class="mb-3 text-white">Service Providers</h2>
            <div class="table-responsive">
                <table class="table mb-2">
                    <thead class="text-white">
                        <tr>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <a href="#" class="mr-2"><img src="img/gold-arrow-up.jpg"></a>
                                UserName
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <a href="#" class="mr-2"><img src="img/gold-arrow-up.jpg"></a>
                                Email
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <a href="#" class="mr-2"><img src="img/gold-arrow-up.jpg"></a>
                                Role
                            </th>
                            <th class="text-uppercase font-weight-light" scope="col">
                                <a href="#" class="mr-2"><img src="img/gold-arrow-up.jpg"></a>
                                Location
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-white small">
                        <tr>
                            <td><img class="rounded-circle mr-3" src="img/profile6.jpg" alt="" width="25" height="25"> John
                                Doe
                            </td>
                            <td>email@example.com</td>
                            <td>
                                <span class="badge badge-primary smaller text-white px-2 py-1">VIDEOGRAPHER</span>
                            </td>
                            <td>California</td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle mr-3" src="img/profile6.jpg" alt="" width="25" height="25"> John
                                Doe
                            </td>
                            <td>email@example.com</td>
                            <td>
                                <span class="badge badge-primary smaller text-white px-2 py-1">VIDEOGRAPHER</span>
                            </td>
                            <td>Michigan</td>
                        </tr>
                        <tr>
                            <td><img class="rounded-circle mr-3" src="img/profile6.jpg" alt="" width="25" height="25"> John
                                Doe
                            </td>
                            <td>email@example.com</td>
                            <td>
                                <span class="badge badge-primary smaller text-white px-2 py-1">VIDEOGRAPHER</span>
                            </td>
                            <td>Ohio</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="#" class="btn btn-outline-warning rounded-pill smaller px-5">
                + Add New</a>
        </section>
    </div>
</main>
@endsection
