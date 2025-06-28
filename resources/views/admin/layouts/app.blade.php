<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('styles')
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </div>
            <nav class="nav flex-column">
                <a class="nav-link{{ request()->routeIs('admin.dashboard') ? ' active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> <span class="nav-text">Dashboard</span>
                </a>
                <a class="nav-link{{ request()->routeIs('admin.blogs.*') ? ' active' : '' }}"
                    href="{{ route('admin.blogs.index') }}">
                    <i class="fas fa-newspaper"></i> <span class="nav-text">Blogs</span>
                </a>
                <a class="nav-link{{ request()->routeIs('admin.products.*') ? ' active' : '' }}"
                    href="{{ route('admin.products.index') }}">
                    <i class="fas fa-box"></i> <span class="nav-text">Products</span>
                </a>
                <a class="nav-link{{ request()->routeIs('admin.blog_categories.*') ? ' active' : '' }}"
                    href="{{ route('admin.blog_categories.index') }}">
                    <i class="fas fa-tags"></i> <span class="nav-text">Blog Categories</span>
                </a>
                <a class="nav-link{{ request()->routeIs('admin.blog_comments.*') ? ' active' : '' }}"
                    href="{{ route('admin.blog_comments.index') }}">
                    <i class="fas fa-comments"></i> <span class="nav-text">Blog Comments</span>
                </a>
                <a class="nav-link{{ request()->routeIs('admin.company_pages.*') ? ' active' : '' }}"
                    href="{{ route('admin.company_pages.index') }}">
                    <i class="fas fa-file-alt"></i> <span class="nav-text">Company Pages</span>
                </a>
                <a class="nav-link{{ request()->routeIs('admin.contacts.*') ? ' active' : '' }}"
                    href="{{ route('admin.contacts.index') }}">
                    <i class="fas fa-envelope"></i> <span class="nav-text">Contacts</span>
                </a>
                <li class="nav-item">
                    <a href="{{ route('admin.menus.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>Menu Management</p>
                    </a>
                </li>
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
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
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
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-coreui-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

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
        // Sidebar toggle (collapsible)
        $(function() {
            $('#sidebarToggle').on('click', function() {
                $('.sidebar').toggleClass('collapsed');
                $('.content-wrapper').toggleClass('collapsed');
                $('.dashboard-header').toggleClass('collapsed');
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
