@include('header')
@if (session()->get('uname') !== null)
    @yield('header-main-logged')
@else
    @yield('header-main')
@endif

<div class="container">
    <div class="main-body">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $user->uname }}</li>
            </ol>
        </nav>
        <!-- /Breadcrumb -->

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            @if ($user->$type->image===null)
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="StudentProfilePic" class="rounded-circle" width="150">
                            @else
                            <img src="{{asset('upload/'.$user->$type->image)}}" alt="StudentProfilePic" class="rounded-circle" width="150">
                            @endif
                            <div class="mt-3">
                                <h4>{{ '@' . $user->uname }}</h4>
                                <p class="text-secondary mb-1">{{ $user->type }}</p>
                                <button class="btn btn-primary">Follow</button>
                                <a class="btn btn-outline-primary" href="{{route('msg.view',$user->uname)}}">Message</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap rounded-top bg-primary text-white">Social Link</li>
                        @foreach ($slinks as $slink)
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap p-0 px-3">
                            <h6 class="mb-0"><img class="me-2 align-self-center" src="https://img.icons8.com/ios-glyphs/20/000000/link--v2.png"/>{{$slink->sname}}</h6>
                            <span class="text-secondary"><a href="{{$slink->link}}">{{$slink->link}}</a></span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @if (session()->get('type')==='instructor')
                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap rounded-top bg-success text-white">Qualifications</li>
                        @foreach ($qualifications as $qualification)
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <div class="mb-0 me-2"><img class="me-2 align-self-center" src="https://img.icons8.com/ios-glyphs/20/000000/certificate.png"/>{{$qualification->degree}} <small>({{$qualification->year}})</small></div>
                            <div class="text-secondary">Grade: {{$qualification->grade}}</div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->$type->name }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->$type->email }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->$type->contact }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $user->$type->address }}
                            </div>
                        </div>

                        {{-- xyz will replace session uanme --}}
                        @if ($user->uname == session()->get('uname'))
                            <hr>
                            <div class="row d-flex justify-content-end">
                                <div class="col-2 align-content-end">
                                    <a class="btn btn-info" href="{{ route('profile.edit') }}">Edit</a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-md-12">
                    @foreach ($posts as $post)
                        <div class="container posts">
                            <!-- Single Post -->
                            <div class="row post mb-2 border-1 shadow-sm border-secondary">
                                <div class="col-3">
                                    <div class="row post-attr text-center">
                                        {{-- <div class="col-4">

                                            {{-- @if ($post->votes->status !== null)
                                                {{ $post->votes->status }}<br />
                                            @endif --}}
                                            {{-- <b>Votes</b>
                                        </div> --}}
                                        <div class="col-6">
                                            {{ count($post->comments) }}<br />
                                            <b>Comment</b>
                                        </div>
                                        <div class="col-6">
                                            {{ $post->views }}<br />
                                            <b>Views</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="container">
                                        <h5><a
                                                href="{{ route('posts.view.single', [$post->category->name, $post->id]) }}">{{ $post->title }}</a>
                                        </h5>
                                        {{ \Illuminate\Support\Str::limit($post->pbody, 200, '....') }} <a
                                            href="{{ route('posts.view.single', [$post->category->name, $post->id]) }}"
                                            class='text-primary'>Read More</a>

                                        {{-- <p>{{$post->pbody}}</p> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- Single Post end -->
                        </div>

                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@include('footer')
