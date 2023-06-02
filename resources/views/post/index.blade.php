@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>{{$user->name}}, {{ $posts->isEmpty() ? "you don't have any posts." : "your posts" }}</h3>
        <div class="mt-4">
            @foreach ($posts as $post)
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text">{{ $post->content }}</p>
                        <div class="btn-group">
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
