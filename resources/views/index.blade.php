<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@extends('vendor.bookapp.layouts.app')
@section('content')
<div class="container d-flex justify-content-center align-items-center" >
    <div class="card w-100" style="max-width: 800px;",>
        <div class="card-header text-white text-center" style="background-color: #343a40;">
            <h1 class="mb-0" style="font-size: 1.5rem;">Home Page</h1>
        </div>
        <div class="card-body p-2">
            <div class="row text-center justify-content-center">
                <div class="col-md-5 mb-2">
                    <a href="/books" class="card bg-secondary text-white" style="border-radius: 10px; padding: 20px;">
                        <div class="card-body">
                            <i class="fas fa-book fa-2x mb-2"></i>
                            <h5>Books</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-5 mb-2">
                    <a href="/authors" class="card bg-secondary text-white" style="border-radius: 10px; padding: 20px;">
                        <div class="card-body">
                            <i class="fas fa-user fa-2x mb-2"></i>
                            <h5>Authors</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row text-center justify-content-center">
                <div class="col-md-5 mb-2">
                    <a href="/categories" class="card bg-secondary text-white" style="border-radius: 10px; padding: 20px;">
                        <div class="card-body">
                            <i class="fas fa-list fa-2x mb-2"></i>
                            <h5>Categories</h5>
                        </div>
                    </a>
                </div>
                <div class="col-md-5 mb-2">
                    <a href="/locations" class="card bg-secondary text-white" style="border-radius: 10px; padding: 20px;">
                        <div class="card-body">
                            <i class="fas fa-map-marker-alt fa-2x mb-2"></i>
                            <h5>Locations</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
