@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('moderator.partials.sidebar')
        <div class="col-9">
           <form action="{{ route('mod.storeCategory') }}" method="post">
                @csrf
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control mb-3">
                
                <input type="checkbox" class="mb-3 form-check-input" name="valid" id="valid" {{ old('valid') ? 'checked' : '' }}>
                <label class="form-check-label" for="valid">Valid</label><br>

                <div class="col-3 float-end d-flex justify-content-end">
                    <button class="btn btn-primary">Save</button>
                    <a class="btn btn-danger ms-3" href="{{ route('admin.home') }}">Cancel</a>   
                </div>
           </form>
        </div>
    </div>
</div>
@endsection