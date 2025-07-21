@extends('front.layouts.app')

@section('content')
    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="{{ asset('assets/img/final/faq-hero-section.jpg') }}" alt="">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>Frequently Asked Questions</h1>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>Frequently Asked Questions</h1>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('assets/img/final/faq-hero-section.jpg') }}" alt="">
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
                        <li class="active">FAQs</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section class="faq-overview default-padding bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>SKipper Pipes</h4>
                        <h2>India’s Safest Pipes</h2>
                        <p class="p-0">At Skipper Pipes, we are committed to transparency, customer support, and industry
                            leadership. Whether you're a homeowner, contractor, distributor, or architect — this FAQ section
                            addresses your most common queries about our products, services, and installation practices</p>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="main-faqs-sec default-padding">
        <div class="container py-4">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="site-heading headings">
                        <h4>SKipper Pipes</h4>
                        <h2>Frequenlty Asked Questions</h2>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <!-- FAQ Category Tabs -->
                    <ul class="nav nav-pills mb-4 pb-3 mt-4 faq-tabs">
                        @foreach ($faq_masters as $i => $faq_master)
                            <li class="nav-item">
                                <a class="nav-link {{ $i == 0 ? 'active' : '' }}"
                                    data-category="faq-cat-{{ $faq_master->id }}">
                                    {{ $faq_master->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <!-- FAQ Sections -->
                    <div class="faq-wrapper">
                        @foreach ($faq_masters as $i => $faq_master)
                            <div class="faq-section {{ $i == 0 ? '' : 'd-none' }}"
                                data-category="faq-cat-{{ $faq_master->id }}">
                                <h3 class="faq-col-title">{{ $faq_master->title }}</h3>
                                <div class="accordion" id="accordion-{{ $faq_master->id }}">
                                    @php $faqIndex = 1; @endphp
                                    @foreach ($faq_lists->where('faq_master_id', $faq_master->id) as $faq_list)
                                        @php
                                            $collapseId = "faq-{$faq_master->id}-{$faqIndex}";
                                        @endphp
                                        <div class="card">
                                            <div class="card-header" id="heading-{{ $collapseId }}">
                                                <h3 class="mb-0">
                                                    <button
                                                        class="btn btn-link btn-block text-left {{ $faqIndex > 1 ? 'collapsed' : '' }}"
                                                        type="button" data-toggle="collapse"
                                                        data-target="#{{ $collapseId }}"
                                                        aria-expanded="{{ $faqIndex == 1 ? 'true' : 'false' }}"
                                                        aria-controls="{{ $collapseId }}">
                                                        {{ $faqIndex }}. {{ $faq_list->question }}
                                                    </button>
                                                </h3>
                                            </div>
                                            <div id="{{ $collapseId }}"
                                                class="collapse {{ $faqIndex == 1 ? 'show' : '' }}"
                                                aria-labelledby="heading-{{ $collapseId }}"
                                                data-parent="#accordion-{{ $faq_master->id }}">
                                                <div class="card-body">
                                                    {{ $faq_list->answer }}
                                                </div>
                                            </div>
                                        </div>
                                        @php $faqIndex++; @endphp
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
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
                    <h2 class="text-white mb-4">Still Have Questions?</h2>
                    <p class="text-white mb-md-4 pb-md-2">We’re here to help. Reach out to our team anytime via the contact
                        us page.</p>
                    <a class="btn btn-light effect btn-md mb-3 mb-md-0" href="{{ url('contact-us') }}">Contact Us</a>
                </div>
            </div>
        </div>
    </section>
    <!-- product cta ends -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.faq-tabs .nav-link').forEach(function(tab) {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Remove active from all tabs
                    document.querySelectorAll('.faq-tabs .nav-link').forEach(function(t) {
                        t.classList.remove('active');
                    });
                    // Hide all sections
                    document.querySelectorAll('.faq-section').forEach(function(sec) {
                        sec.classList.add('d-none');
                    });
                    // Activate clicked tab
                    this.classList.add('active');
                    // Show corresponding section
                    var cat = this.getAttribute('data-category');
                    document.querySelector('.faq-section[data-category="' + cat + '"]').classList
                        .remove('d-none');
                });
            });
        });
    </script>
@endsection
