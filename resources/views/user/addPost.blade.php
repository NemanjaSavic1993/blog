@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('user.partials.sidebar')
        <div class="col-9">
            <!-- prikazati formu za unos postova -->
            <form action="{{ route('user.storePost') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control mb-3">

                <label for="body" class="form-label">Body:</label>
                <textarea name="body" id="body" class="form-control" cols="30" rows="10"></textarea><br>


                <label for="category" class="form-label">Category:</label>
                <select name="category" id="category" class="form-select mb-3">
                    <option value="">Select...</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <div class="mb-3">
                    <label for="images" class="form-label">Images:</label>
                    <input class="form-control" type="file" name="images[]" multiple>
                </div>

                <input type="checkbox" class="mb-3 form-check-input" name="published" id="published">
                <label class="form-check-label" for="published">
                    Published
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