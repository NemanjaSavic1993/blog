@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('user.partials.sidebar')
        <div class="col-9">
            @if(session()->has('message'))
                <div class="alert alert-success mt-3">
                    {{ session()->get('message') }}
                </div>
            @endif

            <form action="{{ route('admin.home') }}" method="get">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" value="{{ old('search') }}" placeholder="Search..." aria-label="Search..." aria-describedby="search">
                    <button type="submit" class="btn btn-primary input-group-text" id="search">Search</button>
                </div>
            </form>

           <!-- izlistati sve blogove ulogovanog korisnika -->
            
           <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Published</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->created_at->format('d.m.Y. H:i') }}</td>
                        <td>{{ ($post->published == 1) ? 'Yes' : 'No' }}</td>
                        <td><a href="{{ route('user.editPost', ['id' => $post->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $posts->appends(['search' => request('search')])->links() }}
            
        </div>
    </div>
</div>
@endsection