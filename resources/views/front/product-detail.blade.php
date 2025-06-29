@extends('front.layouts.app')

@section('content')
    <!-- Hero Banner -->
    <section class="hero-banner">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="hero-banner-img">
                        <img src="{{ asset('assets/img/final/product-single-banner1.jpg') }}" alt="hero-banner">
                    </div>
                    <div class="hero-bg-overlay"></div>
                    <div class="hero-banner-content">
                        <h1>{{ $product->title }}</h1>
                        <p>{{ $product->short_description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Overview -->
    <!-- Product Overview -->
    <section class="product-overview default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading text-center">
                        <h4>UPVC Pipes</h4>
                        <h2>Product Overview</h2>
                        <!-- <p>
                                                                                                                   Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere dolore repellat at quod nulla officiis.
                                                                                                                </p> -->
                    </div>
                </div>
            </div>
            <div class="row align-center">
                {!! $product->product_overview !!}
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
                            <h4>UPVC Pipes</h4>
                            <h2>Key Features & Benefits</h2>
                            <!-- <p>
                                                                                                                                                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut excepturi hic nesciunt cupiditate soluta, minus ut autem commodi explicabo exercitationem!
                                                                                                                                                                </p> -->
                        </div>
                    </div>

                </div>
                <div class="work-pro-items">
                    <div class="row">
                        {!! $product->features_benefits !!}
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
                        <h4>UPVC Pipes</h4>
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
                        <h4>UPVC Pipes</h4>
                        <h2>Product Application</h2>

                    </div>
                </div>

            </div>
            <div class="row">
                {!! $product->application !!}
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
                        <h4>UPVC Pipes</h4>
                        <h2>Frequently Asked Questions</h2>

                    </div>
                </div>
            </div>
            <div class="row">
                {!! $product->faq !!}
            </div>
        </div>
    </section>
    <!-- Product Faq ends -->

    <!-- product cta -->
    <section class="product-cta bg-theme text-white default-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="text-white">Ready to Install India’s Safest UPVC Pipes?</h2>
                    <p class="text-white pb-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Esse nemo
                        assumenda facilis unde debitis, quia quam pariatur. Facilis magni voluptates sint dolorum </p>
                    <a class="btn btn-light effect btn-md mr-md-3" href="tel:+913322851231"><i class="far fa-phone-alt"></i>
                        +91 33 2285 1231 / 32</a>
                    <a class="btn btn-light effect btn-md mr-md-3"
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
