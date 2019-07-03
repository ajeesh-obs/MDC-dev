@extends('layouts.app')

<style type="text/css">

    table tr td{
        color:#fff;
    }
    table th{
        background-color:#777373 !important; 
    }
    .fa-pencil-alt {
        color: red !important;
    }
</style>
@section('content')

<main role="main" class="container py-5">
    <div class="d-flex flex-column align-items-center">
        <div class="w-100 px-7">
            <div>
                <section class="mb-5">
                    <h1 class="mb-4">User Management</h1>

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
                        <table class="table align-items-center table-flush table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">@sortablelink('id', 'SL NO')</th> 
                                    <th scope="col">@sortablelink('first_name', 'NAME')</th>
                                    <th scope="col">@sortablelink('email', 'EMAIL')</th> 
                                    <th scope="col">LEVEL</th>
                                    <th scope="col">ROLE</th>
                                    <th scope="col">
                                        <!--ACTIVITY-->
                                        <select class="form-control form-control-sm text-white-50 userActivityFilter" name="userActivityFilter">
                                            <option value="all">ACTIVITY</option>
                                            <option value="1">ACTIVE</option>
                                            <option value="2">INACTIVE</option>
                                        </select>
                                    </th>
                                    <th scope="col"></th>                                
                                </tr>
                            </thead>
                            <tbody class="userlisttbody">
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
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
                </section>

                <section class="mb-5">
                    <h1 class="mb-4">Role Permissions</h1>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-striped">
                            <tbody>
                                @if($roles->count() > 0)
                                @foreach($roles as $index2 => $role)
                                <tr>
                                    <td> {{ $role->name }} </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="text-center float-left">
                            <a href ="{{ route('role.create') }}" class="btn btn-outline-warning rounded-pill px-5 py-2 w-10 text-uppercase btn-sm">
                                Add New
                            </a>
                        </div>
                        <div class="text-center float-left">
                            <a href ="{{ route('module.create') }}" class="btn btn-outline-warning rounded-pill px-5 py-2 w-10 text-uppercase btn-sm">
                                Add New Module
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
