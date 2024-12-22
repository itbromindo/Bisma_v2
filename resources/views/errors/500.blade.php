@extends('errors.errors_layout')

@section('title')
    500 - Internal Server Error
@endsection

@section('error-content')
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f6f8;
        color: #343a40;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
    }

    .error-box {
        border: 1px solid #dee2e6;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    hr {
        border-top: 1px solid #dee2e6;
    }

</style>
<div class="container text-center mt-5">
    <div class="error-box shadow p-5 rounded" style="max-width: 600px; margin: auto; background-color: #f8f9fa;">
        <h2 class="display-1 text-danger">500</h2>
        <p class="lead">Internal Server Error</p>
        <hr>
        
        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary me-2">
                <i class="bi bi-house-door-fill"></i> Back to Dashboard
            </a>
            <a href="{{ route('admin.login') }}" class="btn btn-warning">
                <i class="bi bi-box-arrow-in-right"></i> Login Again
            </a>
        </div>
    </div>
</div>
@endsection