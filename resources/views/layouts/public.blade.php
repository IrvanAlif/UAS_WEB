<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechNews - Portal Berita Teknologi')</title>
    <meta name="description" content="@yield('description', 'Portal berita teknologi terkini: AI, Gadget, Programming, Cyber Security, dan Software.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --dark: #0f172a;
            --gray-900: #111827;
            --gray-700: #374151;
            --gray-500: #6b7280;
            --gray-300: #d1d5db;
            --gray-100: #f3f4f6;
            --white: #ffffff;
            --radius: 8px;
            --shadow: 0 1px 3px rgba(0, 0, 0, .1), 0 1px 2px rgba(0, 0, 0, .06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, .1);
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--gray-900);
            background: var(--white);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* Navbar */
        .navbar {
            background: var(--white);
            border-bottom: 1px solid var(--gray-300);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            height: 64px;
            gap: 24px;
        }

        .navbar-brand {
            font-size: 22px;
            font-weight: 800;
            color: var(--primary);
            letter-spacing: -0.5px;
            white-space: nowrap;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-nav a {
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-700);
            transition: all .15s;
        }

        .navbar-nav a:hover,
        .navbar-nav a.active {
            color: var(--primary);
            background: #eff6ff;
        }

        .nav-dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: var(--white);
            border: 1px solid var(--gray-300);
            border-radius: var(--radius);
            min-width: 200px;
            box-shadow: var(--shadow-md);
            padding: 4px;
        }

        .nav-dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            display: block;
            padding: 8px 12px;
            font-size: 14px;
            border-radius: 4px;
            color: var(--gray-700);
        }

        .dropdown-menu a:hover {
            background: var(--gray-100);
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-input {
            border: 1px solid var(--gray-300);
            border-radius: 20px;
            padding: 7px 16px;
            font-size: 14px;
            width: 220px;
            outline: none;
            transition: border-color .2s;
        }

        .search-input:focus {
            border-color: var(--primary);
        }

        .btn-subscribe {
            background: var(--primary);
            color: var(--white);
            padding: 8px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background .2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-subscribe:hover {
            background: var(--primary-dark);
            color: white;
        }

        /* Carousel */
        .carousel-section {
            position: relative;
            background: #000;
        }

        .carousel {
            position: relative;
            overflow: hidden;
            height: 480px;
        }

        .carousel-track {
            display: flex;
            height: 100%;
            transition: transform .5s ease;
        }

        .carousel-slide {
            min-width: 100%;
            height: 100%;
            position: relative;
            background: var(--dark);
        }

        .carousel-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: .65;
        }

        .carousel-slide-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
        }

        .carousel-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 48px 64px 40px;
            background: linear-gradient(to top, rgba(0, 0, 0, .85) 0%, transparent 100%);
        }

        .carousel-badge {
            display: inline-block;
            background: var(--primary);
            color: white;
            font-size: 12px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 4px;
            margin-bottom: 12px;
        }

        .carousel-title {
            font-size: 32px;
            font-weight: 700;
            color: white;
            margin-bottom: 10px;
            line-height: 1.25;
        }

        .carousel-excerpt {
            color: rgba(255, 255, 255, .8);
            font-size: 15px;
            max-width: 560px;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, .2);
            border: none;
            color: white;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background .2s;
            backdrop-filter: blur(4px);
        }

        .carousel-btn:hover {
            background: rgba(255, 255, 255, .35);
        }

        .carousel-btn.prev {
            left: 20px;
        }

        .carousel-btn.next {
            right: 20px;
        }

        .carousel-dots {
            position: absolute;
            bottom: 16px;
            right: 24px;
            display: flex;
            gap: 6px;
        }

        .carousel-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .5);
            cursor: pointer;
            transition: all .2s;
        }

        .carousel-dot.active {
            background: white;
            width: 24px;
            border-radius: 4px;
        }

        /* Category pills */
        .category-pills {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pill-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .pill {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid var(--gray-300);
            color: var(--gray-700);
            transition: all .15s;
            cursor: pointer;
        }

        .pill:hover,
        .pill.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        /* Main layout */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--gray-100);
        }

        .section-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--gray-900);
        }

        .link-more {
            font-size: 14px;
            color: var(--primary);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .link-more:hover {
            text-decoration: underline;
        }

        /* Article cards */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 48px;
        }

        .article-card {
            border: 1px solid var(--gray-300);
            border-radius: var(--radius);
            overflow: hidden;
            background: var(--white);
            transition: box-shadow .2s, transform .2s;
        }

        .article-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .article-card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: var(--gray-100);
        }

        .article-card-img-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            color: var(--primary);
        }

        .article-card-body {
            padding: 16px;
        }

        .article-card-badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            background: var(--primary);
            color: white;
            margin-bottom: 8px;
        }

        .article-card-date {
            font-size: 12px;
            color: var(--gray-500);
            margin-bottom: 6px;
        }

        .article-card-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--gray-900);
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .article-card-title:hover {
            color: var(--primary);
        }

        .article-card-excerpt {
            font-size: 13px;
            color: var(--gray-500);
            line-height: 1.5;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: rgba(255, 255, 255, .7);
            margin-top: 64px;
            padding: 48px 0 24px;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 32px;
            margin-bottom: 40px;
        }

        .footer-brand-col .footer-brand {
            font-size: 22px;
            font-weight: 800;
            color: white;
            margin-bottom: 8px;
        }

        .footer-brand-col p {
            font-size: 13px;
            color: rgba(255, 255, 255, .5);
            max-width: 240px;
            line-height: 1.6;
        }

        /* FIX #6: footer links dibuat nyata dengan route/anchor yang valid */
        .footer-col h4 {
            font-size: 13px;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: .8px;
            margin-bottom: 16px;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 8px;
        }

        .footer-col ul li a {
            font-size: 13px;
            color: rgba(255, 255, 255, .55);
            transition: color .15s;
        }

        .footer-col ul li a:hover {
            color: white;
        }

        .footer-social {
            display: flex;
            gap: 10px;
            margin-top: 16px;
        }

        .footer-social a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .1);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            transition: background .2s;
        }

        .footer-social a:hover {
            background: var(--primary);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, .1);
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 12px;
            color: rgba(255, 255, 255, .35);
        }

        /* Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 14px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        @media (max-width: 768px) {
            .articles-grid {
                grid-template-columns: 1fr;
            }

            .carousel {
                height: 320px;
            }

            .carousel-title {
                font-size: 20px;
            }

            .carousel-content {
                padding: 24px;
            }

            .navbar-nav {
                display: none;
            }

            .search-input {
                width: 140px;
            }

            .footer-top {
                flex-direction: column;
                gap: 24px;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <nav class="navbar">
        <div class="navbar-inner">
            <a href="{{ route('home') }}" class="navbar-brand">TechNews</a>
            <div class="navbar-nav">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <div class="nav-dropdown">
                    <a href="#" style="display:flex;align-items:center;gap:4px;">
                        Kategori <i class="fas fa-chevron-down" style="font-size:10px;"></i>
                    </a>
                    <div class="dropdown-menu">
                        @foreach($navCategories as $cat)
                        <a href="{{ route('category', $cat->slug) }}">{{ $cat->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="navbar-right">
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    <input type="text" name="q" class="search-input"
                        placeholder="Cari artikel..." value="{{ request('q') }}">
                </form>
            </div>
        </div>
    </nav>

    @yield('content')

    {{-- FIX #6: Footer dengan link nyata --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-brand-col">
                    <div class="footer-brand">TechNews</div>
                    <p>Portal berita teknologi terkini seputar AI, Gadget, Programming, Cyber Security, dan Software.</p>
                    <div class="footer-social">
                        <a href="https://twitter.com" target="_blank" rel="noopener" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener" title="LinkedIn">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Kategori</h4>
                    <ul>
                        @foreach($navCategories as $cat)
                        <li><a href="{{ route('category', $cat->slug) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('search', ['q' => '']) }}">Semua Artikel</a></li>
                        @auth
                        <li><a href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                        @endauth
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Info</h4>
                    <ul>
                        <li><a href="mailto:admin@technews.com">Kontak Kami</a></li>
                        <li>
                            {{-- FIX: link ke halaman yang ada atau pakai anchor --}}
                            <a href="{{ route('home') }}#tentang">Tentang TechNews</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <span>© {{ date('Y') }} TechNews Platform. All rights reserved.</span>
                <span>Dibuat dengan Laravel</span>
            </div>
        </div>
    </footer>

    <script>
        // Carousel
        (function() {
            const track = document.querySelector('.carousel-track');
            if (!track) return;
            const slides = track.querySelectorAll('.carousel-slide');
            const dots = document.querySelectorAll('.carousel-dot');
            let current = 0,
                timer;

            function go(n) {
                current = (n + slides.length) % slides.length;
                track.style.transform = `translateX(-${current * 100}%)`;
                dots.forEach((d, i) => d.classList.toggle('active', i === current));
            }

            document.querySelector('.carousel-btn.prev')?.addEventListener('click', () => {
                clearInterval(timer);
                go(current - 1);
                start();
            });
            document.querySelector('.carousel-btn.next')?.addEventListener('click', () => {
                clearInterval(timer);
                go(current + 1);
                start();
            });
            dots.forEach((d, i) => d.addEventListener('click', () => {
                clearInterval(timer);
                go(i);
                start();
            }));

            function start() {
                timer = setInterval(() => go(current + 1), 5000);
            }
            go(0);
            start();
        })();
    </script>
    @stack('scripts')
</body>

</html>