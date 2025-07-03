<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('styles')
    <style>
        .nav-tabs .nav-link {
            color: #505050;
            font-weight: bold;
            padding: 10px 15px;
        }

        .nav.nav-tabs .nav-link:hover {
            background-color: transparent !important;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>
            <nav class="nav flex-column">
                <!-- Dashboard -->
                <a class="nav-link{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> <span class="nav-text">Dashboard</span>
                </a>

                <!-- Blog Module -->
                <div
                    class="nav-section {{ request()->routeIs('admin.blogs.*', 'admin.blog_categories.*', 'admin.blog_comments.*') ? 'open' : '' }}">
                    <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#blogModule">
                        <span class="nav-section-title">
                            <i class="fas fa-chevron-right nav-section-arrow"></i>
                            Blog Module
                        </span>
                    </div>
                    <div class="collapse {{ request()->routeIs('admin.blogs.*', 'admin.blog_categories.*', 'admin.blog_comments.*') ? 'show' : '' }}"
                        id="blogModule">
                        <a class="nav-link{{ request()->routeIs('admin.blogs.*') ? ' active' : '' }}"
                            href="{{ route('admin.blogs.index') }}">
                            <i class="fas fa-newspaper"></i> <span class="nav-text">Blogs</span>
                        </a>
                        <a class="nav-link{{ request()->routeIs('admin.blog_categories.*') ? ' active' : '' }}"
                            href="{{ route('admin.blog_categories.index') }}">
                            <i class="fas fa-tags"></i> <span class="nav-text">Blog Categories</span>
                        </a>
                        <a class="nav-link{{ request()->routeIs('admin.blog_comments.*') ? ' active' : '' }}"
                            href="{{ route('admin.blog_comments.index') }}">
                            <i class="fas fa-comments"></i> <span class="nav-text">Blog Comments</span>
                        </a>
                    </div>
                </div>

                <!-- Product Module -->
                <div
                    class="nav-section {{ request()->routeIs('admin.products.*', 'admin.product_categories.*') ? 'open' : '' }}">
                    <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#productModule">
                        <span class="nav-section-title">
                            <i class="fas fa-chevron-right nav-section-arrow"></i>
                            Product Module
                        </span>
                    </div>
                    <div class="collapse {{ request()->routeIs('admin.products.*', 'admin.product_categories.*') ? 'show' : '' }}"
                        id="productModule">
                        <a class="nav-link{{ request()->routeIs('admin.products.*') ? ' active' : '' }}"
                            href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box"></i> <span class="nav-text">Products</span>
                        </a>
                        <a class="nav-link{{ request()->routeIs('admin.product_categories.*') ? ' active' : '' }}"
                            href="{{ route('admin.product_categories.index') }}">
                            <i class="fas fa-tags"></i> <span class="nav-text">Product Categories</span>
                        </a>
                    </div>
                </div>

                <!-- Content Module -->
                <div
                    class="nav-section {{ request()->routeIs('admin.company_pages.*', 'admin.contacts.*', 'admin.banners.*', 'admin.home-page.*', 'admin.leadership.*') ? 'open' : '' }}">
                    <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#contentModule">
                        <span class="nav-section-title">
                            <i class="fas fa-chevron-right nav-section-arrow"></i>
                            Content Module
                        </span>
                    </div>
                    <div class="collapse {{ request()->routeIs('admin.company_pages.*', 'admin.contacts.*', 'admin.banners.*', 'admin.home-page.*', 'admin.leadership.*') ? 'show' : '' }}"
                        id="contentModule">
                        <a class="nav-link{{ request()->routeIs('admin.home-page.*') ? ' active' : '' }}"
                            href="{{ route('admin.home-page.index') }}">
                            <i class="fas fa-home"></i> <span class="nav-text">Home Page Management</span>
                        </a>
                        <a class="nav-link{{ request()->routeIs('admin.leadership.*') ? ' active' : '' }}"
                            href="{{ route('admin.leadership.sections') }}">
                            <i class="fas fa-users-cog"></i> <span class="nav-text">Leadership Page</span>
                        </a>
                        <a class="nav-link{{ request()->routeIs('admin.company_pages.*') ? ' active' : '' }}"
                            href="{{ route('admin.company_pages.index') }}">
                            <i class="fas fa-file-alt"></i> <span class="nav-text">Company Pages</span>
                        </a>
                        <a class="nav-link{{ request()->routeIs('admin.contacts.*') ? ' active' : '' }}"
                            href="{{ route('admin.contacts.index') }}">
                            <i class="fas fa-envelope"></i> <span class="nav-text">Contacts</span>
                        </a>
                        <a class="nav-link{{ request()->routeIs('admin.banners.*') ? ' active' : '' }}"
                            href="{{ route('admin.banners.index') }}">
                            <i class="fas fa-images"></i> <span class="nav-text">Banners</span>
                        </a>
                    </div>
                </div>

                <!-- Settings -->
                <div class="nav-section {{ request()->routeIs('admin.menus.*', 'admin.users.*') ? 'open' : '' }}">
                    <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#settingsModule">
                        <span class="nav-section-title">
                            <i class="fas fa-chevron-right nav-section-arrow"></i>
                            Settings
                        </span>
                    </div>
                    <div class="collapse {{ request()->routeIs('admin.menus.*', 'admin.users.*') ? 'show' : '' }}"
                        id="settingsModule">
                        <a class="nav-link{{ request()->routeIs('admin.menus.*') ? ' active' : '' }}"
                            href="{{ route('admin.menus.index') }}">
                            <i class="fas fa-bars"></i> <span class="nav-text">Menu Management</span>
                        </a>
                        <a class="nav-link{{ request()->routeIs('admin.users.*') ? ' active' : '' }}"
                            href="{{ route('admin.users.index') }}">
                            <i class="fas fa-users"></i> <span class="nav-text">User Management</span>
                        </a>
                    </div>
                </div>
            </nav>
            <div class="logout">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-light w-100">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
        <div class="content-wrapper">
            <header class="dashboard-header">
                <button class="btn" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="user-dropdown dropdown">
                    <button class="dropdown-toggle d-flex align-items-center" type="button" id="userDropdown"
                        data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=FF9900&color=fff"
                            alt="Profile">
                        <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        {{-- <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i>Settings</a></li> --}}
                        {{-- <li>
                            <hr class="dropdown-divider">
                        </li> --}}
                        <li>
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item"><i
                                        class="fas fa-sign-out-alt me-2"></i>Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </header>
            <main class="main-content">
                {{-- @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif --}}

                @yield('content')
            </main>
            <footer class="footer">
                &copy; {{ date('Y') }} Admin Panel
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            // Auto dismiss alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);

            // Sidebar toggle
            $('#sidebarToggle').on('click', function() {
                $('.sidebar').toggleClass('collapsed');
                $('.content-wrapper').toggleClass('collapsed');
                $('.dashboard-header').toggleClass('collapsed');
            });

            // Initialize menu state based on URL
            function initializeMenuState() {
                $('.nav-link').each(function() {
                    if ($(this).hasClass('active')) {
                        $(this).closest('.nav-section').addClass('open');
                        $(this).closest('.collapse').addClass('show');
                    }
                });
            }

            // Handle menu section clicks
            $('.nav-section-header').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const section = $(this).closest('.nav-section');
                const collapse = section.find('.collapse');

                // Close other sections
                $('.nav-section').not(section).removeClass('open');
                $('.collapse').not(collapse).removeClass('show');

                // Toggle current section
                section.toggleClass('open');
                collapse.toggleClass('show');
            });

            // Initialize menu state on page load
            initializeMenuState();

            // Prevent collapse events from bubbling
            $('.collapse').on('show.bs.collapse hide.bs.collapse', function(e) {
                e.stopPropagation();
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
