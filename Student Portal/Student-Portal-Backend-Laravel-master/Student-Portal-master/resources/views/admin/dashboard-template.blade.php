<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('img/favicon-admin.png') }}" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
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
</head>
<?php 
    $dashboard = "";
    $posts = "";
    $categories = "";
    $website_info = ""; 
    $roles = "";
    $all_users = "";
    $privacy_policy = "";
    $moderator_request = "";

    $posts_submenu = array(
        'all-posts' => "",
        'create-posts' => "",
        'posts-statistics' => ""
    );
    $categories_submenu = array(
        "all-categories" => "",
        "create-categories" => "",
        "categories-statistics" => ""
    );    
    if(strpos(url()->current(), '/admin/dashboard')) {
        $dashboard = 'active';
    } else if(strpos(url()->current(), '/admin/posts')) {
        $posts = 'active';
        if(strpos(url()->current(), '/all')) {
            $posts_submenu['all-posts'] = 'active';
        } 
        if(strpos(url()->current(), '/create')) {
            $posts_submenu['create-posts'] = 'active';
        }  
        if(strpos(url()->current(), '/stats')) {
            $posts_submenu['posts-statistics'] = 'active';
        }
    } else if(strpos(url()->current(), '/admin/categories')) {
        $categories = 'active';
        if(strpos(url()->current(), '/all')) {
            $categories_submenu['all-categories'] = 'active';
        }  
        if(strpos(url()->current(), '/create')) {
            $categories_submenu['create-categories'] = 'active';
        }
        if(strpos(url()->current(), '/stats')) {
            $categories_submenu['categories-statistics'] = 'active';
        }
    } else if(strpos(url()->current(), '/admin/website-info')) {
        $website_info = "active";
    } else if(strpos(url()->current(), '/admin/users')) {
        $all_users = "active";
    } else if(strpos(url()->current(), '/admin/roles')) {
        $roles = "active";
    } else if(strpos(url()->current(), '/admin/privay-policy')) {
        $privacy_policy = "active";
    } else if(strpos(url()->current(), '/moderator/request')) {
        $moderator_request = "active";
    }
?>
<body>
    @section('ins-side-mune')
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('home') }}">Student Portal</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item {{ $dashboard }}">
                            <a href="{{route('admin.dashboard')}}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item  has-sub {{ $posts }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-file-post"></i>
                                <span>Posts</span>
                            </a>
                            <ul class="submenu {{ $posts }}">
                                <li class="submenu-item {{ $posts_submenu['all-posts'] }}">
                                    <a href="{{route('admin.posts')}}">All Posts</a>
                                </li>
                                <li class="submenu-item {{ $posts_submenu['create-posts'] }}">
                                    <a href="{{route('admin.posts.create')}}">Create Post</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item  has-sub {{ $categories }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-tags-fill"></i>
                                <span>Categories</span>
                            </a>
                            <ul class="submenu {{ $categories }}">
                                <li class="submenu-item {{ $categories_submenu['all-categories'] }}">
                                    <a href="{{route('admin.categories')}}">All Categories</a>
                                </li>
                                <li class="submenu-item {{ $categories_submenu['create-categories'] }}">
                                    <a href="{{route('admin.categories.create')}}">Create Category</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item {{ $roles }}">
                            <a href="{{route('admin.roles')}}" class='sidebar-link'>
                                <i class="bi bi-person-check"></i>
                                <span>Roles</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ $all_users }}">
                            <a href="{{route('admin.users')}}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>All Users</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ $moderator_request }}">
                            <a href="{{route('admin.moderator.request')}}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Moderator Requests</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ $privacy_policy }}">
                            <a href="{{route('admin.web.info')}}" class='sidebar-link'>
                                <i class="bi bi-lock-fill"></i>
                                <span>Privacy Policy</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ $website_info }}">
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
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
        
            <div class="page-heading">
                <h3>@yield('page-name')</h3>
            </div>
            <div class="page-content">
                @yield('content')
            </div>
        </div>
<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            {{-- <p>2021 &copy; Mazer</p> --}}
        </div>
        <div class="float-end">
            {{-- <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <ahref="http://ahmadsaugi.com">A. Saugi</a></p> --}}
        </div>
    </div>
</footer>
</div>
</div>
<script src="{{ URL::asset('/vendor/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="{{asset('/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{asset('/vendor/sortable-js/jquery.sortable.js') }}"></script>
<script src="{{ asset('/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js"></script>

<script src="{{ asset('js/admin/sidebar.js') }}"></script>
<script src="{{ asset('js/admin/datatable.js') }}"></script>

<!--  Dashboard -->
<script src="{{asset('/vendor/apexcharts/apexcharts.js') }}"></script>
<script src="{{ asset('js/admin/dashboard.js') }}"></script>
<script src="{{ asset('js/admin/main.js') }}"></script>

<!-- Components -->
<!-- Search List -->
<script src="{{ asset('js/components/search-list.js') }}"></script>
</body>
</html>


