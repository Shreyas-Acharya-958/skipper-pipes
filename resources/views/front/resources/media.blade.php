@extends('front.layouts.app')

@section('content')
    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="{{ asset('assets/img/final2/Resources/media-hero-section1.jpg') }}" alt="">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>Media</h1>
            <p>Where our brand speaks — through visuals, coverage, and industry collaborations.</p>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>Media</h1>
            <p>Where our brand speaks — through visuals, coverage, and industry collaborations.</p>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('assets/img/final/media-hero-section.png') }}" alt="">
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
                        <li class="active">Media</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>




    <section class="main-faqs-sec default-padding">
        <div class="container py-4">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>SKipper Pipes</h4>
                        <h2>Brand Stories, Coverage and Highlights</h2>
                        <p>Explore our latest achievements, celebrated campaigns, and featured media appearances that showcase our brand’s continued excellence.</p>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <!-- FAQ Category Tabs -->
                    <ul class="nav nav-pills mb-4 pb-3 mt-4 media-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-category="company">Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-category="events">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-category="awards">Awards</a>
                        </li>

                    </ul>

                    <!-- media Sections -->
                    <div class="faq-wrapper">
                        <!-- Comaany -->
                        <div class="media-section" data-category="company">
                            <!-- <h3 class="faq-col-title">General Questions Faqs</h3> -->
                            <div class="row">

                                @foreach ($media['Company'] as $item)
                                    <div class="col-lg-4 col-md-6 py-2 px-2">
                                        @if ($item->file_type == 'youtube_link')
                                            <iframe width="100%" height="250px" src="{{ $item->file }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        @elseif ($item->file_type == 'pdf')
                                            @if ($item->thumbnail)
                                                <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                    alt="{{ $item->title }}" class="img-fluid">
                                            @endif
                                            <div class="media-title mt-3">{{ $item->title }}</div>
                                            <a href="{{ asset('storage/' . $item->file) }}"
                                                class="btn btn-dark theme theme2 mt-4" target="_blank">View</a>
                                        @elseif ($item->file_type == 'image')
                                            <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->title }}"
                                                class="img-fluid">
                                            <div class="media-title mt-3">{{ $item->title }}</div>
                                            <a href="{{ asset('storage/' . $item->file) }}"
                                                class="btn btn-dark theme theme2 mt-4" target="_blank">View</a>
                                        @elseif ($item->file_type == 'video')
                                            <video src="{{ asset('storage/' . $item->file) }}" class="img-fluid"
                                                controls></video>
                                            <div class="media-title mt-3">{{ $item->title }}</div>
                                            <a href="{{ asset('storage/' . $item->file) }}"
                                                class="btn btn-dark theme theme2 mt-4" target="_blank">View</a>
                                        @endif
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- Events -->
                        <div class="media-section d-none" data-category="events">
                            <div class="row">
                                @if (isset($media['Events']) && count($media['Events']) > 0)
                                    @foreach ($media['Events'] as $item)
                                        <div class="col-lg-4 col-md-6 py-2 px-2">
                                            @if ($item->file_type == 'youtube_link')
                                                <iframe width="100%" height="250px" src="{{ $item->file }}"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    referrerpolicy="strict-origin-when-cross-origin"
                                                    allowfullscreen></iframe>
                                            @elseif ($item->file_type == 'pdf')
                                                @if ($item->thumbnail)
                                                    <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                        alt="{{ $item->title }}" class="img-fluid">
                                                @endif
                                                <div class="media-title mt-3">{{ $item->title }}</div>
                                                <a href="{{ asset('storage/' . $item->file) }}"
                                                    class="btn btn-dark theme theme2 mt-4" target="_blank">View</a>
                                            @elseif ($item->file_type == 'image')
                                                <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->title }}"
                                                    class="img-fluid">
                                                <div class="media-title mt-3">{{ $item->title }}</div>
                                                <a href="{{ asset('storage/' . $item->file) }}"
                                                    class="btn btn-dark theme theme2 mt-4" target="_blank">View</a>
                                            @elseif ($item->file_type == 'video')
                                                <video src="{{ asset('storage/' . $item->file) }}" class="img-fluid"
                                                    controls></video>
                                                <div class="media-title mt-3">{{ $item->title }}</div>
                                                <a href="{{ asset('storage/' . $item->file) }}"
                                                    class="btn btn-dark theme theme2 mt-4" target="_blank">View</a>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12 text-center">
                                        <p>No events media available at the moment.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Awards -->
                        <div class="media-section d-none" data-category="awards">
                            <div class="row">
                                @if (isset($media['Awards']) && count($media['Awards']) > 0)
                                    @foreach ($media['Awards'] as $item)
                                        <div class="col-lg-3 col-md-6 py-2 px-lg-2 px-md-3">
                                            <div class="awards-col">
                                                <div class="awards-img">
                                                    @if ($item->file_type == 'youtube_link')
                                                        <iframe width="100%" height="200px" src="{{ $item->file }}"
                                                            title="YouTube video player" frameborder="0"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                            referrerpolicy="strict-origin-when-cross-origin"
                                                            allowfullscreen></iframe>
                                                    @elseif ($item->file_type == 'pdf')
                                                        @if ($item->thumbnail)
                                                            <img src="{{ asset('storage/' . $item->thumbnail) }}"
                                                                alt="{{ $item->title }}" class="img-fluid">
                                                        @else
                                                            <img src="{{ asset('assets/img/final2/CBIP-award.png') }}"
                                                                alt="{{ $item->title }}" class="img-fluid">
                                                        @endif
                                                    @elseif ($item->file_type == 'image')
                                                        <img src="{{ asset('storage/' . $item->file) }}"
                                                            alt="{{ $item->title }}" class="img-fluid">
                                                    @elseif ($item->file_type == 'video')
                                                        <video src="{{ asset('storage/' . $item->file) }}"
                                                            class="img-fluid" controls></video>
                                                    @endif
                                                </div>
                                                <div class="awards-title mt-3">{{ $item->title }}</div>
                                                <a href="{{ $item->file_type == 'youtube_link' ? $item->file : asset('storage/' . $item->file) }}"
                                                    class="btn btn-dark theme theme2 mt-4" target="_blank">View</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12 text-center">
                                        <p>No awards media available at the moment.</p>
                                    </div>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>



            </div>
        </div>
    </section>


    <!-- product cta -->
    <section class="product-cta bg-theme text-white default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white mb-2">Join Skipper Pipes as a Dealer or Distributor </h2>
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
