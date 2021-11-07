@include('header')
@if (session()->get('uname') !== null)
    @yield('header-main-logged')
@else
    @yield('header-main')
@endif

<div class="container posts my-4 col-12">
    @if ($posts[0]===null)
    <h6 class="text-center"> Sorry!!! There is no Post on this section.</h6>
 @endif
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
                    <div class="lh-sm text-muted align-self-center me-1" style="font-size: 12px">Posted By</div>
                    <a href="{{ route('profile.view', $post->user->uname) }}"
                        class="fs-6 text-success me-1 text-decoration-none">{{ $post->user->uname }}</a>
                    <div class="lh-sm text-danger align-self-end" style="font-size: 12px">
                        {{ $post->updated_at->diffForHumans() }}</div>
                </div>
                <!-- Post header section  -->
                <div class="col-12 ps-2 border-top">
                    <div class="fs-4 fw-bold my-1">{{ $post->title }}</div>
                </div>
                <div class="ms-3 pe-3 col-12 mb-2">
                    {{-- <div class="lh-sm text-dark text-wrap">{{$post->pbody}}</div> --}}
                    {{ str_limit($post->pbody, 550, '....') }} <a
                        href='{{ route('posts.view.single', [$post->category->name, $post->id]) }}'
                        class='text-primary'>Read More</a>
                    {{-- <div class="lh-sm text-dark text-wrap">{{$post->pbody}}</div> --}}
                </div>
                <div class="col-8 d-flex align-items-center border-top p-1 ">
                    <div class="border border-0 bg-info px-2" style="border-radius: 30px;"><a href=""><i
                                class="fas fa-arrow-alt-circle-up me-1"></i>{{ count($post->votes) }} <i
                                class="text-muted"></a>|<a href=""></i><i
                                class="fas fa-arrow-alt-circle-down ms-1"></i></a></div>
                    <div class="mx-3"><i class="fas fa-comment-dots me-1"></i>{{ count($post->comments) }}</div>
                    <div class="me-3"><i class="fas fa-eye me-1"></i>{{ $post->views }}</div>
                </div>
                <div class="col-4 justify-content-end d-flex align-items-center border-top p-1 ">
                    <div class="mx-3"><i class="far fa-heart me-1"></i></i><a href="">Favourite</a></div>
                    <div class="me-3"><i class="fas fa-share me-1"></i><a href="">Share</a></div>
                    <div class="me-3"><i class="fas fa-ellipsis-h me-1"></i></div>
                </div>
            </div>
        </div>

    @endforeach
</div>
{{ $posts->links() }}

@include('footer')
