<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="أخبار اليوم - موقع إخباري شامل">
    <title>@yield('title', 'أخبار اليوم')</title>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts - Tajawal -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1a1a2e;
            --secondary-color: #16213e;
            --accent-color: #e94560;
            --accent-hover: #c23152;
            --text-light: #f5f5f5;
            --card-shadow: 0 4px 15px rgba(0,0,0,0.08);
            --card-hover-shadow: 0 8px 30px rgba(0,0,0,0.15);
            --gradient-primary: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            --gradient-accent: linear-gradient(135deg, #e94560 0%, #c23152 100%);
        }

        * {
            font-family: 'Tajawal', sans-serif;
        }

        body {
            background-color: #f0f2f5;
            color: #333;
        }

        /* Navbar */
        .navbar-custom {
            background: var(--gradient-primary);
            padding: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .navbar-custom .navbar-brand {
            font-weight: 900;
            font-size: 1.6rem;
            color: white;
            padding: 12px 0;
        }

        .navbar-custom .navbar-brand .brand-dot {
            color: var(--accent-color);
        }

        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.85) !important;
            font-weight: 500;
            padding: 16px 18px !important;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.95rem;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: white !important;
            background: rgba(255,255,255,0.1);
        }

        .navbar-custom .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            left: 0;
            height: 3px;
            background: var(--accent-color);
        }

        /* Breaking news ticker */
        .breaking-news-bar {
            background: var(--accent-color);
            color: white;
            padding: 8px 0;
            font-size: 0.9rem;
            overflow: hidden;
        }

        .breaking-label {
            background: rgba(0,0,0,0.3);
            padding: 4px 16px;
            border-radius: 4px;
            font-weight: 700;
            white-space: nowrap;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .ticker-wrapper {
            overflow: hidden;
            flex: 1;
            margin-right: 15px;
        }

        .ticker-content {
            display: flex;
            animation: ticker 30s linear infinite;
            white-space: nowrap;
        }

        .ticker-content:hover {
            animation-play-state: paused;
        }

        .ticker-item {
            padding: 0 30px;
            border-left: 2px solid rgba(255,255,255,0.3);
        }

        @keyframes ticker {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* Search bar */
        .search-box {
            position: relative;
        }

        .search-box input {
            border-radius: 50px;
            padding: 8px 20px;
            padding-left: 45px;
            border: 2px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.1);
            color: white;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            width: 200px;
        }

        .search-box input:focus {
            background: rgba(255,255,255,0.2);
            border-color: var(--accent-color);
            box-shadow: none;
            width: 280px;
            outline: none;
        }

        .search-box input::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .search-box .search-btn {
            position: absolute;
            left: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255,255,255,0.7);
            cursor: pointer;
        }

        /* Cards */
        .news-card {
            border: none;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: var(--card-shadow);
            height: 100%;
            background: white;
        }

        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-hover-shadow);
        }

        .news-card .card-img-top {
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .news-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .news-card .img-wrapper {
            overflow: hidden;
            position: relative;
        }

        .news-card .category-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 2;
        }

        .news-card .card-body {
            padding: 20px;
        }

        .news-card .card-title {
            font-weight: 700;
            font-size: 1.05rem;
            line-height: 1.7;
            color: var(--primary-color);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-card .card-text {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.8;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .news-card .card-footer {
            background: transparent;
            border-top: 1px solid #f0f0f0;
            padding: 12px 20px;
        }

        .news-card .source-info {
            font-size: 0.8rem;
            color: #999;
        }

        .news-card .source-info .source-name {
            color: var(--accent-color);
            font-weight: 600;
        }

        /* Hero card */
        .hero-card {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            min-height: 450px;
            box-shadow: var(--card-shadow);
            transition: all 0.4s ease;
        }

        .hero-card:hover {
            box-shadow: var(--card-hover-shadow);
            transform: translateY(-5px);
        }

        .hero-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .hero-card .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 40px 30px 30px;
            background: linear-gradient(transparent, rgba(0,0,0,0.85));
            color: white;
        }

        .hero-card .hero-title {
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .hero-card .hero-desc {
            font-size: 0.95rem;
            opacity: 0.9;
            line-height: 1.7;
        }

        /* Side news */
        .side-news-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: white;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .side-news-item:hover {
            background: #f8f9fa;
            transform: translateX(-5px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .side-news-item img {
            width: 110px;
            height: 85px;
            object-fit: cover;
            border-radius: 10px;
            flex-shrink: 0;
        }

        .side-news-item .side-title {
            font-weight: 600;
            font-size: 0.9rem;
            line-height: 1.7;
            color: var(--primary-color);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .side-news-item .side-meta {
            font-size: 0.75rem;
            color: #999;
            margin-top: 8px;
        }

        /* Section headers */
        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 12px;
            border-bottom: 3px solid #f0f0f0;
        }

        .section-header h2 {
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--primary-color);
            margin: 0;
        }

        .section-header .section-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--gradient-accent);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 12px;
            font-size: 1.1rem;
        }

        .section-header .view-all {
            margin-right: auto;
            color: var(--accent-color);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .section-header .view-all:hover {
            color: var(--accent-hover);
            gap: 8px;
        }

        /* Badge */
        .badge-accent {
            background: var(--gradient-accent);
            color: white;
            padding: 5px 14px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        /* Category cards */
        .category-card {
            border: none;
            border-radius: 16px;
            padding: 25px 20px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: white;
            box-shadow: var(--card-shadow);
            text-decoration: none;
            color: var(--primary-color);
            display: block;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--card-hover-shadow);
            background: var(--gradient-primary);
            color: white;
        }

        .category-card .cat-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--accent-color);
            transition: color 0.3s ease;
        }

        .category-card:hover .cat-icon {
            color: white;
        }

        .category-card .cat-name {
            font-weight: 700;
            font-size: 1rem;
        }

        /* Footer */
        .footer {
            background: var(--gradient-primary);
            color: rgba(255,255,255,0.8);
            padding: 50px 0 25px;
            margin-top: 60px;
        }

        .footer h5 {
            color: white;
            font-weight: 700;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer h5::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 40px;
            height: 3px;
            background: var(--accent-color);
            border-radius: 2px;
        }

        .footer a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer a:hover {
            color: var(--accent-color);
            padding-right: 8px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            margin-top: 30px;
        }

        /* Date bar */
        .date-bar {
            background: white;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            font-size: 0.85rem;
            color: #666;
        }

        /* Scroll to top */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            left: 30px;
            width: 45px;
            height: 45px;
            background: var(--gradient-accent);
            color: white;
            border: none;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(233,69,96,0.4);
            transition: all 0.3s ease;
            z-index: 9999;
        }

        .scroll-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(233,69,96,0.5);
        }

        /* Placeholder image */
        .img-placeholder {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
        }

        /* Loading skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: 8px;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-card {
                min-height: 300px;
            }

            .hero-card .hero-title {
                font-size: 1.2rem;
            }

            .search-box input {
                width: 150px;
            }

            .search-box input:focus {
                width: 200px;
            }

            .ticker-content {
                animation-duration: 15s;
            }
        }

        /* Link styling */
        a.text-decoration-none:hover {
            text-decoration: none !important;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-newspaper ms-2"></i>
                أخبار<span class="brand-dot">.</span>اليوم
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list text-white fs-4"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door ms-1"></i> الرئيسية
                        </a>
                    </li>
                    @isset($categories)
                        @foreach($categories as $key => $cat)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('category/'.$key) ? 'active' : '' }}"
                                   href="{{ route('category', $key) }}">
                                    <i class="bi {{ $cat['icon'] }} ms-1"></i> {{ $cat['name'] }}
                                </a>
                            </li>
                        @endforeach
                    @endisset
                </ul>

                <form action="{{ route('search') }}" method="GET" class="search-box">
                    <input type="text" name="q" class="form-control" placeholder="ابحث عن خبر..."
                           value="{{ request('q') }}">
                    <button type="submit" class="search-btn">
                        <i class="bi bi-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Date bar -->
    <div class="date-bar d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <i class="bi bi-calendar3 ms-1"></i>
                {{ \Carbon\Carbon::now()->locale('ar')->translatedFormat('l، d F Y') }}
            </div>
            <div>
                <i class="bi bi-clock ms-1"></i>
                آخر تحديث: {{ \Carbon\Carbon::now()->locale('ar')->format('h:i A') }}
            </div>
        </div>
    </div>

    @yield('breaking-news')

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5>
                        <i class="bi bi-newspaper ms-2"></i>
                        أخبار.اليوم
                    </h5>
                    <p class="mt-3" style="line-height: 1.9;">
                        موقع إخباري شامل يقدم لك آخر الأخبار والمستجدات
                        من مختلف المصادر الموثوقة حول العالم، على مدار الساعة.
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="fs-5"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="fs-5"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>الأقسام</h5>
                    <ul class="list-unstyled">
                        @isset($categories)
                            @foreach($categories as $key => $cat)
                                <li class="mb-2">
                                    <a href="{{ route('category', $key) }}">
                                        <i class="bi {{ $cat['icon'] }} ms-1"></i> {{ $cat['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        @endisset
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>تواصل معنا</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-envelope ms-2"></i> info@akhbartoday.com
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-telephone ms-2"></i> +966 50 000 0000
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-geo-alt ms-2"></i> الرياض، المملكة العربية السعودية
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p class="mb-0">
                    &copy; {{ date('Y') }} أخبار.اليوم - جميع الحقوق محفوظة |
                    مدعوم بواسطة <a href="https://gnews.io" target="_blank" style="color: var(--accent-color)">GNews API</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Scroll to top -->
    <button class="scroll-top" id="scrollTop">
        <i class="bi bi-arrow-up"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Scroll to top button
        const scrollBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollBtn.style.display = 'flex';
            } else {
                scrollBtn.style.display = 'none';
            }
        });
        scrollBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Handle broken images
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('img').forEach(img => {
                img.addEventListener('error', function() {
                    this.style.display = 'none';
                    const placeholder = document.createElement('div');
                    placeholder.className = 'img-placeholder';
                    placeholder.style.height = this.style.height || '220px';
                    placeholder.innerHTML = '<i class="bi bi-newspaper"></i>';
                    this.parentNode.insertBefore(placeholder, this);
                });
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
