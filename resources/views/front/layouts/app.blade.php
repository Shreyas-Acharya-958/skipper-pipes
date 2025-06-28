<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Skipper Pipes">

    <!-- ========== Page Title ========== -->
    <title>@yield('title', 'Skipper Pipes')</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('assets/img/final/skipper-pipes-favicon.png') }}" type="image/x-icon">

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

    @yield('styles')
</head>

<body>
    <!-- Header  -->
    <header id="home">
        <!-- Start Navigation -->
        <nav class="navbar navbar-default attr-bg navbar-fixed white no-background bootsnav nav-full">
            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container-full">
                    <form method="get">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container">
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="side-menu">
                            <a href="#">
                                <span class="bar-1"></span>
                                <span class="bar-2"></span>
                                <span class="bar-3"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/final/logo.png') }}" class="logo regular" alt="Logo">
                        <img src="{{ asset('assets/img/final/logo.png') }}" class="logo logo-responsive"
                            alt="Logo">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-center" data-in="#" data-out="#">
                        <li>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Company</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('company/overview') }}">Overview</a></li>
                                <li><a href="{{ url('company/leadership') }}">Leadership</a></li>
                                <li><a href="{{ url('company/manufacturing') }}">Manufacturing</a></li>
                                <li><a href="{{ url('company/csr') }}">CSR</a></li>
                                <li><a href="{{ url('company/certifications') }}">Certifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('products') }}">All Products</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Plumbing &
                                        Sewage</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('products/upvc-pipes') }}">UPVC Pipes</a></li>
                                        <li><a href="{{ url('products/cpvc-pipes') }}">CPVC Pipes</a></li>
                                        <li><a href="{{ url('products/swr-pipes') }}">SWR Pipes</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ url('products/agriculture-pipes') }}">Agriculture Pipes</a></li>
                                <li><a href="{{ url('products/hdpe-pipes') }}">HDPE Pipes</a></li>
                                <li><a href="{{ url('products/marina-tank') }}">Marina Tank</a></li>
                                <li><a href="{{ url('products/bath-fittings') }}">Bath Fittings</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('network') }}">Network</a>
                        </li>
                        <li>
                            <a href="{{ url('partner') }}">Partner</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Resources</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('news') }}">News</a></li>
                                <li><a href="{{ url('blogs') }}">Blogs</a></li>
                                <li><a href="{{ url('media') }}">Media</a></li>
                                <li><a href="{{ url('faqs') }}">FAQs</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('contact') }}">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fas fa-times"></i></a>
                <div class="widget">
                    <img src="{{ asset('assets/img/final/Logo-HR (1).png') }}" alt="Logo">
                    <p>
                        Skipper Pipes - Your trusted partner in plumbing solutions.
                    </p>
                </div>
                <div class="widget address">
                    <div>
                        <ul>
                            <li>
                                <div class="content">
                                    <p>Address</p>
                                    <strong>3A, Loudon Street Kolkata- 700017</strong>
                                </div>
                            </li>
                            <li>
                                <div class="content">
                                    <p>Email</p>
                                    <strong>enquiry@skipperlimited.com</strong>
                                </div>
                            </li>
                            <li>
                                <div class="content">
                                    <p>Contact</p>
                                    <strong>+91 33 2285 1231/32</strong>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget newsletter">
                    <h4 class="title">Get Subscribed!</h4>
                    <form action="#">
                        <div class="input-group stylish-input-group">
                            <input type="email" placeholder="Enter your e-mail" class="form-control"
                                name="email">
                            <span class="input-group-addon">
                                <button type="submit">
                                    <i class="fas fa-long-arrow-right"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="widget social">
                    <ul class="link">
                        <li><a href="https://www.facebook.com/skipperpipes/" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.instagram.com/skipperpipes/" target="_blank"><i
                                    class="fab fa-instagram"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/skipperpipes/" target="_blank"><i
                                    class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="https://www.youtube.com/@skipperpipes358" target="_blank"><i
                                    class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Header -->

    @yield('content')

    <!-- Start Footer -->
    <footer class="bg-dark text-light">
        <div class="container">
            <div class="f-items default-padding">
                <div class="row">
                    <!-- Single Item -->
                    <div class="col-lg-4 col-md-6 item">
                        <div class="f-item about">
                            <img src="{{ asset('assets/img/final/logo.png') }}" alt="Logo">
                            <p>
                                Excellence in plumbing solutions since decades. Trusted by millions of customers across
                                India.
                            </p>
                            <div class="social">
                                <ul>
                                    <li><a href="https://www.facebook.com/skipperpipes/"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://www.instagram.com/skipperpipes/"><i
                                                class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.linkedin.com/company/skipperpipes/"><i
                                                class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="https://www.youtube.com/@skipperpipes358"><i
                                                class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->

                    <!-- Single Item -->
                    <div class="col-lg-2 col-md-6 item">
                        <div class="f-item link">
                            <h4 class="widget-title">Quick Links</h4>
                            <ul>
                                <li><a href="{{ url('about-us') }}">About us</a></li>
                                <li><a href="{{ url('products') }}">Our Products</a></li>
                                <li><a href="{{ url('network') }}">Network</a></li>
                                <li><a href="{{ url('contact') }}">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Item -->

                    <!-- Single Item -->
                    <div class="col-lg-3 col-md-6 item">
                        <div class="f-item link">
                            <h4 class="widget-title">Products</h4>
                            <ul>
                                <li><a href="{{ url('products/upvc-pipes') }}">UPVC Pipes</a></li>
                                <li><a href="{{ url('products/cpvc-pipes') }}">CPVC Pipes</a></li>
                                <li><a href="{{ url('products/agriculture-pipes') }}">Agriculture Pipes</a></li>
                                <li><a href="{{ url('products/bath-fittings') }}">Bath Fittings</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Item -->

                    <!-- Single Item -->
                    <div class="col-lg-3 col-md-6 item">
                        <div class="f-item">
                            <h4 class="widget-title">Contact Info</h4>
                            <div class="address">
                                <ul>
                                    <li>
                                        <strong>Address:</strong>
                                        3A, Loudon Street Kolkata- 700017
                                    </li>
                                    <li>
                                        <strong>Email:</strong>
                                        <a href="mailto:enquiry@skipperlimited.com">enquiry@skipperlimited.com</a>
                                    </li>
                                    <li>
                                        <strong>Phone:</strong>
                                        <a href="tel:+913322851231">+91 33 2285 1231/32</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <p>&copy; {{ date('Y') }} Skipper Pipes. All Rights Reserved</p>
                    </div>
                    <div class="col-lg-6 text-right">
                        <ul>
                            <li><a href="{{ url('privacy-policy') }}">Privacy Policy</a></li>
                            <li><a href="{{ url('terms-conditions') }}">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!-- End Footer -->

    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/modernizr.custom.13711.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/progress-bar.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/count-to.js') }}"></script>
    <script src="{{ asset('assets/js/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootsnav.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @yield('scripts')
</body>

</html>
