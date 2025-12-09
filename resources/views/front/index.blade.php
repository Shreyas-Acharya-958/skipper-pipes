@extends('front.layouts.app')

@section('title', 'Skipper Pipes - Home')

@section('styles')
    <style>
        /* Jal Rakshak Popup Styles */
        .jal-rakshak-btn-secondary {
            padding: 12px 30px;
            background-color: #144372;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 0;
        }

        .jal-rakshak-btn-secondary:hover {
            background-color: #FFA800;
            color: #144372;
        }

        .lp-para-heading {
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        /* popup */
        /* Wrapper */
        #scrollPopup .popup-form-wrapper {
            position: relative;
            overflow: hidden;
        }

        /* Close Button */
        #scrollPopup .popup-close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 28px;
            color: #144372;
            opacity: 0.8;
            z-index: 10;
        }

        #scrollPopup .popup-close:hover {
            opacity: 1;
        }

        /* Image Side */
        #scrollPopup .popup-img img {
            height: 100%;
            object-fit: cover;
        }

        /* Form Side */
        #scrollPopup .popup-form {
            background: #fff;
        }

        /* Popup CTA Link */
        .popup-cta-link,
        .popup-cta-link:hover {
            color: #144372;
            text-decoration: underline;
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    <!-- Hero section - hero banner -->
    <div class="carousel-wrapper hero-desktop-banner position-relative">
        <!-- Black Overlay -->
        <div class="carousel-overlay"></div>

        <!-- Your Carousel -->
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-interval="3000">
                        <img src="{{ asset('storage/' . $banner->image) }}" class="d-block w-100" alt="{{ image_alt_text('storage/' . $banner->image, $banner->title) }}">
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


    <!-- Hero section - hero banner  DYNAMIC PENDINGS-->
    <div class="carousel-wrapper homepage-mobile-banner position-relative">
        <!-- Black Overlay -->
        <div class="carousel-overlay"></div>

        <!-- Your Carousel -->
        <div id="carouselExampleFade1" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-interval="3000">
                        <img src="{{ asset('storage/' . $banner->mobile_image) }}" class="d-block w-100"
                            alt="{{ image_alt_text('storage/' . $banner->mobile_image, $banner->title) }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleFade1" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleFade1" data-slide="next">
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
                <div class="home-about col-lg-5" data-aos="fade-up" data-aos-duration="1000">
                    <div class="thumb">
                        @if ($sectionOne->image)
                            <img src="{{ asset('storage/' . $sectionOne->image) }}" alt="{{ image_alt_text('storage/' . $sectionOne->image, 'Why Skipper Pipes') }}">
                        @elseif ($sectionOne->video)
                            <video class="w-100" src="{{ asset('storage/' . $sectionOne->video) }}" alt="Why Skipper Pipes"
                                loop autoplay muted></video>
                        @else
                            <img src="assets/img/final/home-about.jpg" alt="{{ image_alt_text('assets/img/final/home-about.jpg', 'Why Skipper Pipes') }}">
                        @endif
                    </div>
                </div>
                <div class="home-about col-lg-6 offset-lg-1">
                    <div class="site-heading" data-aos="fade-up" data-aos-duration="1000">
                        <h4>Why Skipper Pipes</h4>
                        <h2>{{ $sectionOne->title ?? '' }}</h2>
                    </div>

                    <blockquote data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        {!! $sectionOne->description ?? '' !!}
                    </blockquote>

                    <ul data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        @if ($sectionOne && $sectionOne->features->count() > 0)
                            @foreach ($sectionOne->features as $feature)
                                <li class="about-li">
                                    <div class="icon">
                                        @if ($feature->icon)
                                            <img src="{{ asset('storage/' . $feature->icon) }}"
                                                alt="{{ image_alt_text('storage/' . $feature->icon, $feature->title) }}">
                                        @else
                                            <img src="{{ asset('storage/' . $feature->image) }}"
                                                alt="{{ image_alt_text('storage/' . $feature->image, $feature->title) }}">
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
                                    <img src="assets/img/energy/cashback.png" alt="{{ image_alt_text('assets/img/energy/cashback.png', 'Icon') }}">
                                </div>
                                <div class="content">
                                    <h5>16+ Years of Industry Expertise</h5>
                                </div>
                            </li>
                            <li class="about-li">
                                <div class="icon">
                                    <img src="assets/img/energy/eco-house.png" alt="{{ image_alt_text('assets/img/energy/eco-house.png', 'Icon') }}">
                                </div>
                                <div class="content">
                                    <h5>Pan India Presence</h5>
                                </div>
                            </li>
                            <li class="about-li">
                                <div class="icon">
                                    <img src="assets/img/energy/eco-house.png" alt="{{ image_alt_text('assets/img/energy/eco-house.png', 'Icon') }}">
                                </div>
                                <div class="content">
                                    <h5>Wide Range of Products</h5>
                                </div>
                            </li>
                            <li class="about-li">
                                <div class="icon">
                                    <img src="assets/img/energy/eco-house.png" alt="{{ image_alt_text('assets/img/energy/eco-house.png', 'Icon') }}">
                                </div>
                                <div class="content">
                                    <h5>Best Quality Products</h5>
                                </div>
                            </li>
                        @endif
                    </ul>
                    @if ($sectionOne->now_more)
                        <a class="btn btn-dark theme theme2 btn-md mt-5" href="{{ $sectionOne->now_more }}"
                            data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">Know More</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- About section ends-->

    <!-- product category section -->
    <div class="home-product-category default-padding">
        <div class="container">
            <div class="product-category-sec">
                <div class="row headings px-3 px-md-0" data-aos="fade-up" data-aos-duration="1000">
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
                        <div class="col-lg-4 col-md-6 product-category-col" data-aos="fade-up" data-aos-duration="1000"
                            data-aos-delay="100">
                            <div class="thumb" style="background: url({{ asset('storage/' . $category->image) }});">
                            </div>
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ image_alt_text('storage/' . $category->icon, $category->name) }}">
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
            <div class="site-heading text-center" data-aos="fade-up" data-aos-duration="1000">
                <h4>Our Products</h4>
                <h2>Pipes Built for Every Purpose</h2>
                <p>
                    Crafted with precision and backed by innovation, our products meet every purpose with unmatched strength
                    and field-tested performance, trusted by professionals across India.
                </p>
            </div>
            <div class="home-products__main-tab-box tabs-box" data-aos="fade-up" data-aos-duration="1000"
                data-aos-delay="100">
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
                                            <div class="home-products__carousel thm-owl__carousel owl-theme owl-carousel">
                                                @foreach ($category->products->where('status', 1) as $product)
                                                    <div class="item">
                                                        <div class="home-products__single">
                                                            <div class="home-products__img-box">
                                                                <div class="home-products__img">
                                                                    @if ($product->home_image)
                                                                        <img src="{{ asset('storage/' . $product->home_image) }}"
                                                                            alt="{{ image_alt_text('storage/' . $product->home_image, $product->title) }}">
                                                                    @else
                                                                        <img src="{{ asset('assets/img/final/project1.jpg') }}"
                                                                            alt="{{ image_alt_text('assets/img/final/project1.jpg', $product->title) }}">
                                                                    @endif
                                                                </div>
                                                                <div class="home-products__content-box">
                                                                    <p class="home-products__sub-title">
                                                                        {{ $category->name }}</p>
                                                                    <h4 class="home-products__title">
                                                                        @if ($product->slug == 'bath-fittings')
                                                                            <a
                                                                                href="https://skipperbathfittings.com/beta/">{{ $product->title }}</a>
                                                                        @else
                                                                            <a
                                                                                href="{{ route('front.products.show', $product->slug) }}">{{ $product->title }}</a>
                                                                        @endif
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
                            style="background-image: url({{ asset('storage/' . $sectionTwo->image) }});">
                            <h2 data-aos="fade-up" data-aos-duration="1000"> {{ $sectionTwo->image_title }} </h2>

                            <a class="btn btn-light effect btn-md" href="{{ $sectionTwo->link }}" data-aos="fade-up"
                                data-aos-duration="1000" data-aos-delay="200">
                                {{ $sectionTwo->image_button }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Skipper Sathi Community ends-->


    <!-- Testimonials Section  -->
    @if ($sectionFour && $sectionFour->title && $sectionFour->reviews->count() > 0)
        <div class="testimonials-area bg-gray default-padding">
            <div class="container">
                <div class="site-heading text-center" data-aos="fade-up" data-aos-duration="1000">

                    <h2>Skipper Samvaad</h2>

                </div>
                <div class="testimonial-items">
                    <div class="row align-center">
                        <div class="col-lg-5 title text-center" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-delay="100">
                            <!-- <h1 style="background-image: url(assets/img/final/skipper-pipes-s-logo.png);">S</h1> -->
                            <img src="{{ asset('storage/' . $sectionFour->image) }}" class="w-50 mb-4" alt="{{ image_alt_text('storage/' . $sectionFour->image, '') }}">
                            <!-- <h1 style="background-image: url(assets/img/final/testimonials-number-bg.jpg);">85</h1> -->
                            <div class="site-heading text-center">
                                <!-- <h4>Our Feedbacks</h4> -->
                                <h2>{{ $sectionFour->title }}</h2>
                            </div>
                        </div>
                        <div class="col-lg-7 testimonial-box" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-delay="100">
                            <div class="testimonial-content testimonials-carousel owl-carousel owl-theme">
                                @foreach ($sectionFour->reviews as $review)
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
                                                {{ $review->description }}
                                            </p>
                                        </div>
                                        <div class="provider">
                                            <div class="thumb">
                                                <img src="{{ asset('storage/' . $review->person_image) ?? '/assets/img/final/testimonial1.png' }}"
                                                    alt="{{ image_alt_text('storage/' . ($review->person_image ?? ''), $review->person_name) }}">
                                            </div>
                                            <div class="info">
                                                <h5>{{ $review->person_name }}</h5>
                                                <span>{{ $review->person_role }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Single Item -->
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonials Section ends -->
    @endif


    <!-- Section 3: Video Section -->
    @if ($sectionThree && $sectionThree->title)
        <section class="trusted-one">
            <div class="trusted-one__bg jarallax" data-jarallax data-speed="0.2" data-imgPosition="50% 0%"
                style="background-image: url(assets/img/skipper-pipes-videos.png);">
            </div>
            <div class="container">
                <div class="trusted-one__inner" data-aos="fade-up" data-aos-duration="1000">
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
                    <div class="site-heading text-center" data-aos="fade-up" data-aos-duration="1000">
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
                        <div class="col-lg-4 col-md-6 single-item" data-aos="flip-right" data-aos-duration="1000"
                            data-aos-delay="100">
                            <div class="item">
                                <div class="thumb">
                                    <a href="{{ route('front.blogs.show', $blog->slug) }}">
                                        @if ($blog->page_image)
                                            <img src="{{ asset('storage/' . $blog->image_1) }}"
                                                alt="{{ image_alt_text('storage/' . $blog->image_1, $blog->title) }}">
                                        @else
                                            <img src="{{ asset('assets/img/final/blog1.jpeg') }}"
                                                alt="{{ image_alt_text('assets/img/final/blog1.jpeg', $blog->title) }}">
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
                                                        <span>{{ $blog->category->title }} </span>
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

    <!-- Jal Rakshak Popup Modal -->
    <div class="modal fade" id="scrollPopup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content popup-form-wrapper">
                <button type="button" class="close popup-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="row no-gutters">
                    <!-- Left Image -->
                    <div class="col-md-6 popup-img">
                        <img src="{{ asset('assets/img/lp/Jalraksha_PopUpForm_579x687.png') }}" class="img-fluid"
                            alt="{{ image_alt_text('assets/img/lp/Jalraksha_PopUpForm_579x687.png', 'Popup Image') }}">
                    </div>

                    <!-- Right Form -->
                    <div class="col-md-6 p-4 popup-form">
                        <h3 class="mb-3 lp-para-heading">Take A Pledge to Become a Jal Rakshak</h3>
                        <p class="mb-4">Every drop matters—and so does your pledge. Join fellow Jal Rakshaks in
                            conserving water and protecting our environment.</p>
                        <a href="https://skipperpipes.in/jal-rakshak" class="mb-3 popup-cta-link">Know more about the
                            initiative</a>

                        <form action="{{ route('front.jal-rakshak.submission') }}" method="post"
                            id="popupJalRakshakForm">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Your Name"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email"
                                    placeholder="Your Email (Optional)">
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Your Phone"
                                    required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="water_saving_commitment"
                                    placeholder="Your Water-Saving Commitment"></textarea>
                            </div>
                            <button type="submit" class="btn jal-rakshak-btn-secondary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // $(document).ready(function() {
        //     // Tab switching functionality
        //     $('.tab-btn').on('click', function() {
        //         var tab = $(this).data('tab');

        //         // Remove active classes
        //         $('.tab-btn').removeClass('active-btn');
        //         $('.tab').removeClass('active-tab');

        //         // Add active classes
        //         $(this).addClass('active-btn');
        //         $(tab).addClass('active-tab');

        //         // Reinitialize carousel for the active tab
        //         $(tab).find('.owl-carousel').trigger('destroy.owl.carousel').owlCarousel(
        //             JSON.parse($(tab).find('.owl-carousel').attr('data-owl-options').replace(/'/g, '"'))
        //         );
        //     });

        //     // Initialize first tab's carousel
        //     $('.tab.active-tab .owl-carousel').owlCarousel(
        //         JSON.parse($('.tab.active-tab .owl-carousel').attr('data-owl-options').replace(/'/g, '"'))
        //     );
        // });
    </script>

    <!-- Jal Rakshak Popup Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let popupShown = false;

            window.addEventListener("scroll", function() {
                let scrollTop = window.scrollY;
                let docHeight = document.body.scrollHeight - window.innerHeight;
                let scrolled = (scrollTop / docHeight) * 100;

                if (scrolled > 15 && !popupShown) {
                    $("#scrollPopup").modal("show");
                    popupShown = true; // prevent multiple triggers
                }
            });
        });
    </script>

    <!-- jQuery Validation and SweetAlert for Popup Form -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Popup Form Handling -->
    <script>
        $(document).ready(function() {
            // Prevent default form submission
            $('#popupJalRakshakForm').on('submit', function(e) {
                e.preventDefault();
                return false;
            });

            $('#popupJalRakshakForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    email: {
                        email: true,
                        maxlength: 255
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    water_saving_commitment: {
                        maxlength: 1000
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Name must be at least 2 characters long",
                        maxlength: "Name cannot exceed 255 characters"
                    },
                    email: {
                        email: "Please enter a valid email address",
                        maxlength: "Email cannot exceed 255 characters"
                    },
                    phone: {
                        required: "Please enter your mobile number",
                        minlength: "Mobile number must be at least 10 digits",
                        maxlength: "Mobile number cannot exceed 15 characters"
                    },
                    water_saving_commitment: {
                        maxlength: "Commitment cannot exceed 1000 characters"
                    }
                },
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                submitHandler: function(form) {
                    // Show loading state with SweetAlert
                    Swal.fire({
                        title: 'Submitting...',
                        text: 'Please wait while we process your commitment.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: "{{ route('front.jal-rakshak.submission') }}",
                        type: "POST",
                        data: $(form).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message ||
                                    'Thank you for your commitment to water conservation!',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#FFA800'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    form.reset();
                                    // Reset form validation
                                    $('#popupJalRakshakForm').validate()
                                        .resetForm();
                                    // Remove any validation classes
                                    $('#popupJalRakshakForm .form-control')
                                        .removeClass(
                                            'is-valid is-invalid');
                                    // Close the modal
                                    $('#scrollPopup').modal('hide');
                                }
                            });
                        },
                        error: function(xhr) {
                            let message = 'Something went wrong. Please check your inputs.';
                            if (xhr.responseJSON?.errors) {
                                message = Object.values(xhr.responseJSON.errors).join(' ');
                            } else if (xhr.responseJSON?.message) {
                                message = xhr.responseJSON.message;
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: message,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    });

                    return false; // Prevent form submission
                }
            });
        });
    </script>
@endsection
