@include('header')
@if (session()->get('uname') !== null)
    @yield('header-main-logged')
@else
    @yield('header-main')
@endif

<div class="container my-4">
    <div class="row">
        <div class="col-md-9 mx-auto border border-2 shadow-lg rounded">

            <h3 class="text-center mb-4">Message</h3>
            <div class="row">
                <div class="col-3">
                    @foreach ($msgs as $msg)
                        <div class="bg-success rounded-3 shadow my-2 mx-1 py-2 px-2">
                            <a class="text-decoration-none text-white" href="{{route('msg.view',$msg->sender->uname)}}">{{$msg->sender->uname}}</a>
                        </div>
                    @endforeach
                </div>
                <div class="col-9">
                    <div class="border rounded-3 border-3 p-4">
                        @foreach ($msgs as $msg)
                        <div class="bg-light rounded-3 my-2 mx-1 py-2 px-2 d-inline">
                            <div class="">
                                {{$msg->msg}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>

    </div>
</div>






@include('footer')
