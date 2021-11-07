@extends('moderator.dashboard-template')

@section('content')
    <div class="row">
        <div class="create-post col-sm">
            <form action="{{ route('moderator.categories.create') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="post-title" class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" id="post-title" name="post-title">
                </div>
                @if(session()->has('success'))
                <p class="text-success">{{ session('success') }}</p>
                @endif
                @error('name')
                    <p class="text-danger">{{ $msg }}</p>
                @enderror
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <div class="preview col-sm">

        </div>
    </div>
@endsection
