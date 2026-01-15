<!DOCTYPE html>
<html lang="id" id="htmlRoot">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Digital Marketplace') - Digital Products & Services</title>
    
    <!-- Theme Init Script - Must be before CSS -->
    <script>
        (function() {
            var theme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Default Dark Theme */
        :root,
        html[data-theme="dark"] {
            --bg-primary: #0f0f0f;
            --bg-secondary: #1a1a1a;
            --bg-tertiary: #242424;
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
            --accent-color: #6366f1;
            --accent-hover: #818cf8;
            --border-color: #2d2d2d;
            --card-bg: #1a1a1a;
            --success-color: #22c55e;
        }

        /* Light Theme */
        html[data-theme="light"] {
            --bg-primary: #f8f9fa;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f1f3f5;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            --accent-color: #6366f1;
            --accent-hover: #4f46e5;
            --border-color: #dee2e6;
            --card-bg: #ffffff;
            --success-color: #22c55e;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Navbar Styles */
        .navbar-custom {
            background-color: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-primary) !important;
        }

        .navbar-brand span {
            color: var(--accent-color);
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--text-primary) !important;
        }

        /* Button Styles */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            background: transparent;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background: var(--accent-color);
            color: white;
        }

        /* Card Styles */
        .card-custom {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-5px);
            border-color: var(--accent-color);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        /* Section Styles */
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }

        /* Footer Styles */
        .footer {
            background-color: var(--bg-secondary);
            border-top: 1px solid var(--border-color);
            padding: 3rem 0;
            margin-top: 5rem;
        }

        .footer-link {
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: var(--accent-color);
        }

        /* Form Styles */
        .form-control-custom {
            background-color: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }

        .form-control-custom:focus {
            background-color: var(--bg-tertiary);
            border-color: var(--accent-color);
            color: var(--text-primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }

        .form-control-custom::placeholder {
            color: var(--text-secondary);
        }

        /* Badge Styles */
        .badge-custom {
            background-color: var(--accent-color);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Price Styles */
        .price {
            color: var(--accent-color);
            font-weight: 700;
            font-size: 1.25rem;
        }

        /* Rating Styles */
        .rating {
            color: #fbbf24;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-primary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color);
        }

        /* Alert Styles */
        .alert-success-custom {
            background-color: rgba(34, 197, 94, 0.1);
            border: 1px solid var(--success-color);
            color: var(--success-color);
            border-radius: 8px;
        }

        /* Theme Toggle Slide Button */
        .theme-toggle-slide {
            position: relative;
            width: 65px;
            height: 32px;
            background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
            border: 2px solid var(--border-color);
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            padding: 3px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .theme-toggle-slide:hover {
            border-color: var(--accent-color);
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }

        .theme-toggle-slide:active {
            transform: scale(0.95);
        }

        .theme-toggle-slider {
            position: absolute;
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
            border-radius: 50%;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            left: 3px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        }

        html[data-theme="light"] .theme-toggle-slide {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        html[data-theme="light"] .theme-toggle-slider {
            left: calc(100% - 27px);
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            box-shadow: 0 2px 8px rgba(251, 191, 36, 0.5);
        }

        /* Background stars animation for dark mode */
        .theme-toggle-slide::before {
            content: '✦';
            position: absolute;
            left: 8px;
            color: #fbbf24;
            font-size: 0.6rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        html[data-theme="dark"] .theme-toggle-slide::before {
            opacity: 0.7;
        }

        /* Sun rays for light mode */
        .theme-toggle-slide::after {
            content: '☀';
            position: absolute;
            right: 8px;
            color: #f59e0b;
            font-size: 0.7rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        html[data-theme="light"] .theme-toggle-slide::after {
            opacity: 0.8;
        }

        /* Card transitions */
        .card-custom {
            transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-box-seam me-2"></i>Digital<span>Market</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                style="border-color: var(--border-color);">
                <i class="bi bi-list" style="color: var(--text-primary); font-size: 1.5rem;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                            href="{{ route('products.index') }}">
                            <i class="bi bi-grid me-1"></i>Products
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}"
                                    href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2 me-1"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}"
                                    href="{{ route('admin.orders') }}">
                                    <i class="bi bi-list-check me-1"></i>Manage Orders
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('orders.*') ? 'active' : '' }}"
                                    href="{{ route('orders.index') }}">
                                    <i class="bi bi-bag me-1"></i>My Orders
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <div class="d-flex gap-2 align-items-center">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline-custom btn-sm">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary-custom btn-sm">
                            <i class="bi bi-person-plus me-1"></i>Register
                        </a>
                        
                        <!-- Theme Toggle for Guest -->
                        <div class="theme-toggle-slide" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
                            <div class="theme-toggle-slider">
                                <i class="bi bi-moon-fill" id="themeIcon"></i>
                            </div>
                        </div>
                    @else
                        @if(auth()->user()->isCustomer())
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-custom btn-sm position-relative">
                                <i class="bi bi-cart3"></i>
                                @php
                                    $cartCount = auth()->user()->cart?->item_count ?? 0;
                                @endphp
                                @if($cartCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                                        style="background: var(--accent-color); font-size: 0.65rem;">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                        @endif

                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('products.create') }}" class="btn btn-primary-custom btn-sm">
                                <i class="bi bi-plus-lg me-1"></i>Add Product
                            </a>
                        @endif

                        <div class="dropdown">
                            <button class="btn btn-outline-custom btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end"
                                style="background: var(--bg-secondary); border-color: var(--border-color);">
                                @if(auth()->user()->isAdmin())
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}" style="color: var(--text-primary);">
                                            <i class="bi bi-speedometer2 me-2"></i>Admin Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.orders') }}" style="color: var(--text-primary);">
                                            <i class="bi bi-list-check me-2"></i>Manage Orders
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('orders.index') }}" style="color: var(--text-primary);">
                                            <i class="bi bi-bag me-2"></i>My Orders
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('cart.index') }}" style="color: var(--text-primary);">
                                            <i class="bi bi-cart3 me-2"></i>Shopping Cart
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider" style="border-color: var(--border-color);">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="color: var(--text-primary);">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Theme Toggle for Authenticated Users -->
                        <div class="theme-toggle-slide" onclick="toggleTheme()" title="Toggle Dark/Light Mode">
                            <div class="theme-toggle-slider">
                                <i class="bi bi-moon-fill" id="themeIconAuth"></i>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="container mt-4">
            <div class="alert alert-success-custom">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="mb-3">
                        <i class="bi bi-box-seam me-2"></i>Digital<span
                            style="color: var(--accent-color);">Market</span>
                    </h5>
                    <p class="text-secondary">
                        Platform jual beli produk digital dan jasa pembuatan website profesional.
                    </p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h6 class="mb-3">Services</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">Frontend</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Backend</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Fullstack</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h6 class="mb-3">Products</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="footer-link">Templates</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">Plugins</a></li>
                        <li class="mb-2"><a href="#" class="footer-link">E-Books</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <h6 class="mb-3">Contact Us</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>info@digitalmarket.com</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i>+62 812 3456 7890</li>
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <hr style="border-color: var(--border-color);">
            <div class="text-center text-secondary">
                <small>&copy; {{ date('Y') }} DigitalMarket. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Theme Toggle Script -->
    <script>
        // Toggle between light and dark theme
        function toggleTheme() {
            var html = document.documentElement;
            var currentTheme = html.getAttribute('data-theme') || 'dark';
            var newTheme = (currentTheme === 'light') ? 'dark' : 'light';
            
            // Apply new theme
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Update all icons
            var icons = document.querySelectorAll('[id^="themeIcon"]');
            for (var i = 0; i < icons.length; i++) {
                icons[i].className = (newTheme === 'dark') ? 'bi bi-moon-fill' : 'bi bi-sun-fill';
            }
        }

        // Initialize icons on page load
        document.addEventListener('DOMContentLoaded', function() {
            var theme = localStorage.getItem('theme') || 'dark';
            var icons = document.querySelectorAll('[id^="themeIcon"]');
            for (var i = 0; i < icons.length; i++) {
                icons[i].className = (theme === 'dark') ? 'bi bi-moon-fill' : 'bi bi-sun-fill';
            }
        });
    </script>
    
    @stack('scripts')
</body>

</html>