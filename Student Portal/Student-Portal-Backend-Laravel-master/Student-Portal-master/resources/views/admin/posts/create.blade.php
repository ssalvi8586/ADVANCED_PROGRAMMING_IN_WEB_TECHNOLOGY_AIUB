@extends('admin.dashboard-template')
@section('content')
<div class="row">
    <div class="create-post col-sm">
        <form action="{{ route('admin.posts.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="post-title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="post-title" name="post-title">
            </div>
            <div class="mb-3">
                <label for="post-description" class="form-label">Post Description</label>
                <textarea class="form-control" name="post-description" id="post-description" rows="3"></textarea>
            </div>
            <div class="row">
                <div class="col-sm">
                    <input list="brow" name="post-category" class="form-select">
                    <datalist id="brow" class="">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" label="{{ $category->name }}">
                        @endforeach                        
                    </datalist>  
                </div>
            </div>
            <div class="mb-3 mt-2">
                <label for="formFile" class="form-label">Add Image</label>
                <input class="form-control" type="file" id="formFile" name="featured_image">
              </div>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>
    </div>
    <div class="preview col-sm">

    </div>
</div>
@endsection

