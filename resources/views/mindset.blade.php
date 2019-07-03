@extends('layouts.app')

@section('content')

<main role="main" class="container">
    <div class="px-2 py-4">
        <div class="row">
            <div class="col-4">
                <div class="card mb-3">
                    <div class="card-header text-primary font-weight-bold small">
                        facebook
                    </div>
                    <div class="card-img rounded-0 bg-cover bg-center"
                         style="background-image: url('img/event.png'); height: 190px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title small text-uppercase font-weight-bold">The Million Dollar Club</h5>
                        <p class="card-text small text-dark mb-2">
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                        <ul class="list-inline small text-muted m-0">
                            <li class="list-inline-item">1,456 Likes</li>
                            <li class="list-inline-item">847 Comments</li>
                        </ul>
                    </div>
                    <div class="card-footer text-muted small">
                        <ul class="list-inline small text-muted m-0">
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">Like</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">Comment</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">Share</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header text-primary font-weight-bold small">
                        twitter
                    </div>
                    <div class="card-body d-flex flex-row align-items-center pb-0">
                        <img class="rounded mr-2"
                             src="img/profile6.jpg"
                             alt="Generic placeholder image" width="50" height="40">
                        <h5 class="card-title small text-uppercase font-weight-bold">
                            The Million Dollar Club
                            <small>@TheMillionDollarClub</small>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text small text-dark mb-2">
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header text-primary font-weight-bold small">
                        Instagram
                    </div>
                    <div class="card-img rounded-0 bg-cover bg-center"
                         style="background-image: url('img/house.jpg'); height: 190px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title small text-uppercase font-weight-bold">The Million Dollar Club</h5>
                        <p class="card-text small text-dark mb-2">
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                        <ul class="list-inline small text-muted m-0">
                            <li class="list-inline-item">1,456 Likes</li>
                            <li class="list-inline-item">847 Comments</li>
                        </ul>
                    </div>
                    <div class="card-footer text-muted small">
                        <ul class="list-inline small text-muted m-0">
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">Like</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">Comment</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-muted">Share</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-dark mb-3">
                    <div class="card-header accent-color text-uppercase font-weight-bold small">
                        Member Spotlight
                    </div>
                    <div class="card-img rounded-0 bg-cover bg-center"
                         style="background-image: url('img/profile6.jpg'); height: 190px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title small font-weight-bold">Username</h5>
                        <p class="card-text small">
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur. ure dolor in reprehenderit in
                            voluptate velit esse cillum dolore.
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="#" class="text-muted small">Read More</a>
                    </div>
                </div>

                <div class="card card-dark mb-3">
                    <div class="card-header d-flex flex-row justify-content-between small">
                        <div class="small">
                            <img class="rounded-circle mr-2"
                                 src="img/profile6.jpg"
                                 alt="Generic placeholder image" width="18" height="18">
                            <span class="font-weight-bold mr-1">Username</span> checked into Los Angeles, CA
                        </div>
                        <div class="small text-white-50">
                            22 mins ago
                        </div>
                    </div>
                    <div class="card-img">
                        <!--<img class="w-100"-->
                        <!--src="img/maps.png"-->
                        <!--alt="Generic placeholder image" width="370" height="55">-->
                        <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d23827.256641122374!2d-118.24396239727248!3d34.045326717248805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1558111508255!5m2!1sen!2sin" width="370" height="100" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                    <div class="card-body py-1">
                        <ul class="list-inline small m-0 d-flex flex-row justify-content-around">
                            <li class="list-inline-item">
                                <a href="#" class="text-white-50">3 Likes</a>
                            </li>
                            <li class="list-inline-item text-white-50">|</li>
                            <li class="list-inline-item">
                                <a href="#" class="text-white-50">2 Comments</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card card-dark mb-3">
                    <div class="card-body py-2">
                        <div class="small">
                            <img class="rounded-circle mr-2"
                                 src="img/profile2.jpeg"
                                 alt="Generic placeholder image" width="36" height="36">
                            <span class="font-weight-bold mr-1">Username</span> liked John Doe's video
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-dark mb-3">
                    <div class="card-header d-flex flex-row justify-content-between align-items-center">
                        <div class="accent-color text-uppercase font-weight-bold small">
                            + Add New Post
                        </div>
                        <div>
                            <a href="#" class="small text-white-50 dropdown-toggle" id="actionDropdown2"
                               role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">Category</a>
                            <div class="dropdown-menu text-center dropdown-menu-right dropdown-menu-sm"
                                 aria-labelledby="actionDropdown2">
                                <a class="dropdown-item" href="#">Action 1</a>
                                <a class="dropdown-item" href="#">Action 2</a>
                                <a class="dropdown-item" href="#">Action 3</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-input p-2">
                        <textarea class="form-control form-control-sm border-0 write-post" size="10"
                                  placeholder="Write your post here">Write your post here</textarea>
                    </div>
                    <div class="card-body d-flex flex-row justify-content-between">
                        <a href="#" class="btn btn-sm rounded-pill px-2">
                            <i class="icon icon-photo filter-gold"></i>
                        </a>
                        <a href="#" class="btn btn-sm rounded-pill px-2 ml-2">
                            <i class="icon icon-video filter-gold"></i>
                        </a>
                        <a href="#" class="btn btn-outline-warning rounded-pill btn-block small ml-2">
                            Submit</a>
                    </div>
                </div>

                <div class="card card-dark mb-3">
                    <div class="card-header d-flex flex-row justify-content-between small">
                        <div class="small">
                            <img class="rounded-circle mr-2"
                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                 alt="Generic placeholder image" width="18" height="18"> Posted by User Name
                        </div>
                        <div class="small text-white-50">
                            November 18, 2018
                        </div>
                    </div>
                    <div class="card-img position-relative">
                        <img class="w-100"
                             src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                             alt="Generic placeholder image" width="370" height="190">
                        <div class="card-img-overlay p-0 pt-1 pr-2" style="left: auto">
                            <span class="badge badge-dark text-uppercase px-2 py-1 text-white-50">Category</span>
                        </div>
                        <div class="card-img-overlay p-0 pl-2" style="top: auto">
                            <h2 class="text-white-50 text-capitalize">Video Title Here</h2>
                        </div>
                    </div>
                    <div class="card-body border-bottom py-1">
                        <ul class="list-inline small m-0 d-flex flex-row justify-content-around">
                            <li class="list-inline-item">
                                <a href="#" class="text-white-50">3 Likes</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-white-50">2 Comments</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item bg-transparent border-0 p-0 d-flex flex-row mb-2">
                                <div class="mr-2">
                                    <img class="rounded-circle"
                                         src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                         alt="Generic placeholder image" width="24" height="24">
                                </div>
                                <div class="mt-1">
                                    <div class="d-flex w-100 align-items-center">
                                        <h5 class="small mb-0">Other username</h5>
                                        <small class="text-muted ml-1">- November 18, 2018</small>
                                    </div>
                                    <p class="mb-1 small">Lorem ipsum</p>
                                    <ul class="list-inline small m-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="text-white-50">Like</a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="text-white-50">Reply</a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="text-white-50">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="list-group-item bg-transparent border-0 p-0 d-flex flex-row">
                                <div class="mr-2">
                                    <img class="rounded-circle"
                                         src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                         alt="Generic placeholder image" width="24" height="24">
                                </div>
                                <div class="mt-1">
                                    <div class="d-flex w-100 align-items-center">
                                        <h5 class="small mb-0">Other username</h5>
                                        <small class="text-muted ml-1">- November 18, 2018</small>
                                    </div>
                                    <p class="mb-1 small">Lorem ipsum</p>
                                    <ul class="list-inline small m-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="text-white-50">Like</a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="text-white-50">Reply</a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="text-white-50">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body d-flex flex-row justify-content-between">
                        <input type="text"
                               class="form-control form-control-sm bg-transparent text-white rounded-pill small accent-border w-75"
                               placeholder="Type a comment" value="Type a comment">
                        <a href="#" class="btn btn-sm btn-outline-warning rounded-pill btn-block small ml-2 w-25">
                            Submit</a>
                    </div>
                </div>

                <div class="card card-dark mb-3">
                    <div class="card-header d-flex flex-row justify-content-between small">
                        <div class="small">
                            <img class="rounded-circle mr-2"
                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                 alt="Generic placeholder image" width="18" height="18"> Posted by John
                        </div>
                        <div class="small text-white-50">
                            November 18, 2018
                        </div>
                    </div>
                    <div class="card-img">
                        <img class="w-100"
                             src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                             alt="Generic placeholder image" width="370" height="190">
                    </div>
                    <div class="card-body py-1">
                        <ul class="list-inline small m-0 d-flex flex-row justify-content-around">
                            <li class="list-inline-item">
                                <a href="#" class="text-white-50">3 Likes</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-white-50">2 Comments</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card card-dark">
                    <div class="card-header d-flex flex-row justify-content-between small">
                        <div class="small">
                            <img class="rounded-circle mr-2"
                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                 alt="Generic placeholder image" width="28" height="28"> Posted by Julia
                        </div>
                        <div class="small text-white-50">
                            November 18, 2018
                        </div>
                    </div>
                    <div class="card-body border-bottom text-white-50 px-3">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi
                        ut
                    </div>
                    <div class="card-body py-1 border-bottom">
                        <ul class="list-inline small m-0 d-flex flex-row justify-content-around">
                            <li class="list-inline-item">
                                <a href="#" class="text-white-50">3 Likes</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#" class="text-white-50">1 Comment</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item bg-transparent border-0 p-0 d-flex flex-row mb-2">
                                <div class="mr-2">
                                    <img class="rounded-circle"
                                         src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                         alt="Generic placeholder image" width="24" height="24">
                                </div>
                                <div class="mt-1">
                                    <div class="d-flex w-100 align-items-center">
                                        <h5 class="small mb-0">Other username</h5>
                                        <small class="text-muted ml-1">- November 18, 2018</small>
                                    </div>
                                    <p class="mb-1 small">Lorem ipsum</p>
                                    <ul class="list-inline small m-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="text-white-50">Like</a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="text-white-50">Reply</a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="text-white-50">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body d-flex flex-row justify-content-between">
                        <input type="text"
                               class="form-control form-control-sm bg-transparent text-white rounded-pill small accent-border w-75"
                               placeholder="Type a comment" value="Type a comment">
                        <a href="#" class="btn btn-sm btn-outline-warning rounded-pill btn-block small ml-2 w-25">
                            Submit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
