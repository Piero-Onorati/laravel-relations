@extends('layouts.app')

@section('content')
    <div class="container">

        <!--start SESSION -->
        @if (session('delete'))
            <!-- DELETE SESSION -->
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill" style="font-size: 1.5rem;"></i>
                <div class="px-2">
                    {{session('delete')}}
                </div>
            </div>
            
        @elseif(session('edit'))
            <!-- EDIT SESSION -->
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill" style="font-size: 1.5rem;"></i>
                <div class="px-2">
                    {{session('edit')}}
                </div>
            </div>
        @else
            <div class="alert alert-primary d-flex align-items-center" role="alert">
                <i class="bi bi-info-circle-fill" style="font-size: 1.5rem;"></i>
                <div class="px-3">
                    <span>This is the notification box. All the updates will displayed here.</span>
                </div>
            </div>
        @endif
        <!--end SESSION -->
       
        {{-- TABLE --}}
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{$post->title}}</td>
                        <td class="text-uppercase">
                            @if ($post->category)
                                {{$post->category->name}}
                            @endif
                        </td>
                        <td class="text-center">
                            <a class="btn btn-primary" href="{{route('admin.posts.show', $post->id)}}">Show</a>
                            <a class="btn btn-secondary" href="{{route('admin.posts.edit', $post->id)}}">Edit</a>
                            <form action="{{route('admin.posts.destroy', $post->id)}}" method="post" class="d-inline-block delete-post-form">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Delete" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    
@endsection