@extends('moderator.dashboard-template')

@section('content')
    <div class="row">
        <div class="create-project col-sm">
            <form action="{{ route('moderator.update.web-info') }}" method="POST">
                @csrf
                <!-- Name -->
                <div class="mb-3">
                    <label for="website-name" class="form-label">Name</label>
                    <input type="text" value="{{ $info->name }}" class="form-control" id="website-name" name="website-name">
                </div>
                <!--  About -->
                <div class="mb-3">
                    <label for="website-about" class="form-label">About</label>
                    <textarea class="form-control" name="website-about" id="website-about" rows="3">{{ $info->about }}</textarea>
                </div>
                <!-- Website Email -->
                <div class="mb-3">
                    <label for="website-email" class="form-label">Website Email</label>
                    <input type="text" value="{{ $info->email }}" class="form-control" id="website-email" name="website-email">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="preview col-sm">

        </div>
    </div>
@endsection
