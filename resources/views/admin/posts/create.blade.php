@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{route('admin.posts.store')}}" method="post">
            @csrf

            <!-- start POST TITLE -->
            <div class="mb-3">
                <label for="post_title" class="form-label"> Post Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="post_title" placeholder="Write the title..." value="{{old('title')}}">

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
                        @if ($category->id == old('category_id'))
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
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="post_desc" rows="3" placeholder="Write the content...">{{old('content')}}</textarea>

                {{-- Error message --}}
                @error('content')
                    <div class="alert alert-danger my-3">{{ $message }}</div>
                @enderror
            </div>
            <!-- end POST CONTENT -->

            {{-- BUTTON --}}
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Add Post</button>
            </div>

        </form>
    </div>
    
@endsection