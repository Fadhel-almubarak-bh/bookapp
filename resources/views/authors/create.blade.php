<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@extends('vendor.bookapp.layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white" style="background-color: #343a40; color: white;">
                    <a href="{{ route('authors.index') }}" class="btn btn-secondary mr-auto">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h3 class="text-center w-100 mb-0">Add a New Author</h3>
                </div>
                <div class="card-body">
                    <!-- Author Creation Form -->
                    <form action="{{ route('authors.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Author Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="card-body text-center">
                            <button type="submit" class="btn btn-success m-1"> <i class="fas fa-file-alt"></i> Add Author</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection