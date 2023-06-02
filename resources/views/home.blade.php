@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mt-4">
            <h2>Create a Post</h2>
            <form action="{{ route('post.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" placeholder="Enter the post title">
                </div>
                @error('title')
                <div class="text-danger mb-4">Поле заголовка обязательное</div>
                @enderror
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" name="content" placeholder="Enter the post content"></textarea>
                </div>
                @error('content')
                <div class="text-danger mb-4">Поле контента обязательное</div>
                @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="mt-4">
            @foreach ($posts as $post)
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text">{{ $post->content }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>@endsection
