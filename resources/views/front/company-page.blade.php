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
        @include('front.company-section.overview', [
            'overview_section_ones' => $data['overview_section_ones'],
            'overview_section_twos' => $data['overview_section_twos'],
            'overview_section_threes' => $data['overview_section_threes'],
            'overview_section_fours' => $data['overview_section_fours'],
            'overview_section_fives' => $data['overview_section_fives'],
        ])
    @elseif ($slug == 'manufacturing')
        @include('front.company-section.manufacturing', [
            'manufacturing_section_ones' => $data['manufacturing_section_ones'],
            'manufacturing_section_twos' => $data['manufacturing_section_twos'],
            'manufacturing_section_threes' => $data['manufacturing_section_threes'],
            'manufacturing_section_fours' => $data['manufacturing_section_fours'],
        ])
    @elseif ($slug == 'leadership')
        @include('front.company-section.leadership', [
            'leadership_section_ones' => $data['leadership_section_ones'],
            'leadership_section_twos' => $data['leadership_section_twos'],
            'leadership_section_threes' => $data['leadership_section_threes'],
            'leadership_section_fours' => $data['leadership_section_fours'],
        ])
    @elseif ($slug == 'csr')
        @include('front.company-section.csr', [
            'csr_section_ones' => $data['csr_section_ones'],
            'csr_section_twos' => $data['csr_section_twos'],
            'csr_section_threes' => $data['csr_section_threes'],
        ])
    @elseif ($slug == 'certifications')
        @include('front.company-section.certifications', [
            'certifications_section_ones' => $data['certifications_section_ones'],
        ])
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
