@include('header')
@if (session()->get('uname') !== null)
    @yield('header-main-logged')
@else
    @yield('header-main')
@endif

<div class="container">
    <div class="row g-5">
        <div class="col-md-8">
            <div class="posts mb-3">
                <!-- Single Post -->
                <div class="index-single-post row border bg-light rounded-3 shadow my-2 py-1 p-3">
                    <div class="row g-0">
                        <!-- Post info section -->
                        <div class="col-12 col-lg-8 d-flex align-items-center ms-2 mb-1">
                            <div class="text-primary">{{ $post->category->name }}</div>
                            <div class="mx-1">|</div>
                            <div class="lh-sm text-muted align-self-end me-1">Posted By</div>
                            <a href="#user-profile"
                                class="fs-6 text-success me-1 text-decoration-none">{{ $post->user->uname }}</a
                                href="#user-profile">
                            <div class="lh-sm text-danger align-self-end">{{ $post->created_at->diffForHumans() }}
                            </div>
                            @if (session()->get('id') === $post->fr_user_id)
                                <div class="d-flex ms-4">
                                    <div><a class="btn btn-outline-info p-2 py-0 text-decoration-none text-primary"
                                            href="{{ route('posts.edit', [$post->category->name, $post->id]) }}">edit</a>
                                    </div>
                                    <div class="">|</div>
                                    <div class="">
                                        <form action="{{ route('posts.delete', $post->id) }}" method="post">
                                            {{-- <input type="hidden"> --}}
                                            <input class="btn btn-outline-danger p-2 py-0" type="submit" value="Delete"
                                                onclick="return deletePostConfirmation()">
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Post header section  -->
                        <div class="col-12 ps-2 border-top">
                            <div class="fs-4 fw-bold my-2">{{ $post->title }}</div>
                        </div>
                        <div class="ms-3 pe-3 col-12 mb-4">
                            <div class="lh-sm text-dark text-wrap">{{ $post->pbody }}</div>
                        </div>
                        <div class="col-8 d-flex align-items-center border-top p-1 ">
                            <div class="border border-0 bg-info px-2" style="border-radius: 30px;"><a href=""><i
                                        class="fas fa-arrow-alt-circle-up me-1"></i>{{ $count }} <i
                                        class="text-muted"></a>|<a href=""></i><i
                                        class="fas fa-arrow-alt-circle-down ms-1"></i></a></div>
                            <div class="mx-3"><i class="fas fa-comment-dots me-1"></i><a
                                    href="">{{ count($post->comments) }}</a></div>
                            <div class="me-3"><i class="fas fa-eye me-1"></i>{{ $post->views }}</div>
                        </div>
                        <div class="col-4 justify-content-end d-flex align-items-center border-top p-1 ">
                            <div class="mx-3"><i class="far fa-heart me-1"></i></i><a href="">Favourite</a></div>
                            <div class="me-3"><i class="fas fa-share me-1"></i><a href="">Share</a></div>
                            <div class="me-3"><i class="fas fa-ellipsis-h me-1"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Comment Section -->
            <div class="my-3">
                <div class="d-flex justify-content-center row">
                    <div class="coment-bottom bg-light rounded shadow p-2 px-4">

                        @if (session()->get('uname') !== null)
                            <div class="d-flex">
                                <div class="row w-100">
                                    <div class="col-1">
                                        <img class="img-fluid img-responsive rounded-circle mr-2 m-2"
                                            src="{{ asset('img/admin/2.jpg') }}" width="38">

                                    </div>
                                    <div class="col-11">
                                        <form action="" method='post'>
                                            <div class="d-flex flex">
                                                <div class="row w-100">
                                                    <div class="col-9">
                                                        <input type="text" name="ctext" class="form-control mr-3 my-2"
                                                            placeholder="Add comment">
                                                        <input type="hidden" name="postId" value="{{ $post->id }}">
                                                        <input type="hidden" name="catId"
                                                            value="{{ $post->category->name }}">
                                                    </div>
                                                    <div class="col-3">
                                                        <button class="btn btn-primary my-2"
                                                            type="submit">Comment</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <hr class="text-muted my-3">
                                </div>
                            </div>
                        @endif
                        @foreach ($comments as $comment)
                            <div class="commented-section mt-2 rounded shadow-2">
                                <div class="d-flex flex-row align-items-center commented-user ">

                                    <h5 class="mr-2"><a href="{{ route('profile.view', $comment->user->uname) }}"
                                            class="fs-6 text-success me-1 text-decoration-none">{{ $comment->user->uname }}</a>
                                    </h5>
                                    <span class="dot mb-1"></span>
                                    <span class="mb-1 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="comment-text-sm ms-3">
                                    <li><span>{{ $comment->ctext }}</span></li>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <!-- Comment section end -->



        </div>

        <div class="col-md-4">
            <div class="position-sticky" style="top: 2rem;">
                <div class="p-4">
                    <h4 class="fst-italic">Categories</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="{{ route('posts.view.cat', 'math') }}">Math</a></li>
                        <li><a href="{{ route('posts.view.cat', 'physics') }}">Physics</a></li>
                        <li><a href="{{ route('posts.view.cat', 'chemistry') }}">Chemistry</a></li>
                        <li><a href="{{ route('posts.view.cat', 'biology') }}">Biology</a></li>
                        <li><a href="{{ route('posts.view.cat', 'progamming') }}">Progamming</a></li>
                        <li><a href="{{ route('posts.view.cat', 'gk') }}">General Knowledge</a></li>
                        <li><a href="{{ route('posts.view.cat', 'economics') }}">Economics</a></li>
                        <li><a href="{{ route('posts.view.cat', 'exam-prep') }}">Exam Preperation</a></li>
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
</div>



<script>
    function deletePostConfirmation() {
        var confimDel = confirm("Are you Sure Want To Delete?");
        if (confimDel == true) {
            ​​​​​​​​
            return true;
        }​​​​​​​​
        return false;
    }​​​​​​​​
</script>


@include('footer')
