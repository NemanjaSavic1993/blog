@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>{{ $post->title }}</h3>
            <hr>
            <p>{{ $post->body }}</p>
            <span>From category: <b>{{ $post->category->name }}</b></span>
            <span>created by {{ $post->user->name }} at {{ $post->created_at->format('d.m.Y.') }}</span>
        </div>
    </div>
    <div class="row">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                @foreach($images as $img)
                <div class="carousel-item {{ ($loop->index == 0) ? 'active' : '' }}">
                    <img src="{{ asset('storage/'.$img->path) }}" class="d-block w-100 img-fluid" alt="1">
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    @if(Auth::user()->roles->name == 'Moderator')
        <div class="row">
            <div class="col-md-3">
                <a href="{{ route('banPost', ['id' => $post->id]) }}" class="btn btn-danger">Ban post</a>
            </div>
        </div>
    @endif
</div>
@endsection