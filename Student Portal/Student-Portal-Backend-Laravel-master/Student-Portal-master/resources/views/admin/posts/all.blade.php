@extends('admin.dashboard-template')
@section('content')
    <div class="row">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Delete</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ strtotime($post->created_at) }}</td>
                    <td>{{ $post->user->uname }}</td>
                    <td><a href="{{ route('admin.posts.delete', ['id'=> $post->id ]) }}" class="btn btn-danger">Delete</a></td>
                    <td>
                        <a href="{{ route('posts.view.single', ['subcat' => $post->category->name, 'id' => $post->id]) }}" class="btn btn-success">View</a>
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    
@endsection
        

