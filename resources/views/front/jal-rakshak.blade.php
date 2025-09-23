<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (isset($seo) && $seo)
        <meta name="description" content="{{ $seo->meta_description }}">
        <meta name="keywords" content="{{ $seo->meta_keywords }}">
        <title>{{ $seo->meta_title ?: 'Jal Rakshak - Water Conservation Initiative' }}</title>
    @endif

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('assets/img/final/skipper-pipes-favicon.png') }}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/flaticon-set.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/swiper/swiper.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootsnav.css') }}" rel="stylesheet" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('style.css') }}?v={{ time() }}">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />
    <!-- ========== End Stylesheet ========== -->


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-V8XGVP5J7B"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-V8XGVP5J7B');
    </script>

    <style>
        /* lp-logo */
        .lp-logo a {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            text-decoration: none;
        }

        /* lp-navbar */
        .lp-navbar {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }

        .lp-nav-links {
            list-style: none;
            display: flex;
            gap: 30px;
        }

        .lp-nav-links li a {
            text-decoration: none;
            color: #333;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .lp-nav-links li a:hover {
            color: #144372;
        }

        /* Hamburger menu (hidden by default) */
        .menu-toggle {
            display: none;
            font-size: 1.8rem;
            cursor: pointer;
            margin-left: 20px;
        }

        /* hero banner */

        .lp-hero-mobile-banner {
            display: none;
        }

        .bg-primary-blue {
            background-color: #144372 !important;
        }

        html {
            scroll-behavior: smooth;
        }

        .lp-h3-heading {
            font-weight: 600;
            margin-top: 40px;
        }

        .lp-site-sub_heading {
            font-weight: 500;
            font-size: 18px;
        }

        .lp-heading {
            display: inline-block;
            font-size: 18px;
            font-weight: 600;
            color: #144372;
            /* margin-bottom: 10px; */
        }

        .lp-para-heading {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .lp-para-text {
            font-weight: 500;
            font-size: 18px;
        }

        .lp-para-text.italic {
            font-style: italic;
        }

        .lp-para-bold {
            color: #144372;
        }

        .venue-desc li {
            color: #144372;
            font-weight: 600;
        }

        .jal-rakshak-form {
            color: white !important;
        }

        .jal-rakshak-cta,
        .jal-rakshak-cta h2,
        .jal-rakshak-cta p {
            color: white !important;
        }

        .jal-rakshak-cta h2 {
            font-weight: 600;
        }

        .jal-rakshak-form .form-control {
            border-radius: 0px;
        }

        .jal-rakshak-btn {
            background-color: #FFA800;
            padding: 12px 30px;
        }

        .jal-rakshak-btn-secondary {
            padding: 12px 30px;
            background-color: #144372;
            color: white;
            font-weight: 600;
        }

        .jal-rakshak-btn-secondary:hover {
            background-color: #FFA800;
            color: #144372;
        }

        .site-heading h4.text-white {
            color: white !important;

        }


        /* Lightbox modal content */
        #lightboxModal .modal-content {
            background: transparent !important;
            border: 3px solid #144372;
            /* blue border */
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            /* subtle blue glow */
        }

        /* Lightbox modal content */
        #lightboxModal .modal-content .modal-body {
            padding: 0 !important;
            border: 5px solid #fff;

        }

        /* Image inside modal */
        #lightboxImage {
            max-height: 100%;
            width: 1500px;
            display: block;
            margin: 0 auto;
            border-radius: 6px;
        }

        /* Left/right arrows - move outside */
        #lightboxModal .lightbox-control {
            position: fixed;
            /* make them stay outside image */
            top: 50%;
            transform: translateY(-20%);
            font-size: 2rem;
            color: #144372;
            text-decoration: none;
            font-weight: bold;
            padding: 20px 25px;
            user-select: none;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50%;
            transition: all 0.3s ease;
            z-index: 1055;
            /* above modal */
        }

        #lightboxModal .lightbox-control.left {
            left: 100px;
            /* outside left */
        }

        #lightboxModal .lightbox-control.right {
            right: 100px;
            /* outside right */
        }

        #lightboxModal .lightbox-control:hover {
            background: #144372;
            color: #fff;
        }

        #footer-cta h3 {
            font-weight: 600;
            margin-bottom: 0;
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

        /* Gallery and Video View All functionality */
        .gallery-hidden,
        .video-hidden {
            display: none !important;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease-in-out;
        }

        .gallery-item-wrapper,
        .video-item-wrapper {
            transition: all 0.5s ease-in-out;
        }

        .gallery-item-wrapper.show,
        .video-item-wrapper.show {
            display: block !important;
            opacity: 1;
            transform: translateY(0);
        }



        /* Responsive */
        @media (max-width: 768px) {
            .lp-nav-links {
                display: none;
                position: absolute;
                top: 70px;
                right: 0;
                background: #fff;
                flex-direction: column;
                width: 200px;
                border-left: 1px solid #eee;
                border-bottom: 1px solid #eee;
                position: absolute;
                z-index: 999;
            }

            .lp-nav-links.active {
                display: flex;
                margin-right: 15px;
                padding: 15px 15px 15px 25px;
            }

            .lp-nav-links.active li a {
                color: #144372;
            }

            .menu-toggle {
                display: block;
            }

            #facts .order-2 {
                order: 1
            }
        }

        @media(max-width: 576px) {
            #lightboxModal .lightbox-control {
                top: 75%;
            }

            .lp-hero-mobile-banner {
                display: block;
            }

            .lp-hero-banner {
                display: none;
            }

            #facts .order-2 {
                order: 1
            }
        }
    </style>

</head>

<body>

    <header class="py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="lp-logo">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/img/skipper-logo.png') }}" width="120px"
                        alt=""></a>
            </div>

            <nav class="lp-navbar">
                <ul class="lp-nav-links">
                    @if (isset($menus) && $menus->count() > 0)
                        @foreach ($menus as $menu)
                            <li><a href="{{ $menu->url }}">{{ $menu->title }}</a></li>
                        @endforeach
                    @endif
                </ul>
                <div class="menu-toggle" id="menu-toggle">&#9776;</div>
            </nav>
        </div>
    </header>

    <!-- popup form -->
    <!-- Popup Modal -->
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
                            alt="Popup Image">
                    </div>

                    <!-- Right Form -->
                    <div class="col-md-6 p-4 popup-form">
                        <h3 class="mb-3 lp-para-heading">Take A Pledge to Become a Jal Rakshak</h3>
                        <p class="mb-4">Every drop matters—and so does your pledge. Join fellow Jal Rakshaks in
                            conserving water and protecting our environment.</p>

                        <form action="{{ route('front.jal-rakshak.submission') }}" method="post"
                            id="popupJalRakshakForm">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Your Name"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Your Email"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Your Phone"
                                    required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="water_saving_commitment" placeholder="Your Water-Saving Commitment"></textarea>
                            </div>
                            <button type="submit" class="btn jal-rakshak-btn-secondary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (isset($banners) && $banners && isset($banners->images) && count($banners->images) > 0)
        <section id="hero-banner-lp">
            <div class="container-fluid p-0">
                @foreach ($banners->images as $index => $image)
                    <img src="{{ asset('storage/' . $image) }}" class="w-100 lp-hero-banner"
                        alt="{{ $banners->title ?? 'Hero Banner' }}">
                @endforeach

                {{-- Mobile Banner --}}
                @if ($banners->mobile_image)
                    <img src="{{ asset('storage/' . $banners->mobile_image) }}" class="w-100 lp-hero-mobile-banner"
                        alt="{{ $banners->title ?? 'Mobile Hero Banner' }}">
                @elseif (isset($banners->images) && count($banners->images) > 0)
                    {{-- Fallback to first desktop image if no mobile image is set --}}
                    <img src="{{ asset('storage/' . $banners->images[0]) }}" class="w-100 lp-hero-mobile-banner"
                        alt="{{ $banners->title ?? 'Mobile Hero Banner' }}">
                @endif
            </div>
        </section>
    @endif

    @if (isset($initiative) && $initiative)
        <!-- About the Initiative Section -->
        <section id="initiative" class="default-padding">
            <div class="container p-md-0">
                <div class="row" data-aos="fade-up" data-aos-duration="1000">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Skipper Pipes - Jal Rakshak</h4>
                            <h2>About the Initiative</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="150">
                    <div class="col-md-6 pr-md-5">
                        @if ($initiative->image)
                            <img src="{{ asset('storage/' . $initiative->image) }}" class="shadow" alt="">
                        @endif
                    </div>
                    <div class="col-md-6 mt-4 mt-md-0">
                        @if ($initiative->title)
                            <h3 class="lp-para-heading">{{ $initiative->title }}</h3>
                        @endif
                        @if ($initiative->description)
                            {!! $initiative->description !!}
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (isset($activities) && $activities->count() > 0)
        <!-- Offline Acitivies Section -->
        <section id="activities" class="default-padding bg-gray">
            <div class="container p-md-0">
                <div class="row" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Skipper Pipes - Jal Rakshak</h4>
                            <h2>Offline Activities Showcase</h2>
                            <p class="lp-site-sub_heading">On-Ground Impact at Durga Devi Pandals</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($activities as $index => $activity)
                        <div class="col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-duration="1000"
                            data-aos-delay="{{ 150 + $index * 150 }}">
                            <div class="lp-card">
                                @if ($activity->image)
                                    <img src="{{ asset('storage/' . $activity->image) }}" class="shadow"
                                        alt="{{ $activity->title }}">
                                @endif
                                <span class="lp-heading pt-4 mb-2">{{ $activity->title }}</span>
                                <p>{{ $activity->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if (false)
                @if (isset($gallery) && $gallery->count() > 0)
                    <!-- photo gallery -->
                    <div class="container">
                        <div class="row mt-5" data-aos="fade-up" data-aos-duration="1000">
                            <div class="col-12 text-center">
                                <div class="site-heading headings">
                                    <!-- <p class="lp-site-sub_heading">Photo Gallery</p> -->
                                    <h3 class="lp-h3-heading">Photo Gallery</h3>
                                    <p>Active participation from the community.</p>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="gallery" data-aos="fade-up" data-aos-duration="1000"
                            data-aos-delay="150">
                            @foreach ($gallery as $index => $galleryItem)
                                @if ($galleryItem->image)
                                    <div
                                        class="col-md-4 p-3 gallery-item-wrapper {{ $index >= 6 ? 'gallery-hidden' : '' }}">
                                        <img src="{{ asset('storage/' . $galleryItem->image) }}"
                                            class="img-fluid gallery-item"
                                            alt="{{ $galleryItem->title ?? 'Gallery Image' }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @if ($gallery->count() > 6)
                            <div class="col-md-12 text-center mt-4">
                                <button type="button" class="btn jal-rakshak-btn-secondary" id="viewAllGallery">View
                                    All</button>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Lightbox Modal -->
                <div class="modal fade" id="lightboxModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content bg-transparent border-0">
                            <div class="modal-body text-center">
                                <img id="lightboxImage" src="" class="img-fluid rounded" alt="">
                                <!-- Controls -->
                                <a class="lightbox-control left" href="#" id="prevImage">&#10094;</a>
                                <a class="lightbox-control right" href="#" id="nextImage">&#10095;</a>
                            </div>
                        </div>
                    </div>
                </div>

            @endif

            <!-- Youtube videos -->
            <div class="container">
                <div class="row mt-5" data-aos="fade-up" data-aos-duration="1000">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h3 class="lp-h3-heading">Videos</h3>
                            <p>Active participation from the community.</p>
                        </div>
                    </div>
                </div>
                <div class="row" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    @foreach ($videos as $index => $video)
                        <div
                            class="col-md-6 col-lg-4 p-3 p-md-2 video-item-wrapper {{ $index >= 6 ? 'video-hidden' : '' }}">
                            <iframe width="100%" height="315" src="{{ $video->video_url }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    @endforeach
                    @if ($videos->count() > 6)
                        <div class="col-md-12 text-center mt-4">
                            <button type="button" class="btn jal-rakshak-btn-secondary" id="viewAllVideos">View
                                All</button>
                        </div>
                    @endif
                </div>
            </div>

        </section>
    @endif

    @if (isset($conservations) && $conservations->count() > 0)
        <section id="facts" class="default-padding">
            <div class="container p-md-0">
                <div class="row" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Skipper Pipes - Jal Rakshak</h4>
                            <h2>Water Conservation Facts & Tips</h2>
                        </div>
                    </div>
                </div>

                @foreach ($conservations as $key => $item)
                    <div class="row align-items-center pt-5 mt-4" data-aos="fade-up" data-aos-duration="1000"
                        data-aos-delay="{{ 300 + $key * 200 }}">
                        {{-- Left Image --}}
                        <div class="col-md-6 {{ $key % 2 == 0 ? 'pr-md-5 order-1' : 'pl-md-5 order-2' }}">
                            @if ($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="shadow img-fluid"
                                    alt="{{ $item->title }}">
                            @endif
                        </div>

                        {{-- Right Content --}}
                        <div class="col-md-6 mt-3 mt-md-0 {{ $key % 2 == 0 ? 'order-2' : 'order-1' }}">
                            <h3 class="lp-para-heading">{{ $item->title }}</h3>
                            <p>{!! $item->description !!}</p>

                            @if (!empty($item->points))
                                <ol class="pl-4">
                                    @foreach (json_decode($item->points, true) as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ol>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif


    @if (isset($involvement) && $involvement)
        <!-- Get Involved Section -->
        <section id="Involved" class=" my-md-5 pb-5 jal-rakshak-cta">
            <div class="container p-md-0 bg-primary-blue">
                <div class="row pt-5" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="150">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4 class="text-white">Skipper Pipes - Jal Rakshak</h4>
                            <h2>Get Involved</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center" data-aos="fade-up" data-aos-duration="1000"
                    data-aos-delay="300">
                    <div class="col-md-6">
                        @if ($involvement->image)
                            <img src="{{ asset('storage/' . $involvement->image) }}" alt="">
                        @endif
                    </div>
                    <div class="col-md-6 py-4 py-md-0">
                        @if ($involvement->head_title)
                            <h2 class="mb-2">{!! $involvement->head_title !!}</h2>
                        @endif
                        @if ($involvement->description)
                            <p class="mb-4">{!! $involvement->description !!}</p>
                        @endif
                        <form action="{{ route('front.jal-rakshak.submission') }}" method="post"
                            class="jal-rakshak-form pr-md-5" id="jalRakshakForm">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Name <span>*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">Email <span>*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="phone">Mobile Number <span>*</span></label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="water_saving_commitment">Your Water-Saving Commitment</label>
                                    <textarea name="water_saving_commitment" id="water_saving_commitment" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn jal-rakshak-btn mt-3 mb-5">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section id="footer-cta">
        <div class="container-fluid p-0 bg-gray">
            <h3 class="text-center py-4">“Every drop saved is a life protected.”</h3>
        </div>
    </section>

    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.custom.13711.js') }}"></script>
    <script src="{{ asset('assets/js/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/progress-bar.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.simpleLoadMore.js') }}"></script>
    <script src="{{ asset('assets/js/count-to.js') }}"></script>
    <script src="{{ asset('assets/js/bootsnav.js') }}"></script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    {{-- <script src="{{ asset('assets/js/main.js') }}"></script> --}}

    <script>
        const galleryItems = document.querySelectorAll('.gallery-item');
        const lightboxModal = $('#lightboxModal');
        const lightboxImage = document.getElementById('lightboxImage');
        let currentIndex = 0;

        function showImage(index) {
            if (index < 0) index = galleryItems.length - 1;
            if (index >= galleryItems.length) index = 0;
            currentIndex = index;
            lightboxImage.src = galleryItems[currentIndex].src;
            lightboxModal.modal('show');
        }

        galleryItems.forEach((item, index) => {
            item.addEventListener('click', () => {
                showImage(index);
            });
        });

        document.getElementById('prevImage').addEventListener('click', (e) => {
            e.preventDefault();
            showImage(currentIndex - 1);
        });

        document.getElementById('nextImage').addEventListener('click', (e) => {
            e.preventDefault();
            showImage(currentIndex + 1);
        });
    </script>

    <!-- View All functionality for Gallery and Videos -->
    <script>
        $(document).ready(function() {
            // Gallery View All functionality
            $('#viewAllGallery').on('click', function() {
                const hiddenItems = $('.gallery-hidden');
                const button = $(this);

                if (hiddenItems.length > 0) {
                    // Show hidden items with smooth animation
                    hiddenItems.each(function(index) {
                        const item = $(this);
                        setTimeout(function() {
                            item.removeClass('gallery-hidden').addClass('show');
                        }, index * 100); // Stagger the animation
                    });

                    // Change button text and hide it
                    setTimeout(function() {
                        button.text('All Items Shown').addClass('disabled');
                    }, hiddenItems.length * 100 + 200);
                }
            });

            // Videos View All functionality
            $('#viewAllVideos').on('click', function() {
                const hiddenItems = $('.video-hidden');
                const button = $(this);

                if (hiddenItems.length > 0) {
                    // Show hidden items with smooth animation
                    hiddenItems.each(function(index) {
                        const item = $(this);
                        setTimeout(function() {
                            item.removeClass('video-hidden').addClass('show');
                        }, index * 100); // Stagger the animation
                    });

                    // Change button text and hide it
                    setTimeout(function() {
                        button.text('All Videos Shown').addClass('disabled');
                    }, hiddenItems.length * 100 + 200);
                }
            });
        });
    </script>

    <script>
        const toggle = document.getElementById("menu-toggle");
        const navLinks = document.querySelector(".lp-nav-links");
        const links = document.querySelectorAll(".lp-nav-links a");

        // Toggle menu open/close
        toggle.addEventListener("click", () => {
            navLinks.classList.toggle("active");
        });

        // Close menu on nav-link click
        links.forEach(link => {
            link.addEventListener("click", () => {
                navLinks.classList.remove("active");
            });
        });
    </script>

    <!-- jQuery Validation CDN -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Jal Rakshak Form Handling -->
    <script>
        $(document).ready(function() {
            // Prevent default form submission
            $('#jalRakshakForm').on('submit', function(e) {
                e.preventDefault();
                return false;
            });

            $('#jalRakshakForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    email: {
                        required: true,
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
                        required: "Please enter your email address",
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
                                    $('#jalRakshakForm').validate().resetForm();
                                    // Remove any validation classes
                                    $('#jalRakshakForm .form-control').removeClass(
                                        'is-valid is-invalid');
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

    <!-- Initialize AOS -->
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>

    <!-- Popup Scroll Trigger Script -->
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
                        required: true,
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
                        required: "Please enter your email address",
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
</body>

</html>
