@include('header')
@if (session()->get('uname') !== null)
    @yield('header-main-logged')
@else
    @yield('header-main')
@endif

@yield('header-navbar')

<main class="container">
    <div class="p-4 p-md-5 mb-4 text-white rounded"
        style="background: linear-gradient(rgba(50, 50, 50, 0.7), rgba(50, 50, 50, 0.7)), url({{ asset('img/posts/featured-1.jpg') }})">
        <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic">How can be laravel workflow make 5.0x faster</h1>
            <p class="lead my-3">So we know MVC approach is meant to take work faster and it perfectly works then any
                other frameworks. Yet it becomes very much cumbersome sometimes..</p>
            <p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-6">
            <div
                class="featured2-card row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-primary">Physics</strong>
                    <h3 class="mb-0">Quantam Mechanics can explain blackhole</h3>
                    <div class="mb-1 text-muted">Nov 12</div>
                    <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to
                        additional content.</p>
                    <a href="#" class="stretched-link">Continue reading</a>
                </div>
                <div class="col-auto d-none d-lg-block w-200 index-featured2-cover-photo"
                    style="background-image: url({{ asset('img/posts/featured-2.jpg') }})">
                    <img src="{{ asset('img/posts/featured-2.jpg') }}" width="200" alt="" style="opacity: 0">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div
                class="featured2-card row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-success">Design</strong>
                    <h3 class="mb-0">Polythene & Environment</h3>
                    <div class="mb-1 text-muted">Nov 11</div>
                    <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to
                        additional content.</p>
                    <a href="#" class="stretched-link">Continue reading</a>
                </div>
                <div class="col-auto d-none d-lg-block bg-white index-featured2-cover-photo"
                    style="background-image: url({{ asset('img/posts/featured-3.jpg') }})">
                    <img src="{{ asset('img/posts/featured-2.jpg') }}" width="200" alt="" style="opacity: 0">
                </div>
            </div>
        </div>
    </div>

    <!-- For selecting post types -->
    {{-- <div class="btn-group mb-3">
        <a href="#" class="btn btn-primary active" aria-current="page">Question</a>
        <a href="#" class="btn btn-primary">Articles</a>
    </div> --}}
    {{-- <div class="tags mb-3">
        <div class="chip">
            <img src="{{ asset('img/posts/featured-2.jpg') }}" alt="Person" width="96" height="96">
            Physics
        </div>
        <div class="chip">
            <img src="{{ asset('img/posts/featured-3.jpg') }}" alt="Person" width="96" height="96">
            Chemistry
        </div>
    </div> --}}
    <div class="row g-5">
        <div class="col-md-8">
            @if (session()->get('uname') !== null)
                <!-- Quetion Posting section -->
                <div class="row border rounded-3 shadow-sm">
                    <div class="row align-items-center g-0 m-2">
                        <div class="col-1 text-center">
                            <!-- Will change this picture dynamically -->
                            <a class="text-dark" href="{{route('profile.view',session()->get('uname'))}}"><span class="fas fa-user-circle fa-2x"></span></a>
                        </div>
                        <div class="col-9 pe-5">
                            <a href="{{route('posts.create.view')}}">
                            <input class="form-control fs-6 my-2 py-3 rounded-3" type="text" name="postBox" id="postBox"
                                placeholder="What is your question ?"></a>
                        </div>
                        <div class="col-2"></div>
                    </div>

                </div>
            @endif
            <div class="btn-group mt-4">
                <a href="{{route('home')}}" class="btn btn-primary" aria-current="page">Question</a>
                <a href="{{route('blog')}}" class="btn btn-primary active">Blogs</a>
              </div>
            <h3 class="pb-2 mb-2 mt-3 fst-italic border-bottom">
                Trending Blogs
            </h3>
            <div class="posts mb-3">
                @foreach ($posts as $post)
                    <div class="index-single-post row border rounded-3 mb-2 py-1 p-3 shadow">
                        <div class="row g-0">
                            <!-- Post info section -->
                            <div class="col-12 col-lg-8 d-flex align-items-center ms-2 mb-1">
                                <div class="text-primary">
                                    <a href="{{ route('posts.view.cat', $post->category->name) }}"
                                        class="text-decoration-none">{{ $post->category->name }}</a>
                                </div>
                                <div class="mx-1">|</div>
                                <div class="lh-sm text-muted align-self-center me-1" style="font-size: 12px">Posted By
                                </div>
                                <a href="{{ route('profile.view', $post->user->uname) }}"
                                    class="fs-6 text-success me-1 text-decoration-none">{{ $post->user->uname }}</a>
                                <div class="lh-sm text-danger align-self-end" style="font-size: 12px">
                                    {{ $post->created_at->diffForHumans() }}</div>
                            </div>
                            <!-- Post header section  -->
                            <div class="col-12 ps-2 border-top">
                                <div class="fs-4 fw-bold my-1">{{ $post->title }}</div>
                            </div>
                            <div class="ms-3 pe-3 col-12 mb-2">
                                {{-- <div class="lh-sm text-dark text-wrap">{{$post->pbody}}</div> --}}
                                {{ \Illuminate\Support\Str::limit($post->pbody, 550, '....') }} <a
                                href="{{ route('posts.view.single', [$post->category->name, $post->id]) }}"
                                class='text-primary'>Read More</a>
                                {{-- <div class="lh-sm text-dark text-wrap">{{$post->pbody}}</div> --}}
                            </div>
                            <div class="col-6 d-flex align-items-center border-top py-2 mt-3 ">
                                <div class="border border-0 bg-info px-2" style="border-radius: 30px;"><a href=""><i
                                            class="fas fa-arrow-alt-circle-up me-1"></i>{{ count($post->upvotes) }} <i
                                            class="text-muted"></a>|<a href=""></i><i
                                            class="fas fa-arrow-alt-circle-down ms-1"></i>{{ count($post->downvotes) }}</a></div>
                                <div class="mx-3"><i
                                        class="fas fa-comment-dots me-1"></i>{{ count($post->comments) }}
                                </div>
                                <div class="me-3"><i class="fas fa-eye me-1"></i>{{ $post->views }}</div>
                            </div>
                            <div class="col-6 justify-content-end d-flex align-items-center border-top py-2 mt-3 ">
                                <div class="mx-3"><i class="far fa-heart me-1"></i></i><a href="">Favourite</a></div>
                                <div class="me-3"><i class="fas fa-share me-1"></i><a href="">Share</a></div>
                                <div class="me-3"><i class="fas fa-ellipsis-h me-1"></i></div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

            <nav class="blog-pagination d-flex justify-content-center" aria-label="Pagination">
                <a class="btn btn-outline-primary" href="{{ route('posts.view.all') }}">More</a>
                {{-- <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a> --}}
            </nav>

        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="fst-italic">About</h4>
                    <p class="mb-0">Biggest online learning platform in Bangladesh! Post questions about anything, get
                        help from experts and share expertise with others.</p>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Categories</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="{{ route('posts.view.cat', 'math') }}">Math</a></li>
                        <li><a href="{{ route('posts.view.cat', 'physics') }}">Physics</a></li>
                        <li><a href="{{ route('posts.view.cat', 'chemistry') }}">Chemistry</a></li>
                        <li><a href="{{ route('posts.view.cat', 'biology') }}">Biology</a></li>
                        <li><a href="{{ route('posts.view.cat', 'programming') }}">Progamming</a></li>
                        <li><a href="{{ route('posts.view.cat', 'Exam Preparation') }}">General Knowledge</a></li>
                        <li><a href="{{ route('posts.view.cat', 'economics') }}">Economics</a></li>
                        <li><a href="{{ route('posts.view.cat', 'Exam Preparation') }}">Exam Preperation</a></li>
                    </ol>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Archives</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="#">March 2021</a></li>
                        <li><a href="#">February 2021</a></li>
                        <li><a href="#">January 2021</a></li>
                        <li><a href="#">December 2020</a></li>
                        <li><a href="#">November 2020</a></li>
                        <li><a href="#">October 2020</a></li>
                        <li><a href="#">September 2020</a></li>
                        <li><a href="#">August 2020</a></li>
                        <li><a href="#">July 2020</a></li>
                        <li><a href="#">June 2020</a></li>
                        <li><a href="#">May 2020</a></li>
                        <li><a href="#">April 2020</a></li>
                    </ol>
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

</main>
@include('footer')
