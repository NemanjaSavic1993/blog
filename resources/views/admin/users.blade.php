@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.partials.sidebar')
        <div class="col-9">
            <!-- prikazati formu za izmenu korisnika -->
            <form action="{{ route('admin.updateUser') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" readonly disabled value="{{ $user->name }}" class="form-control mb-3">
                <label for="role" class="form-label">Role:</label>
                <select name="role" id="role" class="form-select mb-3">
                    <option value="">Select...</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{($role->id == $user->role_id) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')
                <label class="text-danger mb-3">{{ $errors->first('role') }}</label><br>
                @enderror
                <input type="checkbox" class="mb-3 form-check-input" name="banned" id="banned" {{ $user->banned ? 'checked' : '' }}>
                <label class="form-check-label" for="banned">
                    Banned
                </label><br>
                <div class="col-3 float-end d-flex justify-content-end">
                    <button class="btn btn-primary">Save</button>
                    <a class="btn btn-danger ms-3" href="{{ route('admin.home') }}">Cancel</a>   
                </div>
                
            </form>

        </div>
    </div>
</div>
@endsection