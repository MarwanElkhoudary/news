@extends('layouts.app')

@section('title', $title . ' - أخبار اليوم')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none" style="color: var(--accent-color);">الرئيسية</a></li>
                    <li class="breadcrumb-item active">المقال</li>
                </ol>
            </nav>

            {{-- Article card --}}
            <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    <h1 class="fw-bold mb-4" style="font-size: 1.8rem; line-height: 2; color: var(--primary-color);">
                        {{ $title }}
                    </h1>

                    <div class="alert border-0 rounded-3 p-4 mb-4" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill fs-4 ms-3" style="color: var(--accent-color);"></i>
                            <div>
                                <p class="mb-1 fw-bold">المقال الكامل متاح في المصدر الأصلي</p>
                                <p class="mb-0 text-muted small">نحن نحترم حقوق الملكية الفكرية ونوجهك للمصدر الأصلي لقراءة المقال كاملاً</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center py-4">
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
                           class="btn btn-lg rounded-pill px-5 py-3 fw-bold text-white"
                           style="background: var(--gradient-accent); font-size: 1.1rem;">
                            <i class="bi bi-box-arrow-up-left ms-2"></i>
                            قراءة المقال الكامل من المصدر
                        </a>
                    </div>

                    <hr class="my-4">

                    {{-- Share buttons --}}
                    <div class="text-center">
                        <h6 class="text-muted mb-3">مشاركة المقال</h6>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($title) }}&url={{ urlencode($url) }}"
                               target="_blank" class="btn btn-outline-dark rounded-pill px-3">
                                <i class="bi bi-twitter-x"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}"
                               target="_blank" class="btn btn-outline-primary rounded-pill px-3">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($title . ' ' . $url) }}"
                               target="_blank" class="btn btn-outline-success rounded-pill px-3">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="https://t.me/share/url?url={{ urlencode($url) }}&text={{ urlencode($title) }}"
                               target="_blank" class="btn btn-outline-info rounded-pill px-3">
                                <i class="bi bi-telegram"></i>
                            </a>
                            <button onclick="navigator.clipboard.writeText('{{ $url }}').then(() => alert('تم نسخ الرابط!'))"
                                    class="btn btn-outline-secondary rounded-pill px-3">
                                <i class="bi bi-link-45deg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Back button --}}
            <div class="text-center mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-dark rounded-pill px-4">
                    <i class="bi bi-arrow-right ms-1"></i> العودة
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-dark rounded-pill px-4 me-2">
                    <i class="bi bi-house ms-1"></i> الرئيسية
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
