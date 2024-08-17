<!-- resources/views/books/show.blade.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@extends('vendor.bookapp.layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-white" style="background-color: #343a40; color: white;">
                <a href="{{ route('books.index') }}" class="btn btn-secondary mr-auto">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2 class="text-center w-100">{{ $book->name }}</h2>
            </div>
            
            
            <div class="card-body">
                <div class="mb-4">
                    <h4 class="text-secondary">Authors</h4>
                    @foreach($book->authors as $author)
                        <a href="{{ route('authors.show', $author->id) }}" class="btn btn-outline-info btn-lg m-1">{{ $author->name }}</a>
                    @endforeach
                </div>

                <div class="mb-4">
                    <h4 class="text-secondary">Categories</h4>
                    @foreach($book->categories as $category)
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-outline-success btn-lg m-1">{{ $category->name }}</a>
                    @endforeach
                </div>

                <div class="mb-4">
                    <h4 class="text-secondary">Locations</h4>
                    @foreach($book->locations as $location)
                        <a href="{{ route('locations.show', $location->id) }}" class="btn btn-outline-danger btn-lg m-1">{{ $location->name }}</a>
                    @endforeach
                </div>
            </div>
            <div class="card-body text-right">
                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning m-1"><i class="fas fa-edit"></i> Edit
                </a>
                <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#deleteConfirmationModal"><i class="fas fa-trash"></i> Delete
                </a>
                
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this book?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="{{ route('books.destroy', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="card-footer text-right">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
