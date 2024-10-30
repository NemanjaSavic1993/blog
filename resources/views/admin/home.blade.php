@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.partials.sidebar')
        <div class="col-9">
            <!-- <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ (url()->current() == route('admin.home')) ? 'active' : '' }}" aria-current="page" href="{{ route('admin.home') }}">Korisnici</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="">Uloge</a>
                </li>
            </ul> -->
            <!-- ispis poruka -->
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
                

            <!-- prikazati sve registrovane korisnike -->

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->name }}</td>
                        <td><a href="{{ route('admin.editUser',['id' => $user->id]) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->appends(['search' => request('search')])->links() }}
        </div>
    </div>
</div>
@endsection