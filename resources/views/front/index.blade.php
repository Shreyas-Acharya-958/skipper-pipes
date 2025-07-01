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
                        @if ($sectionOne && $sectionOne->image)
                            <img src="{{ asset('storage/' . $sectionOne->image) }}" alt="Why Skipper Pipes">
                        @else
                            <img src="assets/img/final/home-about.jpg" alt="Why Skipper Pipes">
                        @endif
                    </div>
                </div>
                <div class="home-about col-lg-6 offset-lg-1">
                    <div class="site-heading">
                        <h4>Why Skipper Pipes</h4>
                        <h2>{{ $sectionOne->title ?? '' }}</h2>
                    </div>

                    <blockquote>
                        {{ $sectionOne->description ?? '' }}
                    </blockquote>

                    <ul>
                        @if ($sectionOne && $sectionOne->features->count() > 0)
                            @foreach ($sectionOne->features as $feature)
                                <li class="about-li">
                                    <div class="icon">
                                        @if ($feature->icon)
                                            <img src="{{ asset('storage/' . $feature->icon) }}" alt="{{ $feature->title }}">
                                        @else
                                            <img src="{{ asset('storage/' . $feature->image) }}"
                                                alt="{{ $feature->title }}">
                                        @endif
                                    </div>
                                    <div class="content">
                                        <h5>{{ $feature->title }}</h5>
                                    </div>
                                </li>
                            @endforeach
                        @else
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
                                    <h5>Pan India Presence</h5>
                                </div>
                            </li>
                            <li class="about-li">
                                <div class="icon">
                                    <img src="assets/img/energy/eco-house.png" alt="Icon">
                                </div>
                                <div class="content">
                                    <h5>Wide Range of Products</h5>
                                </div>
                            </li>
                            <li class="about-li">
                                <div class="icon">
                                    <img src="assets/img/energy/eco-house.png" alt="Icon">
                                </div>
                                <div class="content">
                                    <h5>Best Quality Products</h5>
                                </div>
                            </li>
                        @endif
                    </ul>
                    <a class="btn btn-dark theme theme2 btn-md mt-5" href="{{ url('contact-us') }}">Know More</a>
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
                    @foreach ($categories as $category)
                        <div class="col-lg-4 col-md-6 product-category-col">
                            <div class="thumb" style="background: url({{ asset('storage/' . $category->image) }});"></div>
                            <i class="{{ $category->icon ?? 'flaticon-bridge' }}"></i>
                            <h4>{{ $category->name }}</h4>
                            <p>
                                {{ $category->description }}
                            </p>
                            <ul>
                                @foreach ($category->products->where('status', 1) as $product)
                                    <li>{{ $product->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
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
                                @foreach ($categories as $category)
                                    <li data-tab="#{{ Str::slug($category->name) }}"
                                        class="tab-btn {{ $loop->first ? 'active-btn' : '' }}">
                                        <p>{{ $category->name }}</p>
                                        <span>{{ $category->products->where('status', 1)->count() }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="home-products__right">
                            <div class="tabs-content">
                                @foreach ($categories as $category)
                                    <div class="tab {{ $loop->first ? 'active-tab' : '' }}"
                                        id="{{ Str::slug($category->name) }}">
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
                                                @foreach ($category->products->where('status', 1) as $product)
                                                    <div class="item">
                                                        <div class="home-products__single">
                                                            <div class="home-products__img-box">
                                                                <div class="home-products__img">
                                                                    @if ($product->page_image)
                                                                        <img src="{{ asset('storage/' . $product->page_image) }}"
                                                                            alt="{{ $product->title }}">
                                                                    @else
                                                                        <img src="{{ asset('assets/img/final/project1.jpg') }}"
                                                                            alt="{{ $product->title }}">
                                                                    @endif
                                                                </div>
                                                                <div class="home-products__content-box">
                                                                    <p class="home-products__sub-title">
                                                                        {{ $category->name }}</p>
                                                                    <h4 class="home-products__title">
                                                                        <a
                                                                            href="{{ route('front.products.show', $product->slug) }}">{{ $product->title }}</a>
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

    <!-- Section 2: Empowering Every Plumber -->
    @if ($sectionTwo && $sectionTwo->title)
        <div class="sathi-community-area shape-less overflow-hidden relative">
            <div class="container">
                <div class="inner-items">
                    <div class="row">
                        <div class="col-lg-6 text-light left-info">
                            {!! $sectionTwo->description !!}
                        </div>
                        <div class="col-lg-6 right-info"
                            style="background-image: url(assets/img/final/skipper-sathi.jpg);">
                            <h2> {{ $sectionTwo->image_title }} </h2>

                            <a class="btn btn-light effect btn-md" href="{{ $sectionTwo->link }}">
                                {{ $sectionTwo->image_button }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Skipper Sathi Community ends-->





    <!-- Section 4: Reviews -->
    @if ($sectionFour && $sectionFour->title && $sectionFour->reviews->count() > 0)
        <div class="testimonial-section default-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="site-heading text-center">
                            <h4>Testimonials</h4>
                            <h2>{{ $sectionFour->title }}</h2>
                            @if ($sectionFour->description)
                                <p>{{ $sectionFour->description }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="testimonial-carousel">
                            @foreach ($sectionFour->reviews as $review)
                                <div class="testimonial-item">
                                    <div class="testimonial-content">
                                        @if ($review->star)
                                            <div class="rating">
                                                @for ($i = 0; $i < $review->star; $i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            </div>
                                        @endif
                                        @if ($review->description)
                                            <p>{{ $review->description }}</p>
                                        @endif
                                        <div class="author-info">
                                            @if ($review->person_image)
                                                <img src="{{ asset('storage/' . $review->person_image) }}"
                                                    alt="{{ $review->person_name }}">
                                            @endif
                                            <h5>{{ $review->person_name }}</h5>
                                            <span>{{ $review->person_role }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Section 3: Video Section -->
    @if ($sectionThree && $sectionThree->title)
        <section class="trusted-one">
            <div class="trusted-one__bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%"
                style="background-image: url(assets/img/final/video-bg.jpg);">
            </div>
            <div class="container">
                <div class="trusted-one__inner">
                    <div class="trusted-one__video-link">
                        <a href="{{ $sectionThree->video_link }}" class="video-popup">
                            <div class="trusted-one__video-icon">
                                <span class="fa fa-play"></span>
                                <i class="ripple"></i>
                            </div>
                        </a>
                    </div>
                    <h3 class="trusted-one__title count-box">{{ $sectionThree->title }}</h3>
                </div>
            </div>
        </section>
    @endif
    <!-- Section 3: Video Section -->

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
                    @foreach ($blogs as $blog)
                        <!-- Single Item -->
                        <div class="col-lg-4 col-md-6 single-item">
                            <div class="item">
                                <div class="thumb">
                                    <a href="{{ route('front.blogs.show', $blog->slug) }}">
                                        @if ($blog->page_image)
                                            <img src="{{ asset('storage/' . $blog->image_1) }}"
                                                alt="{{ $blog->title }}">
                                        @else
                                            <img src="{{ asset('assets/img/final/blog1.jpeg') }}"
                                                alt="{{ $blog->title }}">
                                        @endif
                                    </a>
                                </div>
                                <div class="info">
                                    <div class="meta">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <span>{{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('d F, Y') : \Carbon\Carbon::parse($blog->created_at)->format('d F, Y') }}</span>
                                                </a>
                                            </li>
                                            @if ($blog->category)
                                                <li>
                                                    <a href="#">
                                                        <i class="fas fa-folder"></i>
                                                        <span>{{ $blog->category->name }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="content">
                                        <h4>
                                            <a
                                                href="{{ route('front.blogs.show', $blog->slug) }}">{{ $blog->title }}</a>
                                        </h4>
                                        <p>
                                            {{ Str::limit($blog->short_description, 150) }}
                                        </p>
                                        <a class="more-btn" href="{{ route('front.blogs.show', $blog->slug) }}">Read More
                                            <i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Section ends -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Tab switching functionality
            $('.tab-btn').on('click', function() {
                var tab = $(this).data('tab');

                // Remove active classes
                $('.tab-btn').removeClass('active-btn');
                $('.tab').removeClass('active-tab');

                // Add active classes
                $(this).addClass('active-btn');
                $(tab).addClass('active-tab');

                // Reinitialize carousel for the active tab
                $(tab).find('.owl-carousel').trigger('destroy.owl.carousel').owlCarousel(
                    JSON.parse($(tab).find('.owl-carousel').attr('data-owl-options').replace(/'/g, '"'))
                );
            });

            // Initialize first tab's carousel
            $('.tab.active-tab .owl-carousel').owlCarousel(
                JSON.parse($('.tab.active-tab .owl-carousel').attr('data-owl-options').replace(/'/g, '"'))
            );
        });
    </script>
@endsection
