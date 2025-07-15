@extends('front.layouts.app')

@section('content')
    <!-- Hero banner-section -->
    @if ($whySkipperPipes)
        <section class="hero-banner2">
            <div class="hero-banner2-bg">
                <img src="{{ asset('storage/' . $whySkipperPipes->image) }}" alt="">
            </div>
            <div class="hero-banner2-overlay"></div>
            <div class="hero-banner2-content">
                <h1>{{ $whySkipperPipes->title ?? '' }}</h1>
                <p>{{ $whySkipperPipes->description ?? '' }}</p>
            </div>
        </section>
    @endif
    @if ($whySkipperPipes)
        <section class="hero-banner2-responsive">
            <div class="hero-banner2-content-responsive">
                <h1>{{ $whySkipperPipes->title ?? '' }}</h1>
                <p>{{ $whySkipperPipes->description ?? '' }}</p>
            </div>
            <div class="hero-banner2-img-responsive">
                <img src="{{ asset('storage/' . $whySkipperPipes->image) }}" alt="">
            </div>
        </section>
    @endif
    <!-- Hero banner-section ends -->

    <!-- Skipper Pipes Promise section -->
    @if ($whySkipperPipesSectionThrees)
        <section class="product-overview default-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="site-heading text-center">
                            <h4>Our Promise</h4>
                            <h2>Why Skipper Pipes?</h2>
                        </div>
                    </div>
                </div>

                <div class="row align-center">
                    <div class="col-md-6 pt-3 pt-md-0">
                        <!-- <h2>Product Overview</h2> -->
                        <p>{{ $whySkipperPipesSectionThrees->description ?? '' }}</p>
                    </div>
                    <div class="col-md-6 order-first order-md-last">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                            @if ($whySkipperPipesSectionThrees->image)
                                <ol class="carousel-indicators">
                                    @foreach ($whySkipperPipesSectionThrees as $index => $image)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                                            class="{{ $index == 0 ? 'active' : '' }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img class="d-block w-100" src="{{ asset('storage/' . $image) }}"
                                                alt="Slide {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>

                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Skipper Pipes Promise section ends -->

    <!-- India's Infrastrcture section -->
    @if ($why_skipper_pipe_section_fours)
        <section class="infrastrcture-banners default-padding bg-gray ">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="site-heading text-center">
                            <h4>Skipper Pipes</h4>
                            <h2>India’s Infrastructure, Powered by Safety</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($why_skipper_pipe_section_fours as $why_skipper_pipe_section_four)
                        <div class="infrastrcture-banner-col col-12 p-0">
                            <img src="{{ asset('storage/' . $why_skipper_pipe_section_four->image) }}" alt="">
                            <div class="infrastructure-img-overlay"></div>
                            <div class="infrastrcture-banner-content">
                                <h3>{{ $why_skipper_pipe_section_four->title ?? '' }}</h3>
                                <p class="text-white">{{ $why_skipper_pipe_section_four->description ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
    @endif
    <!-- India's Infrastrcture section ends -->


    <!-- Quality Thats Speak section -->
    @if ($why_skipper_pipe_section_fives)
        <section class="left-img-col default-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="site-heading text-center">
                            <h4>Skipper Pipes</h4>
                            <h2>Quality That Speaks</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-center">
                    <div class="col-md-6">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">

                                @foreach ($why_skipper_pipe_section_fives->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img class="d-block w-100" src="{{ asset('storage/' . $image) }}"
                                            alt="First slide">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 pl-4 pt-3 pt-md-0">
                        <!-- <h2>Product Overview</h2> -->
                        <p>{{ $why_skipper_pipe_section_fives->description ?? '' }}</p>
                        <a class="btn btn-dark theme theme2 btn-md mt-3"
                            href="{{ $why_skipper_pipe_section_fives->button_link ?? '' }}" target="_blank">View Our
                            Certification</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Quality Thats Speak section ends -->


    <!-- Built for every condition section  -->
    @if ($why_skipper_pipe_section_twos)
        <section class="company-icon-sec default-padding bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Skipper Pipes</h4>
                            <h2>Built for Every Condition</h2>
                        </div>
                    </div>
                </div>
                <div class="row philosophy-wrapper text-center px-3 px-md-0">
                    @foreach ($why_skipper_pipe_section_twos as $why_skipper_pipe_section_two)
                        <div class="col-12 col-md company-icon-col">
                            <img src="{{ asset('storage/' . $why_skipper_pipe_section_two->image) }}" alt="">
                            <h4>{{ $why_skipper_pipe_section_two->title ?? '' }}</h4>
                            <p>{{ $whySkipperPipesSectionFive->description ?? '' }}</p>
                        </div>
                    @endforeach

                </div>

            </div>
        </section>
    @endif
    <!-- Built for every condition section ends -->


    <!-- product cta -->
    <section class="product-cta bg-theme text-white default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white mb-2">Join Skipper Pipes as a dealer or distributor and </h2>
                    <p class="text-white mb-md-4 pb-md-2">Unlock business growth with trusted products, strong support, and
                        nationwide reach.</p>
                    <a class="btn btn-light effect btn-md mb-3 mb-md-0" href="#">Become Dealer</a>
                    <a class="btn btn-light effect btn-md ml-md-3" href="#">Become Distributor</a>
                </div>
            </div>
        </div>
    </section>
    <!-- product cta ends -->
@endsection
