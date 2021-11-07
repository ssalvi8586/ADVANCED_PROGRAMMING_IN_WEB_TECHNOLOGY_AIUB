@extends('admin.dashboard-template')
<?php 
    use App\Http\Controllers\PostController; 
    
    $user_details = null;
    if($user->type === 'admin') {
        $user_details = $user->admin;
    } else if($user->type === 'moderator') {
        $user_details = $user->moderator;
    } else if($user->type === 'instructor') {
        $user_details = $user->instructor;
    } else if($user->type === 'student') {
        $user_details = $user->student;
    } 
?>
@section('content')
<div class="row">
    <div class="col-12 col-lg-5">
        <div class="avatar avatar-xl">
            <img src="{{ asset('img/admin/5.jpg') }}" alt="">
    </div>
    <h1 class="display-6">{{ $user_details->name }}</h1>
    <?php 
        $user_type = [
            'admin' => '',
            'moderator' => '',
            'instructor' => '',
            'student' => ''
        ];
        $user_type[$user->type] = 'selected';
    ?>
    <form action="{{ route('admin.users.edit.type-POST') }}" method="POST" class="mb-3">
        <input type="hidden" value="{{ $user->id }}" name="id">
        <input type="hidden" value="{{ $user->type }}" name="prev_type">
        <select class="form-select w-25 mb-3" aria-label="select example" name="type">
            <option selected>Open this select menu</option>
            <option value="admin" {{ $user_type['admin'] }}>Admin</option>
            <option value="moderator" {{ $user_type['moderator'] }}>Moderator</option>
            <option value="instructor" {{ $user_type['instructor'] }}>Instructor</option>
            <option value="student" {{ $user_type['student'] }}>Student</option>
        </select>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <p class="display-7"><b>Email: </b>{{ $user_details->email }}</p>
    <p class="display-7"><b>Contact: </b>{{ $user_details->contact }}</p>
    </div>
    <div class="col-12 col-lg-7">
        <div class="container">
            
            <div class="card">
                <div class="card-header">
                    <h4>Top Answers</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>Post Title</th>
                                    <th>Answer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->comments as $comment)
                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <p class="font-bold ms-3 mb-0">{{ PostController::get($comment->id)->title }}</p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">{{ substr($comment->ctext, 0, 100) }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top posts -->
            <div class="card">
                <div class="card-header">
                    <h4>Top Posts</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Post excerpt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->posts as $post)                              
                                
                                <tr>
                                    <td class="col-3">
                                        <div class="d-flex align-items-center">
                                            <p class="font-bold ms-3 mb-0">{{ $post->title }}</p>
                                        </div>
                                    </td>
                                    <td class="col-auto">
                                        <p class=" mb-0">{{ substr($post->pbody, 0, 100) }}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
