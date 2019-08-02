@extends('layouts.app_admin')

<style type="text/css">

    .sectionDiv {
        width:33%;
        float:left;
        background-color: #2D2929 !important;
        min-height: 80% !important;
        border:1px solid #fff;
    }
    .centerAlign {
        text-align: center;
        font-weight: bold;
    }
    .displayContent{
        text-align: center;
        color: #fff !important;
        width: 60% !important;
        margin-left: 58px;
        /*border: 1px solid red;*/
    }
    .borderNone{
        border:none !important;
    }
</style>

@section('content')

<main role="main" class="container">
    <div class="px-3 py-4">
        <section class="users mb-5">
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
            <div class="sectionDiv">
                <div class="table-responsive">
                    <form id="levelEditForm" method="POST" action="{{ route('admin.level.update') }}" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-hover mb-2 levelListTable">
                            <tr>
                                <td style="float:right;" class="borderNone">
                                    <a href="javascript:void(0)" class="ml-3" onclick="document.getElementById('levelEditForm').submit();"><img src="{{ asset('img/grey-pencil.png') }}"></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="centerAlign borderNone">
                                    <input type="text" name="defaultTitle" value="{{ old('defaultTitle', $levelsDefault->title)}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Title">
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <input type="text" name="defaultLevel" value="{{ old('defaultLevel', $levelsDefault->level)}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Duration/Month">
                                </td>
                            </tr>
                            <tr>
                                <td class="centerAlign borderNone"> 
                                    @if ($levelsDefault->badge)
                                    @if (file_exists(public_path().'/images/level/'.$levelsDefault->badge))
                                    <img id="eventImageUploaded" src="{{ asset('images/level/thumbnail_'.$levelsDefault->badge) }}" classc="img-thumbnail img-fluid" height="150" width="150">
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <input type="file" name="defaultimage" class="form-control form-control-sm text-white-50 bg-transparent displayContent">
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <input type="text" name="defaultPrice" value="{{ old('defaultPrice', $levelsDefault->price)}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Price">
                                </td>
                            </tr>
                            <tr stylec="display:none;">
                                <td class="borderNone">
                                    <p style="margin-left: 58px;">
                                        Limitations: <br>
                                        <input type="checkbox">Legacy <br>
                                        <input type="checkbox">Master Group <br>
                                        <input type="checkbox">Messaging <br>
                                        <input type="checkbox">Connect <br>
                                        <input type="checkbox">Master Class <br>
                                        <input type="checkbox">Mindset <br>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <textarea style="color: #fff !important;" name="defaultDescription" class="form-control form-control-sm bg-transparent" >{{ old('defaultDescription', $levelsDefault->description)}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <input type="text" name="defaultDiscountCode" value="{{ old('defaultDiscountCode', $levelsDefault->discount_code)}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Discount Code">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            @endif
            <!-- Default level listing ends -->

            <!--Level listing starts-->
            @if($levels->count() > 0)
            @foreach($levels as $level)
            <div class="sectionDiv">
                <div class="table-responsive">
                    <table class="table table-hover mb-2 levelListTable">
                        <tr>
                            <td style="float:right;" class="borderNone">
                                @if (!$level->is_default)
                                <a href="javascript:void(0)" class="ml-3 lavel-delete" data-id="{{ $level->id }}"><img src="{{ asset('img/grey-trash.jpg') }}"></a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="centerAlign borderNone">
                                <input type="text" value="{{ $level->title}}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="borderNone">
                                <input type="text" value="{{ $level->level}}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="centerAlign borderNone"> 
                                @if ($level->badge)
                                @if (file_exists(public_path().'/images/level/'.$level->badge))
                                <img id="eventImageUploaded" src="{{ asset('images/level/thumbnail_'.$level->badge) }}" classc="img-thumbnail img-fluid" height="150" width="150">
                                @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="borderNone">
                                @if (!$level->is_default)
                                <input type="text" value="${{ $level->price}}/year" class="form-control form-control-sm bg-transparent displayContent" readonly>
                                @else
                                <input type="text" value="${{ $level->price}}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                                @endif
                            </td>
                        </tr>
                        @if (!$level->is_default)
                        <tr>
                            <td class="borderNone">
                                <input type="text" value="Legacy : {{ $level->legacy }}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td class="borderNone">
                                <input type="text" value="coins : {{ $level->coins }}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                            </td>
                        </tr>
                        @else
                        <tr stylec="display:none;">
                            <td class="borderNone">
                                <p style="margin-left: 58px;">
                                    Limitations: <br>
                                    <input type="checkbox">Legacy <br>
                                    <input type="checkbox">Master Group <br>
                                    <input type="checkbox">Messaging <br>
                                    <input type="checkbox">Connect <br>
                                    <input type="checkbox">Master Class <br>
                                    <input type="checkbox">Mindset <br>
                                </p>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td style="text-align: center;" class="borderNone"> 
                                <font color="#fff">{{$level->description}}</font>
                            </td>
                        </tr>
                        <tr>
                            <td class="borderNone">
                                <input type="text" value="Discount Code : {{ $level->discount_code }}" class="form-control form-control-sm bg-transparent displayContent" readonly>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            @endforeach
            @endif
            <!--Level listing ends -->
            <!--Level create starts-->
            <div class="sectionDiv">
                <div class="table-responsive">
                    <form id="levelForm" method="POST" action="{{ route('admin.level.save') }}" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-hover mb-2">
                            <tr><td class="borderNone"></td></tr>
                            <tr>
                                <td class="borderNone">
                                    <input type="text" name="title" value="{{ old('title')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Title">
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <input type="text" name="level" value="{{ old('level')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Level">
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <input type="file" name="image" class="form-control form-control-sm text-white-50 bg-transparent displayContent">
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <input type="text" name="price" value="{{ old('price')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Price">
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <input type="text" name="legacy" value="{{ old('legacy')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Legacy">
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <input type="text" name="coins" value="{{ old('coins')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Coins">
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <textarea style="color: #fff !important;" name="description" class="form-control form-control-sm bg-transparent" >{{ old('description')}}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="borderNone">
                                    <!--<font color="#fff">Discount Code</font>-->  
                                    <input type="text" name="discount_code" value="{{ old('discount_code')}}" class="form-control form-control-sm bg-transparent displayContent" placeholder="Discount Code">
                                </td>
                            </tr>
                            <tr style="text-align:center;">
                                <td class="borderNone">
                                    <a href="javascript:void()" class="btn btn-outline-warning rounded-pill w-50 accent" onclick="document.getElementById('levelForm').submit();">Add Level</a>
                                </td>
                            </tr>
                        </table>
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