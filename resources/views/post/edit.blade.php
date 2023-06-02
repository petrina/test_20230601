@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('post.update', $post->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" placeholder="{{$post->title}}"
                       value="{{$post->title}}">
            </div>
            @error('title')
            <div class="text-danger mb-4">Поле заголовка обязательное</div>
            @enderror
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" name="content">{{$post->content}}</textarea>
            </div>
            @error('content')
            <div class="text-danger mb-4">Поле контента обязательное</div>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
