@extends('layouts.app')

@section('title', 'أخبار اليوم - الرئيسية')

@section('breaking-news')
    @if(!empty($headlines['articles']))
        <div class="breaking-news-bar">
            <div class="container d-flex align-items-center">
                <span class="breaking-label">
                    <i class="bi bi-lightning-charge-fill ms-1"></i> عاجل
                </span>
                <div class="ticker-wrapper">
                    <div class="ticker-content">
                        @foreach($headlines['articles'] as $article)
                            <span class="ticker-item">{{ $article['title'] }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('content')
<div class="container">

    {{-- Hero Section --}}
    @if(!empty($headlines['articles']))
        <div class="row g-4 mb-5">
            {{-- Main hero --}}
            <div class="col-lg-7">
                @php $hero = $headlines['articles'][0]; @endphp
                <a href="{{ route('article.show', ['url' => $hero['url'], 'title' => $hero['title']]) }}"
                   class="text-decoration-none">
                    <div class="hero-card">
                        <img src="{{ $hero['image'] ?? '' }}" alt="{{ $hero['title'] }}"
                             onerror="this.src='https://via.placeholder.com/800x500/1a1a2e/ffffff?text=أخبار+اليوم'">
                        <div class="hero-overlay">
                            <span class="badge-accent mb-3 d-inline-block">
                                <i class="bi bi-lightning-charge-fill ms-1"></i> خبر رئيسي
                            </span>
                            <h1 class="hero-title">{{ $hero['title'] }}</h1>
                            <p class="hero-desc">{{ Str::limit($hero['description'], 150) }}</p>
                            <div class="d-flex align-items-center mt-2" style="font-size: 0.85rem; opacity: 0.8;">
                                <span><i class="bi bi-building ms-1"></i> {{ $hero['source']['name'] ?? 'مصدر غير معروف' }}</span>
                                <span class="mx-3">|</span>
                                <span><i class="bi bi-clock ms-1"></i> {{ \Carbon\Carbon::parse($hero['publishedAt'])->locale('ar')->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Side news --}}
            <div class="col-lg-5">
                <div class="d-flex flex-column h-100">
                    @foreach(array_slice($headlines['articles'], 1, 4) as $article)
                        <a href="{{ route('article.show', ['url' => $article['url'], 'title' => $article['title']]) }}"
                           class="text-decoration-none">
                            <div class="side-news-item">
                                <img src="{{ $article['image'] ?? '' }}" alt="{{ $article['title'] }}"
                                     onerror="this.src='https://via.placeholder.com/120x90/1a1a2e/ffffff?text=خبر'">
                                <div>
                                    <h6 class="side-title">{{ $article['title'] }}</h6>
                                    <div class="side-meta">
                                        <span><i class="bi bi-building ms-1"></i> {{ $article['source']['name'] ?? '' }}</span>
                                        <span class="mx-2">|</span>
                                        <span><i class="bi bi-clock ms-1"></i> {{ \Carbon\Carbon::parse($article['publishedAt'])->locale('ar')->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Categories Section --}}
    <section class="mb-5">
        <div class="section-header">
            <div class="section-icon">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
            <h2>تصفح الأقسام</h2>
        </div>
        <div class="row g-3">
            @foreach($categories as $key => $cat)
                <div class="col-6 col-md-4 col-lg">
                    <a href="{{ route('category', $key) }}" class="category-card">
                        <div class="cat-icon"><i class="bi {{ $cat['icon'] }}"></i></div>
                        <div class="cat-name">{{ $cat['name'] }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Technology Section --}}
    @if(!empty($techNews['articles']))
        <section class="mb-5">
            <div class="section-header">
                <div class="section-icon">
                    <i class="bi bi-cpu"></i>
                </div>
                <h2>أخبار التكنولوجيا</h2>
                <a href="{{ route('category', 'technology') }}" class="view-all">
                    عرض المزيد <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            <div class="row g-4">
                @foreach(array_slice($techNews['articles'], 0, 4) as $article)
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('article.show', ['url' => $article['url'], 'title' => $article['title']]) }}"
                           class="text-decoration-none">
                            <div class="news-card">
                                <div class="img-wrapper">
                                    <img src="{{ $article['image'] ?? '' }}" class="card-img-top"
                                         alt="{{ $article['title'] }}"
                                         onerror="this.src='https://via.placeholder.com/400x220/667eea/ffffff?text=تكنولوجيا'">
                                    <span class="category-badge badge-accent">تكنولوجيا</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $article['title'] }}</h5>
                                    <p class="card-text">{{ Str::limit($article['description'], 100) }}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="source-info d-flex justify-content-between align-items-center">
                                        <span class="source-name">{{ $article['source']['name'] ?? '' }}</span>
                                        <span><i class="bi bi-clock ms-1"></i> {{ \Carbon\Carbon::parse($article['publishedAt'])->locale('ar')->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Sports & Business Row --}}
    <div class="row g-4 mb-5">
        {{-- Sports --}}
        @if(!empty($sportsNews['articles']))
            <div class="col-lg-6">
                <section>
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-trophy"></i>
                        </div>
                        <h2>أخبار الرياضة</h2>
                        <a href="{{ route('category', 'sports') }}" class="view-all">
                            المزيد <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>

                    @php $sportHero = $sportsNews['articles'][0]; @endphp
                    <a href="{{ route('article.show', ['url' => $sportHero['url'], 'title' => $sportHero['title']]) }}"
                       class="text-decoration-none d-block mb-3">
                        <div class="hero-card" style="min-height: 250px;">
                            <img src="{{ $sportHero['image'] ?? '' }}" alt="{{ $sportHero['title'] }}"
                                 onerror="this.src='https://via.placeholder.com/600x300/1a1a2e/ffffff?text=رياضة'">
                            <div class="hero-overlay">
                                <span class="badge-accent mb-2 d-inline-block">رياضة</span>
                                <h4 class="hero-title" style="font-size: 1.2rem;">{{ $sportHero['title'] }}</h4>
                            </div>
                        </div>
                    </a>

                    @foreach(array_slice($sportsNews['articles'], 1, 3) as $article)
                        <a href="{{ route('article.show', ['url' => $article['url'], 'title' => $article['title']]) }}"
                           class="text-decoration-none">
                            <div class="side-news-item">
                                <img src="{{ $article['image'] ?? '' }}" alt="{{ $article['title'] }}"
                                     onerror="this.src='https://via.placeholder.com/120x90/1a1a2e/ffffff?text=خبر'">
                                <div>
                                    <h6 class="side-title">{{ $article['title'] }}</h6>
                                    <div class="side-meta">
                                        <span>{{ $article['source']['name'] ?? '' }}</span>
                                        <span class="mx-2">|</span>
                                        <span>{{ \Carbon\Carbon::parse($article['publishedAt'])->locale('ar')->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </section>
            </div>
        @endif

        {{-- Business --}}
        @if(!empty($businessNews['articles']))
            <div class="col-lg-6">
                <section>
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <h2>أخبار الأعمال</h2>
                        <a href="{{ route('category', 'business') }}" class="view-all">
                            المزيد <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>

                    @php $bizHero = $businessNews['articles'][0]; @endphp
                    <a href="{{ route('article.show', ['url' => $bizHero['url'], 'title' => $bizHero['title']]) }}"
                       class="text-decoration-none d-block mb-3">
                        <div class="hero-card" style="min-height: 250px;">
                            <img src="{{ $bizHero['image'] ?? '' }}" alt="{{ $bizHero['title'] }}"
                                 onerror="this.src='https://via.placeholder.com/600x300/16213e/ffffff?text=أعمال'">
                            <div class="hero-overlay">
                                <span class="badge-accent mb-2 d-inline-block">أعمال</span>
                                <h4 class="hero-title" style="font-size: 1.2rem;">{{ $bizHero['title'] }}</h4>
                            </div>
                        </div>
                    </a>

                    @foreach(array_slice($businessNews['articles'], 1, 3) as $article)
                        <a href="{{ route('article.show', ['url' => $article['url'], 'title' => $article['title']]) }}"
                           class="text-decoration-none">
                            <div class="side-news-item">
                                <img src="{{ $article['image'] ?? '' }}" alt="{{ $article['title'] }}"
                                     onerror="this.src='https://via.placeholder.com/120x90/16213e/ffffff?text=خبر'">
                                <div>
                                    <h6 class="side-title">{{ $article['title'] }}</h6>
                                    <div class="side-meta">
                                        <span>{{ $article['source']['name'] ?? '' }}</span>
                                        <span class="mx-2">|</span>
                                        <span>{{ \Carbon\Carbon::parse($article['publishedAt'])->locale('ar')->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </section>
            </div>
        @endif
    </div>

    {{-- Remaining headlines --}}
    @if(!empty($headlines['articles']) && count($headlines['articles']) > 5)
        <section class="mb-5">
            <div class="section-header">
                <div class="section-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <h2>آخر الأخبار</h2>
            </div>
            <div class="row g-4">
                @foreach(array_slice($headlines['articles'], 5) as $article)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('article.show', ['url' => $article['url'], 'title' => $article['title']]) }}"
                           class="text-decoration-none">
                            <div class="news-card">
                                <div class="img-wrapper">
                                    <img src="{{ $article['image'] ?? '' }}" class="card-img-top"
                                         alt="{{ $article['title'] }}"
                                         onerror="this.src='https://via.placeholder.com/400x220/1a1a2e/ffffff?text=أخبار'">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $article['title'] }}</h5>
                                    <p class="card-text">{{ Str::limit($article['description'], 120) }}</p>
                                </div>
                                <div class="card-footer">
                                    <div class="source-info d-flex justify-content-between align-items-center">
                                        <span class="source-name">{{ $article['source']['name'] ?? '' }}</span>
                                        <span><i class="bi bi-clock ms-1"></i> {{ \Carbon\Carbon::parse($article['publishedAt'])->locale('ar')->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
