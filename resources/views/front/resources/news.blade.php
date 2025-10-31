@extends('front.layouts.app')

@section('content')
    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="{{ asset('storage/' . $news_section_two->image ?? '') }}" alt="news-banner-image">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>{{ $news_section_two->title ?? 'News' }}</h1>
            <p>{!! $news_section_two->description ??
                'All the latest announcements, insights, growth stories, and project news here.' !!}
            </p>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>{{ $news_section_two->title ?? 'News' }}</h1>
            <p>{!! $news_section_two->description ??
                'All the latest announcements, insights, growth stories, and project news here.' !!}</p>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('storage/' . $news_section_two->image ?? '') }}" alt="news-banner-image">
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
            <div class="row" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>SKipper Pipes</h4>
                        <h2>{{ $news_section_one->title ?? 'News' }}</h2>
                        <p class="p-0">
                            {!! $news_section_one->description ??
                                'All the latest announcements, insights, growth stories, and project news here.' !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row news-col-wrapper mt-4">
                @foreach ($news as $item)
                    <div class="col-md-6 col-lg-4 mb-lg-5 mb-md-5 mb-3 news-col-wrapper" data-aos="fade-up"
                        data-aos-duration="1000" data-aos-delay="100">
                        <div class="news-col">
                            <span class="sub-title">Press Release</span>
                            {{-- 25th april 2025 --}}
                            <span class="news-date">{{ date('d', strtotime($item->press_release)) }}
                                {{ date('M', strtotime($item->press_release)) }}
                                {{ date('Y', strtotime($item->press_release)) }}</span>
                            <h3>{{ $item->title }}</h3>
                            @php
                                $isExternal = $item->file && preg_match('/^https?:\/\//i', $item->file);
                                $href = $isExternal
                                    ? $item->file
                                    : ($item->file
                                        ? asset('storage/' . $item->file)
                                        : '#');
                            @endphp
                            @if ($item->file)
                                <a href="{{ $href }}" class="btn btn-dark theme2 theme mt-2" target="_blank">View
                                    Details</a>
                            @endif
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
                    <h2 class="text-white mb-2">Join Skipper Pipes as a Dealer or Distributor.</h2>
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
