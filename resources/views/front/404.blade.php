@extends('front.layouts.app')
@section('styles')
    <style>
        .error-page-404 {
            display: flex;
            min-height: 95vh;
            text-align: center;
            justify-content: center;
            align-items: center;
            background-color: #144372;
        }

        .error-page-404 h1{
            font-size: clamp(80px, 10vw, 180px);
            font-weight: 800;
            color: white;
        }

        .error-page-404 p{
            color: white;
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 50px;
        }

        .error-page-404 .btn-light::after{
            background: white !important;
            color: #144372;
        }

        .error-page-404 .btn-light:hover{
            color: #144372 !important;
        }
    </style>
@endsection
@section('content')
     <section class="error-page-404 default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                        <h1>404</h1>
                        <p>We can't seem to find the page you're looking for</p>
                        <a class="btn btn-light effect btn-md" href="{{ url('/') }}">Go to Homepage</a>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
@endsection