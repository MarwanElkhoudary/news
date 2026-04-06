@extends('layouts.app')

@section('title', $query ? 'نتائج البحث: ' . $query : 'البحث - أخبار اليوم')

@section('content')
<div class="container">

    {{-- Search Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="p-4 rounded-4 text-white position-relative overflow-hidden" style="background: var(--gradient-primary);">
                <h1 class="fw-bold mb-3">
                    <i class="bi bi-search ms-2"></i> البحث في الأخبار
                </h1>
                <form action="{{ route('search') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="q" class="form-control form-control-lg rounded-pill"
                           placeholder="اكتب كلمة البحث..."
                           value="{{ $query }}"
                           style="max-width: 500px;">
                    <button type="submit" class="btn btn-lg rounded-pill px-4" style="background: var(--accent-color); color: white;">
                        <i class="bi bi-search ms-1"></i> بحث
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if($query)
        <div class="mb-4">
            <h5 class="text-muted">
                نتائج البحث عن: <strong class="text-dark">"{{ $query }}"</strong>
                <span class="badge bg-secondary rounded-pill ms-2">{{ $results['totalArticles'] ?? 0 }} نتيجة</span>
            </h5>
        </div>

        @if(!empty($results['articles']))
            <div class="row g-4">
                @foreach($results['articles'] as $article)
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
        @else
            <div class="text-center py-5">
                <i class="bi bi-search fs-1 text-muted d-block mb-3"></i>
                <h4 class="text-muted">لم يتم العثور على نتائج لـ "{{ $query }}"</h4>
                <p class="text-muted">جرب كلمات بحث مختلفة</p>
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <i class="bi bi-search fs-1 text-muted d-block mb-3" style="font-size: 4rem !important;"></i>
            <h4 class="text-muted">اكتب كلمة للبحث في الأخبار</h4>
        </div>
    @endif
</div>
@endsection
