@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3">
            @include('partials.sidebar')
        </div>
        <div class="col-9">
            
            @if(session()->has('message'))
                <div class="alert alert-warning">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ route('welcome') }}" method="get">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" value="{{ old('search') }}" placeholder="Search..." aria-label="Search..." aria-describedby="search">
                    <button type="submit" class="btn btn-primary input-group-text" id="search">Search</button>
                </div>
            </form>

            @foreach($posts as $post)
            <div class="card mb-4">
                <div class="card-header">
                    Post {{ $loop->index + 1}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ substr($post->body,0, 20) }}...</p>
                    <a href="{{ route('showPost', ['id' => $post->id]) }}" class="btn btn-primary">Show post</a>
                </div>
                <div class="card-footer">
                    <span class="float-start">#{{ $post->category->name }}</span>
                    <p class="float-end">Created at {{ $post->created_at->format('d.m.Y.') }} by {{ $post->user->name }}</p>
                </div>
            </div>
            @endforeach

            {{ $posts->appends(['search' => request('search')])->links() }}
        </div>
    </div>
</div>
@endsection