@extends('front.layouts.app')

@section('content')
    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="{{ asset('/assets/img/final/news-hero-section.png') }}" alt="">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>News</h1>
            <p>All the latest announcements, insights, growth stories, and project news here.</p>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>News</h1>
            <p>All the latest announcements, insights, growth stories, and project news here.</p>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('/assets/img/final/news-hero-section.png') }}" alt="">
        </div>
    </section>
    <!-- Hero banner-section ends -->

    <!-- Breadcrumb  -->
    <div class="breadcrumb-area bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="active">News</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="news-overview default-padding bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>SKipper Pipes</h4>
                        <h2>Innovation, Growth, and Brand News</h2>
                        <p>Discover recent product developments, strategic milestones, market expansions, and impactful updates shaping our journey forward.</p>
                    </div>
                </div>
            </div>
            <div class="row news-col-wrapper mt-4">
                @foreach ($news as $item)
                    <div class="col-md-6 col-lg-4 mb-lg-5 mb-md-5 mb-3 news-col-wrapper">
                        <div class="news-col">
                            <span class="sub-title">Press Release</span>
                            {{-- 25th april 2025 --}}
                            <span class="news-date">{{ date('d', strtotime($item->press_release)) }}
                                {{ date('M', strtotime($item->press_release)) }}
                                {{ date('Y', strtotime($item->press_release)) }}</span>
                            <h3>{{ $item->title }}</h3>
                            <a href="{{ asset('storage/' . $item->file) }}" class="btn btn-dark theme2 theme mt-4"
                                target="_blank">View Details</a>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>
    </section>


    <!-- product cta -->
    <section class="product-cta bg-theme text-white default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white mb-2">Join Skipper Pipes as a Dealer or Distributor</h2>
                    <p class="text-white mb-md-4 pb-md-2">Unlock business growth with trusted products, strong support, and
                        nationwide reach.</p>
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
