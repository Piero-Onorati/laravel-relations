@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{route('admin.posts.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="post_title" class="form-label"> Post Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="post_title" placeholder="Write the title..." value="{{old('title')}}">

                {{-- Error message --}}
                @error('title')
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="post_desc" class="form-label">Post Content</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="post_desc" rows="3" placeholder="Write the content...">{{old('content')}}</textarea>

                {{-- Error message --}}
                @error('content')
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Add Post</button>
            </div>
        </form>
    </div>
    
@endsection