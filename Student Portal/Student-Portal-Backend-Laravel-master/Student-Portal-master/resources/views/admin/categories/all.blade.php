@extends('admin.dashboard-template')

@section('content')
    <div class="row">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Active Posts</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                    <tr>
                        <td>{{ $cat->name }}</td>
                        <td>{{ count($cat->posts) }}</td>
                        <td><a href="{{ route('admin.categories.delete', ['id' => $cat->id]) }}" class="btn btn-danger">Delete</a></td>
                        <td>
                            <a href="{{ route('admin.categories.edit', ['id' => $cat->id]) }}" class="btn btn-secondary">Edit</a>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
@endsection
        
