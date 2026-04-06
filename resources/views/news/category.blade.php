@extends('layouts.app')

@section('title', $categoryName . ' - أخبار اليوم')

@section('content')
<div class="container">

    {{-- Category Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="p-4 rounded-4 text-white position-relative overflow-hidden" style="background: var(--gradient-primary);">
                <div class="position-relative" style="z-index: 2;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-2" style="font-size: 0.85rem;">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">الرئيسية</a></li>
                            <li class="breadcrumb-item active text-white">{{ $categoryName }}</li>
                        </ol>
                    </nav>
                    <h1 class="fw-bold mb-1">
                        <i class="bi {{ $categoryIcon }} ms-2"></i>
                        أخبار {{ $categoryName }}
                    </h1>
                    <p class="mb-0 opacity-75">آخر الأخبار والمستجدات في قسم {{ $categoryName }}</p>
                </div>
                <div class="position-absolute" style="left: -20px; top: -20px; font-size: 8rem; opacity: 0.05; z-index: 1;">
                    <i class="bi {{ $categoryIcon }}"></i>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($news['articles']))
        {{-- Featured article --}}
        @php $featured = $news['articles'][0]; @endphp
        <div class="row g-4 mb-5">
            <div class="col-lg-8">
                <a href="{{ route('article.show', ['url' => $featured['url'], 'title' => $featured['title']]) }}"
                   class="text-decoration-none">
                    <div class="hero-card" style="min-height: 400px;">
                        <img src="{{ $featured['image'] ?? '' }}" alt="{{ $featured['title'] }}"
                             onerror="this.src='https://via.placeholder.com/800x400/1a1a2e/ffffff?text={{ $categoryName }}'">
                        <div class="hero-overlay">
                            <span class="badge-accent mb-3 d-inline-block">{{ $categoryName }}</span>
                            <h2 class="hero-title">{{ $featured['title'] }}</h2>
                            <p class="hero-desc">{{ Str::limit($featured['description'], 200) }}</p>
                            <div class="d-flex align-items-center mt-2" style="font-size: 0.85rem; opacity: 0.8;">
                                <span><i class="bi bi-building ms-1"></i> {{ $featured['source']['name'] ?? '' }}</span>
                                <span class="mx-3">|</span>
                                <span><i class="bi bi-clock ms-1"></i> {{ \Carbon\Carbon::parse($featured['publishedAt'])->locale('ar')->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                @foreach(array_slice($news['articles'], 1, 4) as $article)
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
            </div>
        </div>

        {{-- Remaining articles --}}
        @if(count($news['articles']) > 5)
            <div class="section-header">
                <div class="section-icon">
                    <i class="bi {{ $categoryIcon }}"></i>
                </div>
                <h2>المزيد من أخبار {{ $categoryName }}</h2>
            </div>
            <div class="row g-4">
                @foreach(array_slice($news['articles'], 5) as $article)
                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('article.show', ['url' => $article['url'], 'title' => $article['title']]) }}"
                           class="text-decoration-none">
                            <div class="news-card">
                                <div class="img-wrapper">
                                    <img src="{{ $article['image'] ?? '' }}" class="card-img-top"
                                         alt="{{ $article['title'] }}"
                                         onerror="this.src='https://via.placeholder.com/400x220/1a1a2e/ffffff?text={{ $categoryName }}'">
                                    <span class="category-badge badge-accent">{{ $categoryName }}</span>
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
        @endif
    @else
        <div class="text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
            <h4 class="text-muted">لا توجد أخبار متاحة حالياً في هذا القسم</h4>
            <a href="{{ route('home') }}" class="btn btn-outline-dark mt-3 rounded-pill px-4">
                <i class="bi bi-arrow-right ms-1"></i> العودة للرئيسية
            </a>
        </div>
    @endif
</div>
@endsection
