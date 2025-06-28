@extends('front.layouts.app')

@section('title', 'Skipper Pipes - Home')

@section('content')
    <!-- Hero section - hero banner -->
    <div class="carousel-wrapper position-relative">
        <!-- Black Overlay -->
        <div class="carousel-overlay"></div>

        <!-- Your Carousel -->
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-interval="3000">
                        <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="{{ $banner->title }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleFade" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleFade" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </button>
        </div>
    </div>
    <!-- Hero section ends- hero banner -->

    <!-- About section -->
    <div class="home-about-area default-padding">
        <div class="container">
            <div class="row align-center">
                <div class="home-about col-lg-5">
                    <div class="thumb">
                        <img src="assets/img/final/home-about.jpg" alt="Thumb">
                    </div>
                </div>
                <div class="home-about col-lg-6 offset-lg-1">
                    <div class="site-heading">
                        <h4>Why Skipper Pipes</h4>
                        <h2>Engineered for Safety</h2>
                    </div>

                    <blockquote>
                        From product innovation to nationwide support, Skipper Pipes ensures long-term performance, safety,
                        and ease of installation, making it the preferred choice for engineers, architects, and plumbing
                        professionals alike.
                    </blockquote>
                    <!-- <p>
                                                        From product innovation to nationwide support, Skipper Pipes ensures long-term performance, safety, and ease of installation, making it the preferred choice for engineers, architects, and plumbing professionals alike.
                                                    </p> -->
                    <ul>
                        <li class="about-li">
                            <div class="icon">
                                <img src="assets/img/energy/cashback.png" alt="Icon">
                            </div>
                            <div class="content">
                                <h5>16+ Years of Industry Expertise</h5>
                            </div>
                        </li>
                        <li class="about-li">
                            <div class="icon">
                                <img src="assets/img/energy/eco-house.png" alt="Icon">
                            </div>
                            <div class="content">
                                <h5> 5 State-of-the-Art Manufacturing Units</h5>
                            </div>
                        </li>
                        <li class="about-li">
                            <div class="icon">
                                <img src="assets/img/energy/eco-house.png" alt="Icon">
                            </div>
                            <div class="content">
                                <h5>25,000+ Dealers & Distributors</h5>
                            </div>
                        </li>
                        <li class="about-li">
                            <div class="icon">
                                <img src="assets/img/energy/eco-house.png" alt="Icon">
                            </div>
                            <div class="content">
                                <h5>1700+ <br> SKUs</h5>
                            </div>
                        </li>
                    </ul>
                    <a class="btn btn-dark theme theme2 btn-md mt-5">Know More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About section ends-->

    <!-- product category section -->
    <div class="home-product-category default-padding">
        <div class="container">
            <div class="product-category-sec">
                <div class="row headings">
                    <div class="site-heading text-center">
                        <h4>Product Category</h4>
                        <h2>Explore Solutions for Every Need</h2>
                        <p>
                            Skipper's product range is built to meet real-world demands, whether it's daily household use or
                            high-pressure applications in challenging field and infrastructure conditions.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 product-category-col">
                        <div class="thumb" style="background: url(assets/img/final/plumbing-and-sewage.jpeg);"></div>
                        <i class="flaticon-bridge"></i>
                        <h4>Plumbing & Sewage</h4>
                        <p>
                            Designed for safe, leak-free flow—ideal for modern plumbing and efficient wastewater management
                            systems.
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 product-category-col">
                        <div class="thumb" style="background: url(assets/img/final/agriculture-pipes.jpeg);"></div>
                        <i class="flaticon-engineer-3"></i>
                        <h4>Agriculture Pipes</h4>
                        <p>
                            Reliable performance for modern farming needs; durable, weather-resistant, and easy to install
                            and maintain.

                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 product-category-col">
                        <div class="thumb" style="background: url(assets/img/final/borewell.jpeg);"></div>
                        <i class="flaticon-machinery"></i>
                        <h4>Borewell Pipes</h4>
                        <p>
                            Built for deep water extraction, our borewell range ensures strength, efficiency, and
                            long-lasting performance underground.
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 product-category-col">
                        <div class="thumb" style="background: url(assets/img/final/HDPE-pipes.jpeg);"></div>
                        <i class="flaticon-bridge"></i>
                        <h4>HDPE Pipes</h4>
                        <p>
                            High-strength, corrosion-resistant pipes designed for leak-free flow in agriculture, drainage,
                            and infrastructure systems.
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 product-category-col">
                        <div class="thumb" style="background: url(assets/img/final/Marina\ Tank.jpeg);"></div>
                        <i class="flaticon-house"></i>
                        <h4>Marina Tanks</h4>
                        <p>
                            UV-stabilized, multilayer storage tank designed for safe, hygienic, and long-lasting water
                            storage.
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 product-category-col">
                        <div class="thumb" style="background: url(assets/img/final/bath-fittings.jpeg);"></div>
                        <i class="flaticon-ruler"></i>
                        <h4>Bath Fittings</h4>
                        <p>
                            Contemporary bath fittings designed for elegance, long-lasting performance, and effortless daily
                            functionality.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product category section ends-->

    <!-- our products section -->
    <section class="home-products">
        <div class="container">
            <div class="site-heading text-center">
                <h4>Our Products</h4>
                <h2>Pipes Built for Every Purpose</h2>
                <p>
                    Crafted with precision and backed by innovation, our products meet every purpose with unmatched strength
                    and field-tested performance, trusted by professionals across India.
                </p>
            </div>
            <div class="home-products__main-tab-box tabs-box">
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="home-products__left">
                            <ul class="tab-buttons clearfix list-unstyled">

                                @foreach ($categories as $index => $category)
                                    <li data-tab="#category-{{ $category->id }}"
                                        class="tab-btn {{ $index === 0 ? 'active-btn' : '' }}">
                                        <p>{{ $category->name }}</p>
                                        <span>{{ $category->products->count() }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="home-products__right">
                            <div class="tabs-content">
                                @foreach ($categories as $index => $category)
                                    <div class="tab {{ $index === 0 ? 'active-tab' : '' }}"
                                        id="category-{{ $category->id }}">
                                        <div class="home-products__main-tab-content">
                                            <div class="home-products__carousel thm-owl__carousel owl-theme owl-carousel"
                                                data-owl-options='{
                                                "items": 1,
                                                "margin": 30,
                                                "smartSpeed": 700,
                                                "loop":true,
                                                "autoplay": 6000,
                                                "nav":false,
                                                "dots":true,
                                                "navText": ["<span class=\"fa fa-angle-left\"></span>","<span class=\"fa fa-angle-right\"></span>"],
                                                "responsive":{
                                                    "0":{
                                                        "items":1
                                                    },
                                                    "768":{
                                                        "items":2
                                                    },
                                                    "992":{
                                                        "items": 2
                                                    },
                                                    "1200":{
                                                        "items": 2
                                                    }
                                                }
                                            }'>
                                                @foreach ($category->products as $product)
                                                    <div class="item">
                                                        <div class="home-products__single">
                                                            <div class="home-products__img-box">
                                                                <div class="home-products__img">
                                                                    @if ($product->image)
                                                                        <img src="{{ asset('storage/' . $product->image) }}"
                                                                            alt="{{ $product->name }}">
                                                                    @else
                                                                        <img src="{{ asset('assets/img/final/project1.jpg') }}"
                                                                            alt="{{ $product->name }}">
                                                                    @endif
                                                                </div>
                                                                <div class="home-products__content-box">
                                                                    <p class="home-products__sub-title">
                                                                        {{ $category->name }}</p>
                                                                    <h4 class="home-products__title">
                                                                        <a
                                                                            href="{{ route('front.products.show', $product->id) }}">{{ $product->name }}</a>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- our products section ends -->

    <!-- Skipper Sathi Community -->
    <div class="sathi-community-area shape-less overflow-hidden relative">
        <div class="container">
            <div class="inner-items">
                <div class="row">
                    <div class="col-lg-6 text-light left-info">
                        <div class="item">
                            <!-- <h4>Skipper Sathi Community</h4> -->
                            <img src="assets/img/final/Skipper-Sathi-logo-1.jpg" class="w-25 pb-3"
                                alt="skipper-sathi-logo">
                            <h2 class="mb-4">Empowering Every Plumber</h2>
                            <p class="mb-3">Skipper Saathi is more than a loyalty program — it's a nationwide movement by
                                Skipper Pipes, India's Safest Pipes, to build a thriving community of plumbers,
                                distributors, and retailers from every corner of the country.</p>
                            <p class="mb-3">Whether you're on-site, in-store, or on the move, Skipper Saathi keeps you
                                connected to the latest in the piping world — from product innovations and plumbing
                                technologies to installation hacks, best practices, and exclusive training modules.</p>
                            <p>Top-performing plumbers will be featured and rewarded for their dedication, skill, and
                                contribution to the Skipper family — because we believe in celebrating real heroes.</p>
                        </div>

                        <ul class="achivement">
                            <li>
                                <div class="fun-fact">
                                    <div class="counter">
                                        <div class="timer" data-to="11000" data-speed="1500">11000</div>
                                        <div class="operator">+</div>
                                    </div>
                                    <span class="medium">Plumbers Trained</span>
                                </div>
                            </li>
                            <li>
                                <div class="fun-fact">
                                    <div class="counter">
                                        <div class="timer" data-to="100000" data-speed="1500">100,000</div>
                                        <div class="operator">+</div>
                                    </div>
                                    <span class="medium">Plumbers Trust</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 right-info" style="background-image: url(assets/img/final/skipper-sathi.jpg);">
                        <h2>Join India's Fastest-Growing Plumber Network!</h2>
                        <!-- <p>
                                                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vero, blanditiis.
                                                        </p> -->
                        <a class="btn btn-light effect btn-md" href="#">Connect with Skipper</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Skipper Sathi Community ends-->

    <!-- Testimonials Section  -->
    <div class="testimonials-area bg-gray default-padding">
        <div class="container">
            <div class="testimonial-items">
                <div class="row align-center">
                    <div class="col-lg-5 title text-center">
                        <!-- <h1 style="background-image: url(assets/img/final/skipper-pipes-s-logo.png);">S</h1> -->
                        <img src="assets/img/final/skipper-pipes-s-logo2.png" class="w-50 mb-4" alt="">
                        <!-- <h1 style="background-image: url(assets/img/final/testimonials-number-bg.jpg);">85</h1> -->
                        <div class="site-heading text-center">
                            <!-- <h4>Our Feedbacks</h4> -->
                            <h2>Their words reflect the strength we deliver.</h2>
                        </div>
                    </div>
                    <div class="col-lg-7 testimonial-box">
                        <div class="testimonial-content testimonials-carousel owl-carousel owl-theme">
                            <!-- Single Item -->
                            <div class="item">
                                <div class="content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <p>
                                        For skipper I can proudly say that Skipper is best in service. We have unique
                                        loyalty program for retailers and plumbers. This uniqueness make us different from
                                        others.
                                    </p>
                                </div>
                                <div class="provider">
                                    <div class="thumb">
                                        <img src="assets/img/final/testimonial1.png" alt="Thumb">
                                    </div>
                                    <div class="info">
                                        <h5>Mr. Varun Bansal</h5>
                                        <span>Distributor</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Item -->
                            <!-- Single Item -->
                            <div class="item">
                                <div class="content">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <p>
                                        Plumber is the key of this industry. And with the help of Skipper, we have conducted
                                        many mega meet and small meets. That help me to build my foundation.
                                    </p>
                                </div>
                                <div class="provider">
                                    <div class="thumb">
                                        <img src="assets/img/final/testimonial2.jpg" alt="Thumb">
                                    </div>
                                    <div class="info">
                                        <h5>Mr. Ripan Sikder</h5>
                                        <span>Retailer</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Item -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonials Section ends -->

    <!--Trusted One Start-->
    <section class="trusted-one">
        <div class="trusted-one__bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%"
            style="background-image: url(assets/img/final/video-bg.jpg);">
        </div>
        <div class="container">
            <div class="trusted-one__inner">
                <div class="trusted-one__video-link">
                    <a href="https://www.youtube.com/watch?v=Get7rqXYrbQ" class="video-popup">
                        <div class="trusted-one__video-icon">
                            <span class="fa fa-play"></span>
                            <i class="ripple"></i>
                        </div>
                    </a>
                </div>
                <h3 class="trusted-one__title count-box">India's Safest Pipes Manufacturer</h3>
            </div>
        </div>
    </section>
    <!--Trusted One End-->

    <!-- Blog Section  -->
    <div class="blog-area home-blog date-less default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="site-heading text-center">
                        <h4>Blogs</h4>
                        <h2>Build Better with Expert Advice</h2>
                        <p>
                            Stay updated with industry insights, product tips, and smart installation practices from experts
                            who know what truly works on-site and beyond.
                        </p>
                    </div>
                </div>
            </div>
            <div class="blog-items">
                <div class="row">
                    <!-- Single Item -->
                    <div class="col-lg-4 col-md-6 single-item">
                        <div class="item">
                            <div class="thumb">
                                <a href="blogs-single.html"><img src="assets/img/final/blog1.jpeg" alt="Thumb">
                                </a>
                            </div>
                            <div class="info">
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span>14 June, 2025</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="content">
                                    <h4>
                                        <a href="blogs-single.html">The Environmental Impact of Piping Materials:
                                            Sustainable Choices for Green Building Projects</a>
                                    </h4>
                                    <p>
                                        In the present construction industry, sustainability is considered to be crucial.
                                        Engineers, architects and builders are largely focusing on eco-friendly…
                                    </p>
                                    <a class="more-btn" href="blogs-single.html">Read More <i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="col-lg-4 col-md-6 single-item">
                        <div class="item">
                            <div class="thumb">
                                <a href="blogs-single.html"><img src="assets/img/final/blog2.jpeg" alt="Thumb">
                                </a>
                            </div>
                            <div class="info">
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span>14 May, 2025</span>
                                            </a>
                                        </li>
                                        <!-- <li>
                                                                            <a href="#">
                                                                                <i class="fas fa-comments"></i>
                                                                                <span>08 Comments</span>
                                                                            </a>
                                                                        </li> -->
                                    </ul>
                                </div>
                                <div class="content">
                                    <h4>
                                        <a href="blogs-single.html">Reasons Why Industry Experts Choose Skipper Pipes for
                                            Large-Scale Projects</a>
                                    </h4>
                                    <p>
                                        Introduction Major real estate and infrastructure projects rely on the quality and
                                        endurance of critical components, such as pipe networks.…
                                    </p>
                                    <a class="more-btn" href="blogs-single.html">Read More <i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                    <!-- Single Item -->
                    <div class="col-lg-4 col-md-6 single-item">
                        <div class="item">
                            <div class="thumb">
                                <a href="blogs-single.html"><img src="assets/img/final/blog3.jpeg" alt="Thumb">
                                </a>
                            </div>
                            <div class="info">
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span>24 April, 2025</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="content">
                                    <h4>
                                        <a href="blogs-single.html">Innovation & Quality: The Award-Winning Journey of
                                            Skipper <br> Pipes</a>
                                    </h4>
                                    <p>
                                        Today, in the modern age, the evolution of the plumbing pipes is something which is
                                        very fascinating to know. The advancement of technologies and ..
                                    </p>
                                    <a class="more-btn" href="blogs-single.html">Read More <i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Section ends -->
@endsection
