@extends('moderator.dashboard-template')

@section('content')
    <div class="row">
        <table class="table table-striped" id="table1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Joined At</th>
                    <th>Designation</th>
                    <th>View</th>
                    <th>Approve</th>
                    <th>Decline</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->uname }}</td>
                    <td>{{ $user->created_at->DiffForHumans() }}</td>
                    <td>{{ $user->type }}</td>
                    <td><a href="{{ route('profile.view', ['uname' => $user->uname]) }}" class="btn btn-primary">View</a></td>
                    <td><a href="{{ route('moderator.instructor.approve', ['id' => $user->id]) }}" class="btn btn-success">Approve</a></td>
                    <td><a href="{{ route('moderator.instructor.decline', ['id' => $user->id]) }}" class="btn btn-danger">Decline</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
