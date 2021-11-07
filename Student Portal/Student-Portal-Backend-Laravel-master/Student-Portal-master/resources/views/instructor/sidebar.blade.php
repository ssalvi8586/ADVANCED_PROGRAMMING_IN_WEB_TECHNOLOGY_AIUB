<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('img/favicon-admin.png') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <!-- Components -->
    <!-- Create Categories -->
    <link rel="stylesheet" href="{{ asset('css/components/search-list.css') }}">
    <title>Student Portal | Admin Panel</title>
</head>
<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{route('home')}}">Student Portal</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active">
                            <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-file-post"></i>
                                <span>Posts</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{route('admin.posts')}}">All Posts</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route('admin.posts.create')}}">Create Post</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-breadcrumb.html">Post Statistics</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-tags-fill"></i>
                                <span>Categories</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{route('admin.categories')}}">All Categories</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route('admin.categories.create')}}">Create Category</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-tags-fill"></i>
                                <span>Sub-Categories</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="{{route('admin.categories')}}">All Sub-Categories</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="{{route('admin.categories.create')}}">Create Sub-Category</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.roles')}}" class='sidebar-link'>
                                <i class="bi bi-person-check"></i>
                                <span>Roles</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.users')}}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>All Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{route('admin.web.info')}}" class='sidebar-link'>
                                <i class="bi bi-lock-fill"></i>
                                <span>Privacy Policy</span>
                            </a>
                        </li>
                        <li class="sidebar-item ">
                            <a href="{{ route('admin.web.info') }}" class='sidebar-link'>
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Website info</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>



