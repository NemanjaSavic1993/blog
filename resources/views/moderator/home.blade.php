@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('moderator.partials.sidebar')
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

           <!-- izlistati sve kategorije -->

           <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $category->name }}</td>
                        <td><a href="{{ route('admin.editCategory',['id' => $category->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->appends(['search' => request('search')])->links() }}
        </div>
    </div>
</div>
@endsection