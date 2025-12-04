<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Content Management - @yield('title')</title>
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

        .btn-group .fa-eye {
            display: none;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <nav class="nav flex-column">
                <!-- Dashboard -->
                <a class="nav-link{{ request()->routeIs('content-management.dashboard') ? ' active' : '' }}"
                    href="{{ route('content-management.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> <span class="nav-text">Dashboard</span>
                </a>

                <!-- Blog Module -->
                <div
                    class="nav-section {{ request()->routeIs('content-management.blogs.*', 'content-management.blog_categories.*') ? 'open' : '' }}">
                    <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#blogModule">
                        <span class="nav-section-title">
                            <i class="fas fa-chevron-right nav-section-arrow"></i>
                            Blog Module
                        </span>
                    </div>
                    <div class="collapse {{ request()->routeIs('content-management.blogs.*', 'content-management.blog_categories.*') ? 'show' : '' }}"
                        id="blogModule">
                        <a class="nav-link{{ request()->routeIs('content-management.blogs.*') ? ' active' : '' }}"
                            href="{{ route('content-management.blogs.index') }}">
                            <i class="fas fa-newspaper"></i> <span class="nav-text">Blogs</span>
                        </a>
                        <a class="nav-link{{ request()->routeIs('content-management.blog_categories.*') ? ' active' : '' }}"
                            href="{{ route('content-management.blog_categories.index') }}">
                            <i class="fas fa-tags"></i> <span class="nav-text">Blog Categories</span>
                        </a>
                    </div>
                </div>

                <!-- Product Module -->
                <div
                    class="nav-section {{ request()->routeIs('content-management.products.*', 'content-management.product_categories.*') ? 'open' : '' }}">
                    <div class="nav-section-header" data-bs-toggle="collapse" data-bs-target="#productModule">
                        <span class="nav-section-title">
                            <i class="fas fa-chevron-right nav-section-arrow"></i>
                            Product Module
                        </span>
                    </div>
                    <div class="collapse {{ request()->routeIs('content-management.products.*', 'content-management.product_categories.*') ? 'show' : '' }}"
                        id="productModule">
                        <a class="nav-link{{ request()->routeIs('content-management.products.*') ? ' active' : '' }}"
                            href="{{ route('content-management.products.index') }}">
                            <i class="fas fa-box"></i> <span class="nav-text">Products</span>
                        </a>
                        <a class="nav-link{{ request()->routeIs('content-management.product_categories.*') ? ' active' : '' }}"
                            href="{{ route('content-management.product_categories.index') }}">
                            <i class="fas fa-tags"></i> <span class="nav-text">Product Categories</span>
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
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'User' }}&background=FF9900&color=fff"
                            alt="Profile">
                        <span>{{ Auth::user()->name ?? 'User' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
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
                @yield('content')
            </main>
            <footer class="footer">
                &copy; {{ date('Y') }} Content Management Panel
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
        });
    </script>
    @stack('scripts')
</body>

</html>

