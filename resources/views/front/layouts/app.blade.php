<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Start meta-->
    @if (isset($seoData))
        <meta name="title" content="{{ $seoData['meta_title'] ?? '' }}">
        <meta name="description" content="{{ $seoData['meta_description'] ?? '' }}">
        <meta name="keywords" content="{{ $seoData['meta_keywords'] ?? '' }}">
    @endif

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open graph / Twitter --}}
    @hasSection ('og-tags')
        @yield('og-tags')
        
    @else
        <!-- Open Graph / Facebook -->
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="Skipper Pipes">
        <meta property="og:title" content="{{ $seoData['og_title'] ?? $seoData['meta_title'] ?? '' }}">
        <meta property="og:description" content="{{ $seoData['og_description'] ?? $seoData['meta_description'] ?? '' }}">
        <meta property="og:type" content="{{ $seoData['og_type'] ?? 'website' }}">
        @php 
        $banner = \App\Models\Banner::where('status', '1')->orderBy('sequence')->first();
        @endphp
        
        @if(!empty($seoData['og_image']))
            <meta property="og:image" content="{{ asset('storage/' . $seoData['og_image']) }}">
            @else 
            <meta property="og:image" content="{{ asset('storage/' .$banner->image) }}">
        @endif

        <!-- Twitter -->
        <meta name="twitter:card" content="{{ $seoData['twitter_card'] ?? 'summary_large_image' }}">
        <meta name="twitter:title" content="{{ $seoData['twitter_title'] ?? $seoData['og_title'] ?? '' }}">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:site" content="@skipperpipes">
        
        <meta property="twitter:description"
            content="{{ $seoData['meta_description'] ?? $seoData['meta_description'] ?? 'Skipper Pipes - Leading manufacturer of high-quality pipes and fittings' }}">
        @if(!empty($seoData['twitter_image']))
        <meta name="twitter:image" content="{{ asset('storage/' . $seoData['twitter_image']) }}">
        @else
        <meta property="twitter:image" content="{{ asset('storage/' .$banner->image) }}">
        @endif
        @if(!empty($seoData['schema_json']))
            <script type="application/ld+json">
                {!! $seoData['schema_json'] !!}
            </script>
        @endif
        <!--End meta-->
    @endif
    
    <title>{{ $seoData['meta_title'] ?? 'Skipper Pipes' }}</title>
    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset('assets/img/final/skipper-pipes-favicon.png') }}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    {{-- <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" /> --}}
    {{--  <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" /> --}}
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//unpkg.com">
    {{-- <link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/css/flaticon-set.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/js/swiper/swiper.min.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="{{ asset('assets/css/bootsnav.css') }}" rel="stylesheet" /> --}}
    {{-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.php') }}">   
    <link rel="stylesheet" href="{{ asset('style.min.php') }}">   
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" /> --}}
    <link rel="preload"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    as="style"
    onload="this.rel='stylesheet'">

    <noscript>
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    </noscript>
    <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style" onload="this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"></noscript>
    <link rel="preload" href="{{ asset('assets/css/style.php') }}" as="style" onload="this.rel='stylesheet'">
    {{-- <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    media="print"
    onload="this.media='all'"> --}}

    {{-- <noscript>
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    </noscript> --}}
    <link rel="preload" href="{{ asset('style.min.php') }}" as="style" onload="this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('assets/css/responsive.css') }}" as="style" onload="this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('style.min.php') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.php') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    </noscript>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-V8XGVP5J7B"></script>
    <script>function gtag(){dataLayer.push(arguments)}window.dataLayer=window.dataLayer||[],gtag("js",new Date),gtag("config","G-V8XGVP5J7B");</script>
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-P387H72N');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1237639624382812');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1237639624382812&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
    @yield('styles')
    <style>
    .product-category-col img { width: 50px !important; margin-bottom: 15px; }
    .jal-rakshak-btn-secondary { padding: 12px 30px; background-color: #144372; color: #fff; font-weight: 600; border: 0; border-radius: 0; }
    .jal-rakshak-btn-secondary:hover { background-color: #ffa800; color: #144372; }
    .lp-para-heading { font-weight: 600; margin-bottom: 10px; color: #333; }
    #scrollPopup .popup-form-wrapper { position: relative; overflow: hidden; }
    #scrollPopup .popup-close { position: absolute; top: 10px; right: 15px; font-size: 28px; color: #144372; opacity: .8; z-index: 10; }
    #scrollPopup .popup-close:hover { opacity: 1; }
    #scrollPopup .popup-img img { height: 100%; object-fit: cover; }
    #scrollPopup .popup-form { background: #fff; }
    .popup-cta-link, .popup-cta-link:hover { color: #144372; text-decoration: underline; display: inline-block; }
    </style>
    @yield('styles')
</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P387H72N" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
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
                        <img src="{{ asset('assets/img/final/logo.png') }}" class="logo regular" alt="{{ image_alt_text('assets/img/final/logo.png', 'Logo') }}">
                        <img src="{{ asset('assets/img/final/logo.png') }}" class="logo logo-responsive"
                            alt="{{ image_alt_text('assets/img/final/logo.png', 'Logo') }}">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-center" data-in="#" data-out="#">
                        @php
                            $menus = App\Models\Menu::tree();
                        @endphp
                        @foreach ($menus as $menu)
                            @php
                                $menuLink = $menu->link == 'https://skipperbathfittings.com/beta/' ? 'products/bath-fittings' : $menu->link;
                            @endphp
                            @if ($menu->status == 1)
                                @if ($menu->children->isEmpty())
                                    <li class="{{ request()->is($menuLink) ? 'active' : '' }}">
                                        <a
                                            href="{{ $menuLink == '#' ? '#' : url($menuLink) }}">{{ $menu->title }}</a>
                                    </li>
                                @else
                                    <li class="dropdown {{ request()->is($menuLink . '/*') ? 'active' : '' }}">
                                        <a href="#" class="dropdown-toggle"
                                            data-toggle="dropdown">{{ $menu->title }}</a>
                                        <ul class="dropdown-menu">
                                            @foreach ($menu->children as $child)
                                                @php
                                                    $childLink = $child->link == 'https://skipperbathfittings.com/beta/' ? 'products/bath-fittings' : $child->link;
                                                @endphp
                                                @if ($child->children->isEmpty())
                                                    <li>
                                                        <a href="{{ url($childLink) }}">{{ $child->title }}</a>
                                                    </li>
                                                @else
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle"
                                                            data-toggle="dropdown">{{ $child->title }}</a>
                                                        <ul class="dropdown-menu">
                                                            @foreach ($child->children as $grandchild)
                                                                @php
                                                                    $grandchildLink = $grandchild->link == 'https://skipperbathfittings.com/beta/' ? 'products/bath-fittings' : $grandchild->link;
                                                                @endphp
                                                                @if ($grandchild->children->isEmpty())
                                                                    <li>
                                                                        <a
                                                                            href="{{ url($grandchildLink) }}">{{ $grandchild->title }}</a>
                                                                    </li>
                                                                @else
                                                                    <li class="dropdown">
                                                                        <a href="#" class="dropdown-toggle"
                                                                            data-toggle="dropdown">{{ $grandchild->title }}</a>
                                                                        <ul class="dropdown-menu">
                                                                            @foreach ($grandchild->children as $greatgrandchild)
                                                                                @php
                                                                                    $greatgrandchildLink = $greatgrandchild->link == 'https://skipperbathfittings.com/beta/' ? 'products/bath-fittings' : $greatgrandchild->link;
                                                                                @endphp
                                                                                <li>
                                                                                    <a
                                                                                        href="{{ url($greatgrandchildLink) }}">{{ $greatgrandchild->title }}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fas fa-times"></i></a>
                <div class="widget">
                    <img src="{{ asset('assets/img/final/Logo-HR (1).png') }}" alt="{{ image_alt_text('assets/img/final/Logo-HR (1).png', 'Logo') }}">
                    <p>Trusted piping solutions engineered for strength, hygiene, and long-term durability across infrastructure, agriculture, industrial, and residential applications.</p>
                </div>
                <div class="widget address">
                    {{-- <div> --}}
                        <ul>
                            <li>
                                <div class="content">
                                    <p>Address</p>
                                    <strong>12th Floor, Tirumala Building, 22, E Topsia Rd, East Topsia, Tiljala,
                                        Kolkata, West Bengal 700046.</strong>
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
                    {{-- </div> --}}
                </div>

                <div class="widget social">
                    <ul class="link">
                        <li><a href="https://www.facebook.com/skipperpipes/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="https://www.instagram.com/skipperpipes/" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/skipperpipes/" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        <li><a href="https://x.com/skipperpipes" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                        <li><a href="https://www.youtube.com/@skipperpipes358" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @yield('content')
   <footer>
        <div class="container">
            <div class="f-items default-padding">
                <div class="row">
                    @php
                        $footer = \App\Models\Footer::select('section1', 'section2', 'section3', 'section4')->first();
                    @endphp
                    <!-- Single Item -->
                    {!! str_replace('https://skipperbathfittings.com/beta/', url('products/bath-fittings'), $footer->section1) !!}
                    <!-- End Single Item -->

                    <!-- Single Item -->
                    {!! str_replace('https://skipperbathfittings.com/beta/', url('products/bath-fittings'), $footer->section2) !!}
                    <!-- End Single Item -->

                    <!-- Single Item -->
                    {!! str_replace('https://skipperbathfittings.com/beta/', url('products/bath-fittings'), $footer->section3) !!}
                    <!-- End Single Item -->

                    <!-- Single Item -->
                    {!! str_replace('https://skipperbathfittings.com/beta/', url('products/bath-fittings'), $footer->section4) !!}
                    <!-- End Single Item -->
                </div>
            </div>
        </div>
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <p>&copy; Copyright {{ date('Y') }} Skipper Pipes. All Rights Reserved</p>
                    </div>
                    <div class="col-lg-6 text-right">
                        {{-- <p> --}}
                            <a href="{{ url('disclaimer') }}">Disclaimer</a> | <a
                                href="{{ url('privacy-policy') }}">Privacy Policy</a> | <a
                                href="{{ url('terms-conditions') }}">Terms & Conditions</a>
                            {{-- </p> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!-- End Footer -->

    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{ asset('assets/js/jquery.min.js') }}" ></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>   
    <script src="{{ asset('assets/js/swiper/swiper.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.appear.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/modernizr.custom.13711.js') }}" defer></script>
    <script src="{{ asset('assets/js/wow.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/progress-bar.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.simpleLoadMore.js') }}" defer></script>
    <script src="{{ asset('assets/js/count-to.js') }}" defer></script>
    <script src="{{ asset('assets/js/bootsnav.js') }}" defer></script>
    <script src="{{ asset('assets/js/main.js') }}" defer></script>
    @yield('scripts')
    <script>
        // document.addEventListener("click",function(e){const t=e.target.closest(".js-download-brochure");if(!t)return;const n=t.getAttribute("href");e.preventDefault(),gtag("event","download_brochure",{file_extension:t.dataset.fileExtension,file_name:t.dataset.fileName,link:n,text:t.dataset.text,url:window.location.href}),setTimeout(()=>{window.open(n,"_blank")},150)});
        const lazyElements=document.querySelectorAll(".lazy-bg"),observer=new IntersectionObserver((e,t)=>{e.forEach(e=>{if(e.isIntersecting){const n=e.target,o=n.getAttribute("data-bg");o&&(n.style.backgroundImage=`url(${o})`),t.unobserve(n)}})});lazyElements.forEach(e=>observer.observe(e));
</script>
</body>
</html>
