<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Student Portal</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/blog/">
    <link href="{{ asset('img/favicon.png') }}" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        a {
            text-decoration: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('css/profile/view.css') }}">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <link href="{{ asset('css/profile/edit.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components/chips.css') }}" rel="stylesheet">
    <link href="{{ asset('css/components/comments.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
</head>

<body onscroll="HidePopup()">
    @section('header-main')
        <div class="container">
            <header class="blog-header pb-3">
                <div class="row flex-nowrap justify-content-between align-items-center">
                    <div class="col-4 pt-1 d-flex">
                        <img src="https://img.icons8.com/material-outlined/40/000000/menu--v1.png" />
                        <form class="d-flex" action="{{route('home')}}" method="post">
                            <input class="w-100 form-control mx-4" type="text" name="search" id="search" placeholder="search">
                            <input class="btn btn-primary rounded-3" type="submit" value="Search">
                        </form>
                    </div>
                    <div class="col-4 text-center">
                        <a class="blog-header-logo text-dark" href="{{ route('home') }}">Student Portal</a>
                    </div>
                    <div class="col-4 d-flex justify-content-end align-items-center">
                        <a class="btn btn-outline-success me-3" href="{{ route('registration.index') }}">Register</a>
                        <a class="btn btn-outline-primary me-3" href="/login">Login</a>
                    </div>
                </div>
            </header>
        </div>
    @endsection
    @section('header-main-logged')
        <div class="container">
            @if (session()->has('approval'))
                <div class="alert alert-success" role="alert">{{ session()->get('approval') }}</div>
            @elseif (session()->has('decline'))
                <div class="alert alert-success" role="alert">{{ session()->get('decline') }}</div>
            @endif
            <header class="blog-header pb-3">
                <div class="row flex-nowrap justify-content-between align-items-center">
                    <div class="col-4 pt-1 d-flex">
                        <img src="https://img.icons8.com/material-outlined/40/000000/menu--v1.png" />
                        <form class="d-flex" action="{{route('home')}}" method="post">
                            <input class="w-100 form-control mx-4" type="text" name="search" id="search" placeholder="search">
                            <input class="btn btn-primary rounded-3" type="submit" value="Search">
                        </form>
                    </div>
                    <div class="col-4 text-center">
                        <a class="blog-header-logo text-dark" href="{{ route('home') }}">Student Portal</a>
                    </div>
                    <div class="col-1 d-flex justify-content-end align-items-center">
                        <button class="bg-transparent border-0" onclick="ShowNotification();">
                            <span class="far fa-bell fa-2x"></span>
                        </button>
                    </div>
                    <div class="col-2  d-flex justify-content-end align-items-center">
                        <div class="col-3 text-left align-self-center"><span class="fas fa-user-alt fa-2x"></span></div>
                        <div class="col-8">
                            <div>{{session()->get('name')}}</div>
                            <div class="text-muted" style="font-size: 14px">{{session()->get('type')}}</div>
                        </div>
                        <div class="col-1 align-self-center pe-1">
                            <button class="bg-transparent border-0" onclick="ShowProfileSec();">
                                <span class="fas fa-sort-down"></span>
                            </button>

                        </div>
                    </div>
                </div>
            </header>


            {{-- Profile Pop up Section --}}
            <div class="container shadow-lg bg-light rounded-1 fixed-top my-2" id="profile-sec" style="width: 190px; top: 66px; left:68vw;display: none;">

                <div class="d-flex m-1 hover-overlay">
                    <div class="col-2 text-left align-self-center">
                        <i class="far fa-user-circle"></i>
                    </div>
                    <div class="col-10">
                        <div>
                            @if (session()->get('uname')!==null)
                            <a href="{{route('profile.view',session()->get('uname'))}}">Profile</a>
                            @endif
                        </div>
                    </div>
                </div>
                <hr class="m-1 p-0">

                {{-- <div class="d-flex m-0 hover">
                    <div class="col-2 text-left align-self-center">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="col-10">
                        <div>
                            User Setting
                        </div>
                    </div>
                </div>
                <hr class="m-1 p-0"> --}}
{{--
                <div class="d-flex m-0 hover">
                    <div class="col-2 text-left align-self-center">
                        <i class="far fa-question-circle"></i>
                    </div>
                    <div class="col-10">
                        <div>
                            Help Center
                        </div>
                    </div>
                </div>
                <hr class="m-1 p-0"> --}}

                <div class="d-flex m-0 hover">
                    <div class="col-2 text-left align-self-center">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <div class="col-10">
                        <div>
                            <a href="{{route('logout.index')}}">Logout</a>
                        </div>
                    </div>
                </div>

            </div>
            {{-- Notification Container --}}
            <div class="container shadow-lg bg-light rounded-3 fixed-top" id="notification-sec" style="width: 320px; top: 70px; left:50vw;display: none;">
                <h4 class="text-center">Notification</h4>
                <hr class="m-0 p-0">

                @foreach (session()->get('notifs') as $notif)
                <div class="d-flex m-0 hover">
                    <div class="col-2 text-left align-self-center"><img class="rounded-circle"
                            src="https://picsum.photos/id/100/40" /></div>
                    <div class="col-10">

                            <div class="ms-1">
                            <p class="mb-0">{{$notif->user->uname}} {{$notif->msg}}</p>
                            </div>
                            <div class="text-muted ms-1" style="font-size: 14px">{{$notif->created_at->diffForHumans()}}</div>

                    </div>
                </div>
                <hr class="m-0 p-0">
                @endforeach


                {{-- @for ($i = 0; $i < 6; $i++) --}}
                    {{-- Single notification Items --}}
                    {{-- <div class="d-flex m-0 hover">
                        <div class="col-2 text-left align-self-center"><img class="rounded-circle"
                                src="https://picsum.photos/id/{{ $i * 100 }}/40" /></div>
                        <div class="col-10">
                            <div class="ms-1">
                            <p class="mb-0">Fahim Faisal reacted to your post reacted to your post</p>
                            </div>
                            <div class="text-muted ms-1" style="font-size: 14px">10 mins ago</div>
                        </div>
                    </div>
                    <hr class="m-0 p-0">
                @endfor --}}

                <div class="text-center w-25 mx-auto">View All</div>

            </div>
            @endsection

        @section('header-navbar')
            <div class="container">
                <div class="nav-scroller py-1 mb-2">
                    <nav class="nav d-flex justify-content-between">
                        <a class="p-2 link-secondary" href="{{ route('posts.view.cat', 'math') }}">Math</a>
                        <a class="p-2 link-secondary" href="{{ route('posts.view.cat', 'physics') }}">Physics</a>
                        <a class="p-2 link-secondary" href="{{ route('posts.view.cat', 'chemistry') }}">Chemistry</a>
                        <a class="p-2 link-secondary" href="{{ route('posts.view.cat', 'biology') }}">Biology</a>
                        <a class="p-2 link-secondary" href="{{ route('posts.view.cat', 'Programming') }}">Progamming</a>
                        <a class="p-2 link-secondary" href="{{ route('posts.view.cat', 'General Knowledge') }}">General Knowledge</a>
                        <a class="p-2 link-secondary" href="{{ route('posts.view.cat', 'economics') }}">Economics</a>
                        <a class="p-2 link-secondary" href="{{ route('posts.view.cat', 'Exam Preparation') }}">Exam
                            Preperation</a>
                    </nav>
                </div>
            </div>

        @endsection
