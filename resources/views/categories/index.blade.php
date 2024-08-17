<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@extends('vendor.bookapp.layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Categories List</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <form method="GET" action="{{ route('categories.index') }}">
        <div class="row">
            <div class="col-md-5">
                <input type="text" name="name" id="name" class="form-control" placeholder="Search by Name" value="{{ request('name') }}">
            </div>

            <div class="col-md-5">
                <input type="number" name="books_count" id="books_count" class="form-control" placeholder="Search by Number of Books" value="{{ request('books_count') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </form>

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
            <strong>Warning!</strong> {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table mt-4">
        <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Number of Books</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->books_count }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                            View
                        </a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteConfirmationModal{{ $category->id }}">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </td>
                </tr>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteConfirmationModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $category->id }}">Confirm Deletion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete the category with name "{{ $category->name }}"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="3">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
