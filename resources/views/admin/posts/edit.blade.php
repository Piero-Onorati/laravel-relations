@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit post n. {{$post->id}}</h2>

        <form action="{{route('admin.posts.update', $post->id)}}" method="post">
            @csrf
            @method('PUT')

            <!-- start POST TITLE -->
            <div class="mb-3">
                <label for="post_title" class="form-label"> Post Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="post_title" value="{{old('title', $post->title)}}">

                {{-- Error message --}}
                @error('title')
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <!-- end POST TITLE -->

            <!-- start POST CATEGORY -->
            <div class="mb-3">
                <label class="visually-hidden" for="category_post">Category</label>
                <select name="category_id" class="form-select form-control" id="category_post">
                  <option value="">Choose category...</option>
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                        @if ($category->id == old('category_id', $post->category_id))
                            selected
                        @endif
                    >
                        {{$category->name}}
                    </option>  
                  @endforeach
                </select>
            </div>
            <!-- end POST CATEGORY -->

            <!-- start POST CONTENT -->
            <div class="mb-3">
                <label for="post_desc" class="form-label">Post Content</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="post_desc" rows="3">{{old('content', $post->content)}}</textarea>

                {{-- Error message --}}
                @error('content')
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <!-- end POST CONTENT -->

            {{-- BUTTON --}}
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Edit Post</button>
            </div>
        </form>
    </div>
    
@endsection