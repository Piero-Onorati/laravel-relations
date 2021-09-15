@extends('layouts.app')

@section('content')


   <div class="container">
    <div class="row row-cols-1 row-cols-md-2 g-4">

        @foreach ($categories as $category)
        <div class="col">
            <div class="card border-info mb-4">
                <div class="card-header bg-light">
                    <h5 class="text-uppercase fw-bold">{{$category->name}}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            @forelse ($category->posts as $post)
                            <tr>
                                <td><a href="{{route('admin.posts.show', $post->id)}}">{{$post->title}}</a></td>
                            @empty
                                <td>There are not posts with this category. <a href="{{route('admin.posts.create')}}" class="link-dark">Write it now!</a></td>
                            </tr>
                            @endforelse 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
      </div>
   </div>

   
@endsection