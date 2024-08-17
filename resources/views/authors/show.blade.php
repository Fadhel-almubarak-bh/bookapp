<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@extends('vendor.bookapp.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #343a40; color: white;">
                    <a href="{{ route('authors.index') }}" class="btn btn-secondary mr-auto">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h3 class="text-center w-100 mb-0">View Author</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Author Name:</label>
                        <input type="text" id="name" class="form-control" value="{{ $author->name }}" readonly>
                    </div>

                    <h4 class="mt-4">Books by {{ $author->name }}</h4>
                    @if($books->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            No books found for this author.
                        </div>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $book->name }}</td>
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
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <div class="card-body text-right text-center">
                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning m-1"><i class="fas fa-edit"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#deleteConfirmationModal"><i class="fas fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
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
                Are you sure you want to delete this author?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="{{ route('authors.destroy', $author->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
