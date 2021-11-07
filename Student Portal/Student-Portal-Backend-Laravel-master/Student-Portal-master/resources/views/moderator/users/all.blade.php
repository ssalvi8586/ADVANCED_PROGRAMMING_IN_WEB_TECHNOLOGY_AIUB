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
                    <th>Ban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->uname }}</td>
                    <td>{{ $user->created_at->DiffForHumans() }}</td>
                    <td>{{ $user->type }}</td>
                    <td><a href="{{ route('profile.view', ['uname' => $user->uname]) }}" class="btn btn-primary">View</a></td>
                    @if($user->status === 1)
                    <td><a href="{{ route('moderator.users.ban', ['id' => $user->id]) }}" class="btn btn-secondary">Ban</a></td>
                    @else
                    <td><a href="{{ route('moderator.users.unban', ['id' => $user->id]) }}" class="btn btn-success">Unban</a></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

