@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title">{{$post->title}}</h5>
          <p class="card-text">{{$post->content}}</p>
          <p class="card-text">
            <small class="text-muted">
              @if ($post->category)
                Category: <span class="text-uppercase">{{$post->category->name}}</span>
              @endif
            </small>
          </p>
        </div>
    </div>

    <a href="{{route('admin.posts.index')}}" class="btn btn-dark">Back to Posts List</a>
</div>
    
@endsection