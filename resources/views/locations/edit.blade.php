<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@extends('vendor.bookapp.layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white" style="background-color: #343a40; color: white;">
                    <a href="{{ route('locations.index') }}" class="btn btn-secondary mr-auto">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h3 class="text-center w-100 mb-0">Edit Location</h3>
                </div>
                <div class="card-body">
                    <!-- Location Edit Form -->
                    <form id="editLocationForm" action="{{ route('locations.update', $location->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Location Name:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $location->name) }}" required>
                        </div>

                        <div class="card-body text-center">
                            <button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#confirmUpdateModal"><i class="fas fa-sync"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Confirmation Modal -->
<div class="modal fade" id="confirmUpdateModal" tabindex="-1" role="dialog" aria-labelledby="confirmUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmUpdateModalLabel">Confirm Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to update this location?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="confirmUpdateButton"><i class="fas fa-sync"></i> Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('confirmUpdateButton').addEventListener('click', function() {
        document.getElementById('editLocationForm').submit();
    });
</script>
@endsection
