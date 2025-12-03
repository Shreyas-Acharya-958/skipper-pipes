@extends('admin.layouts.app')
@section('title', '404 - Page Not Found')
@push('styles')
    <style>
        .error-page-404 {
            display: flex;
            min-height: calc(100vh - 200px);
            text-align: center;
            justify-content: center;
            align-items: center;
            background-color: #144372;
            border-radius: 8px;
            padding: 50px 20px;
        }

        .error-page-404 h1 {
            font-size: clamp(80px, 10vw, 180px);
            font-weight: 800;
            color: white;
        }

        .error-page-404 p {
            color: white;
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 50px;
        }

        .error-page-404 .btn-light {
            background: white;
            color: #144372;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .error-page-404 .btn-light:hover {
            background-color: #FFA800;
            color: #144372;
            transform: translateY(-2px);
        }
    </style>
@endpush
@section('content')
    <section class="error-page-404">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>404</h1>
                    <p>We can't seem to find the page you're looking for</p>
                    <a class="btn btn-light" href="{{ route('admin.dashboard') }}">Go to Dashboard</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
