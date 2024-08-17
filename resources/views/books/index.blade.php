<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@extends('vendor.bookapp.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Books List</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
        </a>
        {{-- <a href="{{ route('authors.create') }}" class="btn btn-primary">Add New Author</a>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
        <a href="{{ route('locations.create') }}" class="btn btn-primary">Add New Locaiton</a> --}}
    </div>

    <form method="GET" action="{{ route('books.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name or author" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="category_id" class="form-control">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="location_id" class="form-control">
                    <option value="">All Locations</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->id }}" {{ request('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </form>

    @if($books->isEmpty())
        <div class="alert alert-warning" role="alert">
            No books available.
        </div>
    @else
        <table class="table mt-4s">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Authors</th>
                    <th>Categories</th>
                    <th>Locations</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->authors->pluck('name')->join(', ') }}</td>
                        <td>{{ $book->categories->pluck('name')->join(', ') }}</td>
                        <td>{{ $book->locations->pluck('name')->join(', ') }}</td>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteConfirmationModal{{ $book->id }}"><i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteConfirmationModal{{ $book->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $book->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $book->id }}">Confirm Deletion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this book?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
