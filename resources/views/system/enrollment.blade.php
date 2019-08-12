@extends('layouts.app_admin')

@section('content')
<main role="main" class="container py-5">
    <div class="px-3 py-4">
        <div class="row">
            <div class="col-md-5">
                <div class="row gutter-sm">
                    <div class="col-md-6 mb-3">
                        <div class="card card-dark p-3 d-flex flex-column align-items-center justify-content-center">
                            <h2 class="text-white font-weight-bold">Active Groups</h2>
                            <h1 class="display-4 accent-color font-weight-light">{{ count($groups) }}</h1>
                            <a href="#manageGroups" class="btn btn-sm btn-outline-warning px-4 rounded-pill accent text-uppercase">View Groups</a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card card-dark p-3 d-flex flex-column align-items-center justify-content-center">
                            <h2 class="text-white font-weight-bold">Groups Enrolling</h2>
                            <h1 class="display-4 accent-color font-weight-light">2</h1>
                            <a href="#" class="btn btn-sm btn-outline-warning px-4 rounded-pill accent text-uppercase">View Groups</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <section>
                    <h2 class="mb-3 text-white">Manage Classes</h2>
                    <div class="table-responsive">
                        <table class="table mb-2">
                            <thead class="text-white small">
                                <tr>
                                    <th class="text-uppercase font-weight-light" scope="col">
                                        <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>@sortablelink('name', 'Class Name')
                                        
                                    </th>
                                    <th class="text-uppercase text-center font-weight-light" scope="col">
                                        <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>
                                        Videographer
                                    </th>
                                    <th class="text-uppercase text-center font-weight-light" scope="col">
                                        <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>@sortablelink('price', 'Price')
                                    </th>
                                    <th class="text-uppercase font-weight-light text-right" width="30%" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="text-white small">
                                @if($classes)
                                    @foreach($classes as $class)
                                        <tr>
                                            <td>{{ $class['name'] }}</td>
                                            <td class="text-center">{{ $class['assignee'] }}</td>
                                            <td class="text-center">${{ $class['price'] }}</td>
                                            <td class="text-right">
                                                <a class="enrollment-edit" data-id="{{ $class['id'] }}" itemref="class" href="javascript:void(0);"><img src="{{ asset('img/grey-pencil.jpg') }}"></a>
                                                &nbsp;
                                                <a class="enrollment-delete" data-id="{{ $class['id'] }}" itemref="class" href="javascript:void(0);" class="ml-3"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="4">No Classes added yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    <a class="btn btn-outline-warning rounded-pill text-uppercase smaller" data-toggle="collapse"
                       href="#collapseAddClass" role="button" aria-expanded="false" aria-controls="collapseAddClass"> + Add New</a>
                    
                    <div class="mt-4 collapse hidden" id="collapseAddClass">
                        <table class="table">
                            <tr class="form bg-transparent">
                                <td class="border-0">
                                    <form class="w-75" id="enrollment-class-add" action="{{ route('admin.enrollment.add') }}" method="post">@csrf
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label class="text-uppercase small" for="name">Class Name</label>
                                                <input type="text" class="form-control form-control-sm" name="name" placeholder="Class Name">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-7">
                                                <label class="text-uppercase small" for="assigned_id">Assign Videographer</label>
                                                <select class="custom-select custom-select-sm bg-transparent border border-light" name="assigned_id">
                                                    @foreach ($videoGraphers as $videoGrapher)
                                                        <option value="{{ $videoGrapher['user_id'] }}">{{ $videoGrapher['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-6">
                                                <label class="text-uppercase small" for="publish_date">Publish Date</label>
                                                <input type="date" class="form-control form-control-sm" name="publish_date" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-5">
                                                <label class="text-uppercase small" for="price">Price</label>
                                                <input type="integer" class="form-control form-control-sm" name="price" placeholder="">
                                            </div>
                                        </div>
                                        <button type="button" itemref="class" class="btn btn-outline-warning btn-block w-75 rounded-pill py-2 px-5 btn-sm font-weight-bold text-uppercase enrollment-save">
                                            Save Class
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                </section>
                
                <hr class="border-light my-5">
                
                <section class="mb-5">
                    <h2 class="mb-3 text-white" id="manageGroups">Manage Groups</h2>
                    <div class="table-responsive">
                        <table class="table mb-2">
                            <thead class="text-white small">
                                <tr>
                                    <th class="text-uppercase font-weight-light" scope="col">
                                        <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>@sortablelink('name', 'Group Name')
                                    </th>
                                    <th class="text-uppercase text-center font-weight-light" scope="col">
                                        <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>Coach
                                    </th>
                                    <th class="text-uppercase text-center font-weight-light" scope="col">
                                        <a href="#" class="mr-2"><img src="{{ asset('img/gold-arrow-up.jpg') }}"></a>@sortablelink('price', 'Price')
                                    </th>
                                    <th class="text-uppercase font-weight-light text-right" width="30%" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="text-white small">
                                @if($groups)
                                    @foreach($groups as $group)
                                        <tr>
                                            <td>{{ $group['name'] }}</td>
                                            <td class="text-center">{{ $group['assignee'] }}</td>
                                            <td class="text-center">${{ $group['price'] }}</td>
                                            <td class="text-right">
                                                <a class="enrollment-edit" data-id="{{ $class['id'] }}" itemref="Group" href="javascript:void(0);"><img src="{{ asset('img/grey-pencil.jpg') }}"></a>
                                                &nbsp;
                                                <a class="enrollment-delete" data-id="{{ $class['id'] }}" itemref="Group" href="javascript:void(0);" class="ml-3"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="4">No Groups added yet</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <a class="btn btn-outline-warning rounded-pill text-uppercase smaller" data-toggle="collapse"
                       href="#collapseAddGroup" role="button" aria-expanded="false" aria-controls="collapseAddGroup">+ Add New</a>
                    
                    <div class="mt-4 collapse hidden" id="collapseAddGroup">
                        <table class="table">
                            <tr class="form bg-transparent">
                                <td class="border-0">
                                    <!--<form class="w-75">-->
                                    <form class="w-75" id="enrollment-group-add" action="{{ route('admin.enrollment.add') }}" method="post">@csrf    
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label class="text-uppercase small" for="name">Group Name</label>
                                                <input type="text" class="form-control form-control-sm" name="name" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase small" for="min_users">Set Minimum Users</label>
                                                <div class="d-flex flex-row align-items-center w-75">
                                                    <input type="integer" class="form-control form-control-sm" name="min_users" placeholder="">
                                                    <!--<a href="#" class="ml-3"><img src="{{ asset('img/gold-minus-mini.jpg') }}"></a>-->
                                                    <!--<a href="#" class="ml-2"><img src="{{ asset('img/gold-plus-mini.jpg') }}"></a>-->
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase small" for="max_users">Set Maximum Users</label>
                                                <div class="d-flex flex-row align-items-center w-75">
                                                    <input type="integer" class="form-control form-control-sm" name="max_users" placeholder="">
                                                    <!--<a href="#" class="ml-3"><img src="{{ asset('img/gold-minus-mini.jpg') }}"></a>-->
                                                    <!--<a href="#" class="ml-2"><img src="{{ asset('img/gold-plus-mini.jpg') }}"></a>-->
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase small" for="assigned_id">Assign Coach</label>
                                                <select class="custom-select custom-select-sm bg-transparent border border-light" name="assigned_id">
                                                    @foreach ($coaches as $coach)
                                                        <option value="{{ $coach['user_id'] }}">{{ $coach['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase small" for="duration">Set Duration</label>
                                                <select class="custom-select custom-select-sm bg-transparent border border-light" name="duration">
                                                    <option value="one_week">ONE WEEK</option>
                                                    <option value="two_week">TWO WEEK</option>
                                                    <option value="one_month">ONE MONTH</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase small" for="start_date">Start Date</label>
                                                <input type="date" class="form-control form-control-sm" name="start_date" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="text-uppercase small" for="publish_date">Publish Date</label>
                                                <input type="date" class="form-control form-control-sm" name="publish_date" placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label class="text-uppercase small" for="price">Price</label>
                                                <input type="text" class="form-control form-control-sm" name="price" placeholder="">
                                            </div>
                                        </div>
                                        
                                        <button type="button" itemref="group" class="btn btn-outline-warning btn-block w-75 rounded-pill py-2 px-5 btn-sm font-weight-bold text-uppercase enrollment-save">
                                            Save Class
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection
@section('script')
    @include('system.script_enrollment')
@endsection
