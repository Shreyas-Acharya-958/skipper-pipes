<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (isset($seo) && $seo)
        <meta name="description" content="{{ $seo->meta_description }}">
        <meta name="keywords" content="{{ $seo->meta_keywords }}">
        <title>{{ $seo->meta_title ?: 'Jal Rakshak - Water Conservation Initiative' }}</title>
    @endif

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="assets/img/final/skipper-pipes-favicon.png" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/icofont.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/flaticon-set.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/js/swiper/swiper.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/bootsnav.css') }}" rel="stylesheet" />
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />
    <!-- ========== End Stylesheet ========== -->


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
        }
    </style>

</head>

<body>

    <header class="py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="lp-logo">
                <a href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}" width="120px"
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


    @if (isset($banners) && $banners && isset($banners->images) && count($banners->images) > 0)
        <section id="hero-banner-lp">
            <div class="container-fluid p-0">
                @foreach ($banners->images as $index => $image)
                    <img src="{{ asset('storage/' . $image) }}" class="w-100 lp-hero-banner"
                        alt="{{ $banners->title ?? 'Hero Banner' }}">
                    @if ($index === 0)
                        <img src="{{ asset('storage/' . $image) }}" class="w-100 lp-hero-mobile-banner"
                            alt="{{ $banners->title ?? 'Hero Banner' }}">
                    @endif
                @endforeach
            </div>
        </section>
    @endif

    @if (isset($initiative) && $initiative)
        <!-- About the Initiative Section -->
        <section id="initiative" class="default-padding">
            <div class="container p-md-0">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Skipper Pipes - Jal Rakshak</h4>
                            <h2>About the Initiative</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
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
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Skipper Pipes - Jal Rakshak</h4>
                            <h2>Offline Activities Showcase</h2>
                            <p class="lp-site-sub_heading">On-Ground Impact at Durga Devi Pandals</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($activities as $activity)
                        <div class="col-md-4 mb-4 mb-md-0">
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

            @if (isset($gallery) && $gallery->count() > 0)
                <!-- photo gallery -->
                <div class="container">
                    <div class="row mt-5">
                        <div class="col-12 text-center">
                            <div class="site-heading headings">
                                <!-- <p class="lp-site-sub_heading">Photo Gallery</p> -->
                                <h3 class="lp-h3-heading">Photo Gallery</h3>
                                <p>Active participation from the community.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="gallery">
                        @foreach ($gallery as $galleryItem)
                            @if ($galleryItem->image)
                                <div class="col-md-4 p-3">
                                    <img src="{{ asset('storage/' . $galleryItem->image) }}"
                                        class="img-fluid gallery-item"
                                        alt="{{ $galleryItem->title ?? 'Gallery Image' }}">
                                </div>
                            @endif
                        @endforeach
                    </div>
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



            <!-- Youtube videos -->
            <div class="container">
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h3 class="lp-h3-heading">Videos</h3>
                            <p>Active participation from the community.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="col-md-6 col-lg-4 p-3 p-md-2">
                            <iframe width="100%" height="315" src="{{ $video->video_url }}"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    @endforeach
                    <div class="col-md-12 text-center mt-4">
                        <a href="#" class="btn jal-rakshak-btn-secondary">View All</a>
                    </div>
                </div>
            </div>

        </section>
    @endif

    @if (isset($conservations) && $conservations->count() > 0)
        <!-- Water Conservation Facts & Tips -->
        <section id="facts" class="default-padding">
            <div class="container p-md-0">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4>Skipper Pipes - Jal Rakshak</h4>
                            <h2>Water Conservation Facts & Tips</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 pr-md-5">
                        <!-- <img src="assets/img/initiative-sec1.jpg" class="shadow" alt=""> -->
                        <img src="assets/img/lp/Jalraksha_5Facts_1000x667.png" class="shadow" alt="">
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <h3 class="lp-para-heading">Top 5 Facts - Water Conservation</h3>
                        <p>Discover the top five essential facts highlighting the urgency of water conservation, its
                            scarcity, and the importance of collective responsibility.</p>
                        <ol class="pl-4">
                            <li>India has 18% of the world’s population but only 4% of water.</li>
                            <li>Nearly 70% of freshwater sources are contaminated.</li>
                            <li>A dripping tap can waste up to 20 litres daily.</li>
                            <li>Agriculture consumes over 80% of India’s water supply.</li>
                            <li>By 2030, India’s water demand is expected to double supply.</li>
                        </ol>
                    </div>
                </div>
                <div class="row align-items-center pt-5 mt-4" id="tips">
                    <div class="col-md-6 order-2 order-md-1 mt-3 mt-md-0">
                        <h3 class="lp-para-heading">Top 5 Tips - Water Conservation</h3>
                        <p>Learn five practical and effective tips that help conserve water daily, reduce wastage, and
                            safeguard this precious resource for future generations.</p>
                        <ol class="pl-4">
                            <li>Fix leaks immediately – even small drips matter.</li>
                            <li>Use buckets instead of showers for bathing.</li>
                            <li>Turn off taps while brushing or washing utensils</li>
                            <li>Reuse RO wastewater for cleaning or gardening.</li>
                            <li>Opt for water-efficient fixtures in kitchens and bathrooms.</li>
                        </ol>
                    </div>
                    <div class="col-md-6 pl-md-5 order-1 order-md-2">
                        <!-- <img src="assets/img/initiative-sec1.jpg" class="shadow" alt=""> -->
                        <img src="assets/img/lp/Jalraksha_5Tipss_1000x667.png" class="shadow" alt="">
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (isset($involvement) && $involvement)
        <!-- Get Involved Section -->
        <section id="Involved" class=" my-md-5 pb-5 jal-rakshak-cta">
            <div class="container p-md-0 bg-primary-blue">
                <div class="row pt-5">
                    <div class="col-12 text-center">
                        <div class="site-heading headings">
                            <h4 class="text-white">Skipper Pipes - Jal Rakshak</h4>
                            <h2>Get Involved</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
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
                        <form action="#" method="post" class="jal-rakshak-form pr-md-5">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="full-name">Name <span>*</span></label>
                                    <input type="text" class="form-control" id="full-name" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="phone">Mobile Number <span>*</span></label>
                                    <input type="tel" class="form-control" id="phone" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="Your Water-Saving Commitment">Your Water-Saving Commitment</label>
                                    <textarea name="description" id="description" class="form-control" rows="3"></textarea>
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
    <script src="{{ asset('assets/js/main.js') }}"></script>


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
</body>

</html>
