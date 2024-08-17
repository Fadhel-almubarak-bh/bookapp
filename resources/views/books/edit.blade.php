<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@extends('vendor.bookapp.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-white" style="background-color: #343a40; color: white;">
            <a href="{{ route('books.index') }}" class="btn btn-secondary mr-auto">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="text-center w-100">Edit Book</h2>
        </div>

        <div class="card-body">
            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Book Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $book->name }}" required>
                </div>

                <div class="form-group">
                    <label for="authors">Select Authors:</label>
                    <select name="author_ids[]" id="authors" class="form-control" multiple required>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ $book->authors->contains($author->id) ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="categories">Categories:</label>
                    <select name="category_ids[]" id="categories" class="form-control" multiple required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->categories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="locations">Locations:</label>
                    <select name="location_ids[]" id="locations" class="form-control" multiple required>
                        @foreach ($locations as $location)
                            <option value="{{ $location->id }}" {{ $book->locations->contains($location->id) ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="card-body text-right text-center w-100">
                    <button type="submit" class="btn btn-primary m-1"><i class="fas fa-sync"></i> Update Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
