<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@extends('vendor.bookapp.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-white" style="background-color: #343a40; color: white;">
            <a href="{{ route('books.index') }}" class="btn btn-secondary mr-auto">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="text-center w-100">Create New Book</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST">
                @csrf

                <!-- Book Name -->
                <div class="form-group">
                    <label for="name">Book Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                </div>

                <!-- Authors -->
                <div class="form-group">
                    <label for="authors">Select Authors:</label>
                    <select name="author_ids[]" id="authors" class="form-control" multiple required>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Categories -->
                <div class="form-group">
                    <label for="categories">Select Categories</label>
                    <select name="category_ids[]" id="categories" class="form-control" multiple required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Locations -->
                <div class="form-group">
                    <label for="locations">Select Locations</label>
                    <select name="location_ids[]" id="locations" class="form-control" multiple required>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="card-body text-right text-center w-100">
                    <button type="submit" class="btn btn-primary m-1"> <i class="fas fa-file-alt"></i> Create Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
