@extends('front.layouts.app')

@section('content')
    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="{{ asset('storage/' . $mainNetwork->image) }}" alt="{{ image_alt_text('storage/' . $mainNetwork->image, $mainNetwork->title) }}">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>{{ $mainNetwork->title }}</h1>
            <p>{{ $mainNetwork->description }}</p>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>{{ $mainNetwork->title }}</h1>
            <p>{{ $mainNetwork->description }}</p>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('storage/' . $mainNetwork->image) }}" alt="{{ image_alt_text('storage/' . $mainNetwork->image, $mainNetwork->title) }}">
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
                        <li class="active">Network</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <!-- Manufacturing Overview -->
    <section class="manufacturing-overview default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4 data-aos="fade-up" data-aos-duration="1000">SKipper Pipes</h4>
                        <h2 data-aos="fade-up" data-aos-duration="1000">Network Overview</h2>
                        <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100" class="p-0">
                            {{ $mainNetwork->overview }}</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="our-network-sec default-padding bg-gray px-3 px-md-0">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>SKipper Pipes</h4>
                        <h2>How We Engage and Empower Our Network:</h2>
                    </div>
                </div>
            </div>
            @foreach ($networks as $index => $network)
                @php
                    $isEven = $index % 2 === 0;
                @endphp

                <div class="row {{ $isEven ? 'left-img_full-col' : 'right-img_full-col' }} p-md-0 align-items-center"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    @if ($isEven)
                        <div class="col-md-5 p-0">
                            <img src="{{ asset('storage/' . $network->image) }}" alt="{{ image_alt_text('storage/' . $network->image, $network->title) }}">
                        </div>
                        <div class="col-md-7 p-lg-0 py-4 py-lg-0">
                            <h3>{{ $network->title }}</h3>
                            <p>{{ $network->description }}</p>
                        </div>
                    @else
                        <div class="col-md-7 p-lg-0 py-4 py-lg-0">
                            <h3>{{ $network->title }}</h3>
                            <p>{{ $network->description }}</p>
                        </div>
                        <div class="col-md-5 p-0 order-first order-md-last">
                            <img src="{{ asset('storage/' . $network->image) }}" alt="{{ image_alt_text('storage/' . $network->image, $network->title) }}">
                        </div>
                    @endif
                </div>
            @endforeach

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
                    <a class="btn btn-light effect btn-md mb-3 mb-md-0" href="{{ url('partner/become-dealer') }}">Become
                        Dealer</a>
                    <a class="btn btn-light effect btn-md ml-md-3" href="{{ url('partner/become-distributor') }}">Become
                        Distributor</a>
                </div>
            </div>
        </div>
    </section>
    <!-- product cta ends -->
@endsection
