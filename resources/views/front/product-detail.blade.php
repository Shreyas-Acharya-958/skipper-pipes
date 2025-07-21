@extends('front.layouts.app')

@section('content')
    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="{{ asset('storage/' . $product->page_image) }}" alt="">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>{{ $product->title }}</h1>
            <p>{{ $product->meta_description }}</p>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>{{ $product->title }}</h1>
            <p>{{ $product->meta_description }}</p>

        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('storage/' . $product->page_image) }}" alt="">
            
        </div>
    </section>

   <!-- Breadcrumb  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li>Products</li>
                        <li class="active">{{$product -> title}}</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <!-- Product Overview -->
    <section class="product-overview default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading text-center">
                        <h4>{{ $product->title }}</h4>
                        <h2>Product Overview</h2>

                    </div>
                </div>
            </div>
            <div class="row align-center">
                <div class="col-md-6">
                    <p>{{ $product->productionOverviewSection->overview_description ?? '' }}</p>
                </div>
                <div class="col-md-6">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        @if ($product->productionOverviewSection && $product->productionOverviewSection->overview_image)
                            @php
                                $images = json_decode($product->productionOverviewSection->overview_image, true);
                            @endphp
                            <ol class="carousel-indicators">
                                @foreach ($images as $index => $image)
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
    <!-- Product Overview ends -->
    <!-- Product Overview ends -->


    <!-- Key Features & Benefits -->
    <section class="key-features-benefits bg-gray">
        <div class="work-process-area relative default-padding bottom-less bg-fixed">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="site-heading text-center">
                            <h4>{{ $product->title }}</h4>
                            <h2>Key Features & Benefits</h2>
                        </div>
                    </div>

                </div>
                <div class="work-pro-items">
                    <div class="row">
                        @foreach ($product->productionFeaturesSections as $feature)
                            <div class="col-lg-4 col-md-6 single-item">
                                <div class="item">
                                    <div class="item-inner">
                                        <img src="{{ asset('storage/' . $feature->icon) }}"
                                            alt="{{ $feature->title }}">
                                        <h4>{{ $feature->title }} </h4>
                                        <p>{{ $feature->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Key Features & Benefits ends -->


    <!-- Product Technical Table -->
    <section class="product-technical default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading text-center">
                        <h4>{{ $product->title }}</h4>
                        <h2>Product Technical</h2>

                    </div>
                </div>
            </div>
            <div class="row">
                {!! $product->technical !!}
            </div>
        </div>
    </section>
    <!-- Product Technical Table ends -->


    <!-- Product Application -->
    <section class="services-page-one bg-gray default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading text-center">
                        <h4>{{ $product->title }}</h4>
                        <h2>Product Application</h2>

                    </div>
                </div>

            </div>
            <div class="row">
                @foreach ($product->productionApplicationSections as $application)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="services-one__single">
                            <div class="services-one__img-box">
                                <div class="services-one__img"><img src="{{ asset('storage/' . $application->image) }}"
                                        alt=""></div>
                                <div class="services-one__shape-1"></div>
                                <div class="services-one__icon"><img src="{{ asset('storage/' . $application->icon) }}"
                                        alt=""></div>
                                <a class="services-one__arrow"><i class="icon-right-arrow"></i></a>
                            </div>
                            <div class="services-one__content">
                                <h3 class="services-one__title">{{ $application->title }}</h3>
                                <p>{{ $application->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Application ends -->

    <!-- product cta -->
    <section class="product-cta bg-theme text-white default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white mb-4">Everything You Need to Know</h2>
                    <a class="btn btn-light effect btn-md" target="_blank"
                        href="{{ asset('storage/' . $product->brochure) }}" download>Download
                        Brochure</a>
                </div>
            </div>
        </div>
    </section>
    <!-- product cta ends -->

    <!-- Product Faq  -->
    <section class="product-faq default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading text-center">
                        <h4>{{ $product->title }}</h4>
                        <h2>Frequently Asked Questions</h2>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="accordion" id="accordionExample">
                        @foreach ($product->productionFaqSections as $index => $faq)
                            <div class="card">
                                <div class="card-header" id="heading{{ $index }}">
                                    <h2 class="mb-0">
                                        <button
                                            class="btn btn-link btn-block text-left {{ $index > 0 ? 'collapsed' : '' }}"
                                            type="button" data-toggle="collapse"
                                            data-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                                            {{ $faq->title }}
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse{{ $index }}" class="collapse {{ $index == 0 ? 'show' : '' }}"
                                    aria-labelledby="heading{{ $index }}" data-parent="#accordionExample">
                                    <div class="card-body">
                                        {{ $faq->description }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Faq ends -->

    <!-- product cta -->
    <section class="product-cta bg-theme text-white default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white">Ready to Install India’s Safest {{ $product->title }}?</h2>
                    
                    <a class="btn btn-light effect btn-md mr-md-3 mb-3 mb-lg-0" href="tel:+913322851231"><i
                            class="far fa-phone-alt"></i>
                        +91 33 2285 1231 / 32</a>
                    <a class="btn btn-light effect btn-md mr-md-3 mb-3 mb-lg-0"
                        href="mailto:enquiry@skipperpipes.com">enquiry@skipperpipes.com</a>

                    <a class="btn btn-light effect btn-md" target="_blank"
                        href="{{ asset('storage/' . $product->brochure) }}" download>Download
                        Brochure</a>
                </div>
            </div>
        </div>
    </section>
    <!-- product cta ends -->
@endsection
