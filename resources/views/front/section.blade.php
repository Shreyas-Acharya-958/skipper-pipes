@extends('front.layouts.app')

@section('content')
    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="{{ asset('storage/' . $page->image) }}" alt="{{ image_alt_text('storage/' . $page->image, $page->title) }}">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>{{ $page->title }}</h1>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>{{ $page->title }}</h1>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('storage/' . $page->image) }}" alt="{{ image_alt_text('storage/' . $page->image, $page->title) }}">
        </div>
    </section>
    <!-- Hero banner-section ends -->

    <!-- Breadcrumb  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active">{{ $page->title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="legal-sec default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 legal-sec-content">
                    {!! $page->long_description !!}
                </div>
            </div>
        </div>
    </section>


    <!-- product cta -->
    <section class="product-cta bg-theme text-white default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white mb-4">Join India’s Most Trusted Network.</h2>
                    <p class="text-white mb-md-4 pb-md-2">Partner with Skipper Pipes to unlock growth, recognition, and
                        unmatched support across India’s largest and most trusted piping network.</p>
                    <a class="btn btn-light effect btn-md mb-3 mb-md-0" href="{{ url('/partner/become-dealer') }}">Become
                        Dealer</a>
                    <a class="btn btn-light effect btn-md ml-md-3" href="{{ url('/partner/become-distributor') }}">Become
                        Distributor</a>
                </div>
            </div>
        </div>
    </section>
    <!-- product cta ends -->
@endsection
