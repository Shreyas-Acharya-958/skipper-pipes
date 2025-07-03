@extends('front.layouts.app')

@section('title', $seoData['meta_title'])

@section('meta')
    <meta name="description" content="{{ $seoData['meta_description'] }}">
    <meta name="keywords" content="{{ $seoData['meta_keywords'] }}">
@endsection

@section('content')


    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="{{ asset('storage/' . $page->page_image) }}" alt="{{ $page->title }}">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>{{ $page->title }}</h1>
            <p>{{ $page->short_description }}</p>
        </div>
    </section>
    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>{{ $page->title }}</h1>
            <p>{{ $page->short_description }}</p>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('storage/' . $page->page_image) }}" alt="{{ $page->title }}">
        </div>
    </section>
    <!-- Hero banner-section ends -->


    @if ($slug == 'overview')
        @include('front.company-section.overview')
    @elseif ($slug == 'manufacturing')
        @include('front.company-section.manufacturing')
    @elseif ($slug == 'leadership')
        @include('front.company-section.leadership')
    @elseif ($slug == 'csr')
        @include('front.company-section.csr')
    @elseif ($slug == 'certifications')
        @include('front.company-section.certifications')
    @endif




@endsection

@push('scripts')
    <script>
        // Initialize counters
        $('.timer').each(function() {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).data('to')
            }, {
                duration: $(this).data('speed'),
                easing: 'swing',
                step: function(now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });

        // Initialize Swiper for timeline
        var timelineSwiper = new Swiper('.timeline-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
@endpush
