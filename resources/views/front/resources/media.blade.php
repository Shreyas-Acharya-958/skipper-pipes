@extends('front.layouts.app')

@section('content')
    <!-- Hero banner-section -->
    <section class="hero-banner2">
        <div class="hero-banner2-bg">
            <img src="{{ asset('assets/img/final/blogs-banner-final1.jpg') }}" alt="">
        </div>
        <div class="hero-banner2-overlay"></div>
        <div class="hero-banner2-content">
            <h1>Media</h1>
        </div>
    </section>

    <section class="hero-banner2-responsive">
        <div class="hero-banner2-content-responsive">
            <h1>Media</h1>
        </div>
        <div class="hero-banner2-img-responsive">
            <img src="{{ asset('assets/img/final/blogs-banner1.jpg') }}" alt="">
        </div>
    </section>
    <!-- Hero banner-section ends -->

    <!-- Breadcrumb  -->
    <div class="breadcrumb-area bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                    <ul class="breadcrumb">
                        <li><a href="index.html"><i class="fas fa-home"></i> Home</a></li>
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
                        <h2>Lorem ipsum dolor sit amet.</h2>
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

                                @foreach ($media['company'] as $item)
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
                                <div class="col-lg-4 col-md-6 py-2 px-2">
                                    <iframe width="100%" height="250px"
                                        src="https://www.youtube.com/embed/oFOts2eD0hY?si=tLX4RvjhbuV8-lat"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                                <div class="col-lg-4 col-md-6 py-2 px-2">
                                    <iframe width="100%" height="250px"
                                        src="https://www.youtube.com/embed/6jKAHTfDsAc?si=qKTwY3m3q5iqsnVY"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>

                            </div>
                        </div>

                        <!-- Awards -->
                        <div class="media-section d-none" data-category="awards">
                            <!-- <h3 class="faq-col-title">General Questions Faqs</h3> -->
                            <div class="row">

                                <div class="col-lg-3 col-md-6 py-2 px-lg-2 px-md-3">
                                    <div class="awards-col">
                                        <div class="awards-img">
                                            <img src="assets/img/final2/CBIP-award.png" alt="">
                                        </div>
                                        <div class="awards-title mt-3">CBIP Award 2015</div>
                                        <a href="assets/img/final2/CBIP-award.pdf" class="btn btn-dark theme theme2 mt-4"
                                            target="_blank">View</a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 py-2 px-lg-2 px-md-3">
                                    <div class="awards-col">
                                        <div class="awards-img">
                                            <img src="assets/img/final2/emerging-brand-2016.png" alt="">
                                        </div>
                                        <div class="awards-title mt-3">Emerging Brand of 2016</div>
                                        <a href="assets/img/final2/emerging-brand-2016.pdf"
                                            class="btn btn-dark theme theme2 mt-4" target="_blank">View</a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 py-2 px-lg-2 px-md-3">
                                    <div class="awards-col">
                                        <div class="awards-img">
                                            <img src="assets/img/final2/global-marketing-excellence.jpg" alt="">
                                        </div>
                                        <div class="awards-title mt-3">Global Marketing Excellence award for “Innovation in
                                            Marketing, OOH"</div>
                                        <a href="assets/img/final2/global-marketing-excellence.pdf"
                                            class="btn btn-dark theme theme2 mt-4" target="_blank">View</a>
                                    </div>
                                </div>



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
                    <a class="btn btn-light effect btn-md mb-3 mb-md-0" href="become-dealer.html">Become Dealer</a>
                    <a class="btn btn-light effect btn-md ml-md-3" href="become-distributor.html">Become Distributor</a>
                </div>
            </div>
        </div>
    </section>
    <!-- product cta ends -->
@endsection
