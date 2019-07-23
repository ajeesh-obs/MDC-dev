@extends('layouts.app')
<style>
    .del-underscore{
        text-decoration: none !important;
    }
</style>
@section('content')

<main role="main" class="container">
    <div class="px-2 py-4">
        <section class="search" style="min-height: 150px;">
            <div class="row no-gutters">
                <div class="col-4">
                    <div class="autocomplete">
                        <input id="searchExpertise" type="search" class="form-control form-control-sm text-white-50" placeholder="Search Expertise" autocomplete="off">
                    </div>
                </div>
                <div class="col-8 userExpertiseDiv">
                </div>
            </div>
        </section>
        <section class="suggested mb-4">
            <h5 class="text-white font-weight-bold mb-2">Suggested Matches</h5>
            <div class="d-flex flex-row justify-content-between align-items-center">
                <div class="">
                    <div class="badge badge-pill border bg-color font-weight-normal px-3 p-2 mr-2">
                        <a href="javascript:void()" class="text-white del-underscore" id="showAll">Show All</a>
                    </div>
                    <div class="badge badge-pill border bg-color font-weight-normal px-3 p-2 mr-2">
                        <a href="javascript:void()" class="text-white del-underscore" id="showFollowersOnly">Show Followers Only</a>
                    </div>
                    <div class="badge badge-pill border bg-color font-weight-normal px-3 p-2">
                        <a href="javascript:void()" class="text-white del-underscore" id="showFollowingOnly">Show Following Only</a>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <i class="icon icon-search filter-white icon-24"></i>
                    <input type="search" id="searchByPersonLocationLevel" class="form-control form-control-sm text-white-50 ml-2" placeholder="Search by person, location or level">
                </div>
            </div>
        </section>
        <section class="map mb-4 mapDiv" style="display: none;">
            <div class="card card-dark mb-3">
                <div class="card-img position-relative">
                    <!--<img class="w-100"-->
                    <!--src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="-->
                    <!--alt="Generic placeholder image" width="1200" height="144">-->
                    <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d23827.256641122374!2d-118.24396239727248!3d34.045326717248805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1558111508255!5m2!1sen!2sin" width="1200" height="144" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <div class="card-img-overlay text-center h-max"
                         style="left: 50%; top: 50%; transform: translate(-50%, -50%);">
                        <a href="map.html">
                            <div class="badge badge-dark px-4 py-2 rounded-pill font-weight-normal text-white">View On
                                Map
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="profiles">
            <div class="card-columns card-4">
            </div>
            <input type="hidden" name="userCurrentExpertise" id="userCurrentExpertise">
        </section>
    </div>
</main>
@endsection
@section('script')
<script>
    $(document).ready(function () {
    var expertise = @json($allExpertArr);
    if (document.getElementById("searchExpertise")) {
    autocomplete(document.getElementById("searchExpertise"), expertise);
    }
    });
    $(document).on('click', '.autocomplete-item', function (e) {
    e.preventDefault();
    var val = $("#searchExpertise").val();
    if (val) {
    addExpertise(val);
    }
    });
    $(document).on('keyup', '#searchExpertise', function (e) {
    e.preventDefault();
    var val = $("#searchExpertise").val();
    if (e.keyCode == 13 && val) {
    addExpertise(val);
    }
    });
    function addExpertise(val) {

    $(".userExpertiseDiv").append('<div class="badge badge-pill border text-white bg-color font-weight-normal h3 px-3 py-2 mr-2"><a href="javascript:void()" class="text-white userExpertise">&times;</a><span>' + val + '</span></div>');
    $("#searchExpertise").val('');
    $("#searchExpertise").focus();
    getExpertiseValues();
    }
    $(document).on('click', '.userExpertise', function (e) {
    e.preventDefault();
    $(this).parent().remove();
    getExpertiseValues();
    });
    function getExpertiseValues() {
    var values = $('.userExpertiseDiv span').map(function () {
    return $(this).text();
    }).get().join(',');
    $("#userCurrentExpertise").val(values);
    }

    $(document).on('click', '#showAll', function (e) {
    e.preventDefault();
    getList(1, 0, 0);
    });
    $(document).on('click', '#showFollowersOnly', function (e) {
    e.preventDefault();
    getList(0, 1, 0);
    });
    $(document).on('click', '#showFollowingOnly', function (e) {
    e.preventDefault();
    getList(0, 0, 1);
    });
    function getList(all = '', followers = '', following = ''){

    $("#showAll").html("Show All");
    $("#showFollowersOnly").html("Show Followers Only");
    $("#showFollowingOnly").html("Show Following Only");
    if (all == 1){
    $("#showAll").html("<span style='color:#ebc243'>Show All</span>");
    }
    else if (followers == 1){
    $("#showFollowersOnly").html("<span style='color:#ebc243'>Show Followers Only</span>");
    }
    else if (following == 1){
    $("#showFollowingOnly").html("<span style='color:#ebc243'>Show Following Only</span>");
    }

    var userCurrentExpertise = $("#userCurrentExpertise").val();
    var searchByPersonLocationLevel = $("#searchByPersonLocationLevel").val();
    $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            type: "POST",
            url: '{{ route('connect.search') }}',
            data: {'all': all, 'followers':followers, 'following':following, 'userCurrentExpertise':userCurrentExpertise, 'searchByPersonLocationLevel':searchByPersonLocationLevel},
            success: function(data){
            $(".card-columns").html(data);
            $(".mapDiv").show();
            }
    });
    }


</script>
@endsection