@extends('front.layouts.app')
@section('styles')
     <style>
        .thank-you-sec {
            display: flex;
            min-height: 95vh;
            text-align: center;
            justify-content: center;
            align-items: center;
            background-color: #144372;
        }

        .thank-you-sec h1{
            font-size: 40px;
            font-weight: 800;
            color: white;
        }

        .thank-you-sec p{
            color: white;
            max-width: 1000px;
            text-align: center;
            font-size: 20px;
            line-height: 1.5;
            font-weight: 500;
            margin: auto;
            margin-bottom: 50px;
        }

        .thank-you-sec .btn-light::after{
            background: white !important;
            color: #144372;
        }

        .thank-you-sec .btn-light:hover{
            color: #144372 !important;
        }

        @media(max-width: 576px){
            .thank-you-sec h1{
                font-size: 28px;
            }
            .thank-you-sec p{
                font-size: 18px;
            }
        }

    </style>
@endsection
@section('content')
    <section class="thank-you-sec default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                        
                        <h1>Thank You for Your Interest in Our Private Project Services</h1>
                        <p>Your inquiry has been successfully submitted. Our team will review your details and contact you shortly with the next steps. </p>
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