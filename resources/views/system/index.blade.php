@extends('layouts.app_admin')

<style type="text/css">
    .displayContent{
        text-align: center;
        color: #fff !important;
        width: 60% !important;
        margin-left: 58px;
    }
    .levelsection{
        width:33% !important;
        float:left;
        min-height:62%;
    }
    .levelsection:after {
        content: "..";
    }
</style>
@section('content')

<main role="main" class="container py-5">
    <div class="px-2">
        <section class="mb-5 legacy-dash">
            <h2 class="mb-3 text-white">Level Management</h2>
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

            <!--Default level listing starts-->
            @if($levelsDefault)
            <div class="card-deck mb-4 levelsection">
                <div class="card card-dark shadow-lg p-4">
                    <form id="levelEditForm" method="POST" action="{{ route('admin.level.update') }}" enctype="multipart/form-data">
                        @csrf
                        <span> 
                            <a style="float:right;" href="javascript:void(0)" class="ml-3" onclick="document.getElementById('levelEditForm').submit();"><img src="{{ asset('img/grey-pencil.png') }}"></a>
                        </span>
                        <div class="card-body p-0 d-flex flex-column align-items-center justify-content-between"><br>
                            <h5 class="card-title font-weight-bold">
                                <input type="text" name="defaultTitle" value="{{ old('defaultTitle', $levelsDefault->title)}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Title">
                            </h5>
                            <h5 class="card-title font-weight-bold">
                                <input type="text" name="defaultLevel" value="{{ old('defaultLevel', $levelsDefault->level)}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Duration/Month">
                            </h5>
                            <br>
                            @if ($levelsDefault->badge)
                            @if (file_exists(public_path().'/images/level/'.$levelsDefault->badge))
                            <img id="eventImageUploaded" src="{{ asset('images/level/thumbnail_'.$levelsDefault->badge) }}" classc="img-thumbnail img-fluid" height="100">
                            @endif
                            @endif
                            <h5 class="card-title font-weight-bold">
                                <input type="file" name="defaultimage" class="form-control form-control-sm text-white-50 bg-transparent displayContent">
                            </h5>
                            <h5 class="card-title font-weight-bold">
                                <input type="text" name="defaultPrice" value="{{ old('defaultPrice', $levelsDefault->price)}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Price">
                            </h5>
                            <p style="margin-left: 58px;">
                                Limitations: <br>
                                <input type="checkbox">Legacy 
                                &nbsp;&nbsp;&nbsp;<input type="checkbox">Master Group <br>
                                <input type="checkbox">Connect 
                                <input type="checkbox">Messaging <br>
                                <input type="checkbox">Mindset 
                                <input type="checkbox">Master Class <br>
                            </p>
                        </div>
                        <div class="card-footer border-0 m-0 p-0">
                            <p class="small text-center text-white-50 m-0">
                                <textarea style="color: #fff !important;" placeholder="Description" name="defaultDescription" class="form-control form-control-sm bg-transparent" >{{ old('defaultDescription', $levelsDefault->description)}}</textarea>
                            </p>
                            <br>
                            <p>
                                <input type="text" name="defaultDiscountCode" value="{{ old('defaultDiscountCode', $levelsDefault->discount_code)}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Discount Code">
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            <!-- Default level listing ends -->

            <!--Level listing starts-->
            @if($levels->count() > 0)
            @foreach($levels as $index => $level)
            <div class="card-deck mb-4 levelsection">
                <div class="card card-dark shadow-lg p-4">
                    <span> 
                        <a style="float:right;" href="javascript:void(0)" class="ml-3 lavel-delete" data-id="{{ $level->id }}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                    </span>
                    <div class="card-body p-0 d-flex flex-column align-items-center justify-content-between">
                        <h5 class="card-title font-weight-bold">
                            <input type="text" value="{{ $level->title}}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                        </h5>
                        <h5 class="card-title font-weight-bold">
                            <input type="text" value="{{ $level->level}}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                        </h5>
                        @if ($level->badge)
                        @if (file_exists(public_path().'/images/level/'.$level->badge))
                        <img id="eventImageUploaded" src="{{ asset('images/level/thumbnail_'.$level->badge) }}" classc="img-thumbnail img-fluid" height="100">
                        @endif
                        @endif
                        <h5 class="card-title font-weight-bold">
                            <input type="text" value="${{ $level->price}}/year" class="form-control form-control-sm bg-transparent displayContent" readonly>
                        </h5>
                        <h5 class="card-title font-weight-bold">
                            <input type="text" value="Legacy : {{ $level->legacy }}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                        </h5>
                        <h5 class="card-title font-weight-bold">
                            <input type="text" value="coins : {{ $level->coins }}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                        </h5>
                    </div>
                     <br>
                    <div class="card-footer border-0 m-0 p-0">
                        <p class="small text-center text-white-50 m-0">
                            <font color="#fff" size="4">{{$level->description}}</font>
                        </p>
                    </div>
                    <br>
                    <div class="card-footer border-0 m-0 p-0">
                        <input type="text" value="Discount Code : {{ $level->discount_code }}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                    </div>
                </div>
            </div>

            @endforeach
            @endif

            <!--Level listing ends -->

            <!--Level create starts-->
            <div class="card-deck mb-4 levelsection">
                <div class="card card-dark shadow-lg p-4">
                    <form id="levelForm" method="POST" action="{{ route('admin.level.save') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-0 d-flex flex-column align-items-center justify-content-between">
                            <h5 class="card-title font-weight-bold">
                                <input type="text" name="title" value="{{ old('title')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Title">
                            </h5> 
                            <br>
                            <h5 class="card-title font-weight-bold">
                                <input type="text" name="level" value="{{ old('level')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Level">
                            </h5>
                            <br>
                            <h5 class="card-title font-weight-bold">
                                <input type="file" name="image" class="form-control form-control-sm text-white-50 bg-transparent displayContent">
                            </h5>
                            <br>
                            <h5 class="card-title font-weight-bold">
                                <input type="text" name="price" value="{{ old('price')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Price">
                            </h5>
                            <br>
                            <h5 class="card-title font-weight-bold">
                                <input type="text" name="legacy" value="{{ old('legacy')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Legacy">
                            </h5>
                            <br>
                            <h5 class="card-title font-weight-bold">
                                <input type="text" name="coins" value="{{ old('coins')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Coins">
                            </h5>
                            <br>
                            <h5 class="card-title font-weight-bold">
                                <textarea style="color: #fff !important;"placeholder="Description" name="description" class="form-control form-control-sm bg-transparent" >{{ old('description')}}</textarea>
                            </h5>
                            <br>
                            <h5 class="card-title font-weight-bold">
                                <input type="text" name="discount_code" value="{{ old('discount_code')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Discount Code">
                            </h5>
                        </div>
                        <br>
                        <div class="card-footer border-0 m-0 p-0">
                            <p class="small text-center text-white-50 m-0">
                                <a href="javascript:void()" class="btn btn-outline-warning rounded-pill w-50 accent" onclick="document.getElementById('levelForm').submit();">Add Level</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <!--Level create ends--> 

        </section>
    </div>
</main>
@endsection
@section('script')
<script>
    $(document).ready(function () {
    $(document).on('click', '.lavel-delete', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
    title: "Are you sure?",
    text: "Do you want to delete the level",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Yes",
    cancelButtonText: "No, cancel",
    closeOnConfirm: false,
    closeOnCancel: false
    },
    function (isConfirm) {
    if (isConfirm) {
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'delete',
    url: '/admin/level/delete/' + id,
    success: function (data) {
    swal({
    text: data.message,
    title: 'Success!',
    type: "success",
    timer: 2000,
    showCancelButton: false, //There won't be any cancle button
    showConfirmButton: false
    },
    function () {
    location.reload();
    })
    }
    });
    } else {
    swal({
    title: 'Cancelled!',
    type: "info", showConfirmButton: false, timer: 1000
    });
    e.preventDefault();
    }
    });
    });
    });
</script>
@endsection