@extends('admin.dashboard-template')

@section('content')
    <div class="row">
        <div class="create-post col-sm">
            <form action="{{ route('admin.categories.edit-POST') }}" method="POST">
                @csrf
                <input type="hidden" value="{{ $category->id }}" name="id">
                <div class="mb-3">
                    <label for="post-title" class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" id="post-title" value="{{ $category->name }}" name="post-title">
                </div>
                @if(session()->has('success'))
                <p class="text-success">{{ session('success') }}</p>
                @endif
                @error('name')
                    <p class="text-danger">{{ $msg }}</p>
                @enderror
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="preview col-sm">

        </div>
    </div>
@endsection
