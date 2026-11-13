@extends('layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'Virudhunagar Live News & Updates' : 'விருதுநகர் மாவட்ட நேரடி செய்திகள்') . ' - ' . __('messages.site_name'))

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.nav_updates') }}</li>
        </ol>
    </nav>

    <!-- Page Header & Live Pulse -->
    <div class="text-center mb-5">
        <div class="d-inline-flex align-items-center gap-2 bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 rounded-pill mb-3 fw-bold small shadow-xs">
            <span class="spinner-grow spinner-grow-sm text-danger" role="status" style="width: 10px; height: 10px;"></span>
            <span>{{ app()->getLocale() === 'en' ? 'LIVE VIRUDHUNAGAR NEWS FEED' : 'நேரடி செய்தி அலைவரிசை • LIVE UPDATES' }}</span>
        </div>
        <h1 class="fw-bold text-dark display-6 mb-2">
            {{ app()->getLocale() === 'en' ? 'Virudhunagar District News & Bulletins' : 'விருதுநகர் மாவட்ட செய்திகள் & அறிவிப்புகள்' }}
        </h1>
        <p class="text-muted fs-5 mx-auto" style="max-width: 720px;">
            @if(app()->getLocale() === 'en')
                Real-time civic alerts, agricultural updates, district administration notices, and local press reports from all across Virudhunagar District.
            @else
                விருதுநகர் மாவட்டத்தின் தினசரி முக்கிய நிகழ்வுகள், உழவர் நலம், குடிநீர் மற்றும் உட்கட்டமைப்பு மேம்பாட்டுப் பணிகள், மற்றும் பத்திரிகைச் செய்திகளின் நேரடித் தொகுப்பு.
            @endif
        </p>

        <!-- Search Bar & Refresh Trigger -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 col-lg-7">
                <form action="{{ route('updates') }}" method="GET" class="d-flex gap-2 align-items-center">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="input-group shadow-sm rounded-pill overflow-hidden border">
                        <span class="input-group-text bg-white border-0 ps-3 text-muted"><i class="bi bi-search"></i></span>
                        <input type="text" name="q" value="{{ request('q') }}" class="form-control border-0 ps-1 py-2" placeholder="{{ app()->getLocale() === 'en' ? 'Search Virudhunagar news by keywords...' : 'விருதுநகர் செய்திகளைத் தேடுக...' }}">
                        <button class="btn btn-primary px-4 fw-semibold" type="submit">{{ app()->getLocale() === 'en' ? 'Search' : 'தேடு' }}</button>
                    </div>
                    <a href="{{ route('updates', ['refresh' => 1]) }}" class="btn btn-light border shadow-sm rounded-pill text-nowrap px-3 py-2 text-dark" title="{{ app()->getLocale() === 'en' ? 'Fetch Latest News' : 'சமீபத்திய செய்திகளைப் புதுப்பி' }}">
                        <i class="bi bi-arrow-repeat text-primary me-1"></i>
                        <span class="d-none d-sm-inline">{{ app()->getLocale() === 'en' ? 'Refresh' : 'புதுப்பி' }}</span>
                    </a>
                </form>
            </div>
        </div>

        <!-- Category Filters -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mt-4">
            <a href="{{ route('updates', array_merge(request()->except('category', 'page'), ['category' => 'all'])) }}" 
               class="badge {{ !request('category') || request('category') === 'all' ? 'bg-primary text-white' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2 rounded-pill fw-semibold">
                {{ app()->getLocale() === 'en' ? 'All News' : 'அனைத்து செய்திகள்' }}
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('updates', array_merge(request()->except('category', 'page'), ['category' => $cat])) }}" 
                   class="badge {{ request('category') === $cat ? 'bg-primary text-white' : 'bg-light text-dark border' }} text-decoration-none px-3 py-2 rounded-pill fw-semibold">
                    @if($cat === 'Agriculture')
                        🌾 {{ app()->getLocale() === 'en' ? 'Agriculture' : 'விவசாயம் & உழவர்' }}
                    @elseif($cat === 'Infrastructure')
                        🚰 {{ app()->getLocale() === 'en' ? 'Infrastructure' : 'குடிநீர் & சாலை' }}
                    @elseif($cat === 'Civic Welfare')
                        🏛️ {{ app()->getLocale() === 'en' ? 'Civic Welfare' : 'மாவட்ட நிர்வாகம்' }}
                    @elseif($cat === 'Industry & Trade')
                        🏭 {{ app()->getLocale() === 'en' ? 'Industry & Trade' : 'வணிகம் & பட்டாசு' }}
                    @else
                        📰 {{ $cat }}
                    @endif
                </a>
            @endforeach
        </div>
    </div>

    <!-- News Grid -->
    <div class="row g-4">
        @forelse($updates as $update)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 rounded-4 shadow-sm hover-shadow d-flex flex-column bg-white overflow-hidden" style="transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    <div class="p-1" style="background: linear-gradient(90deg, #ff7722, #0284c7);"></div>
                    <div class="card-body p-4 flex-grow-1 d-flex flex-column">
                        <!-- Top Metadata: Category & Date -->
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-1">
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1 small fw-bold">
                                {{ $update->category }}
                            </span>
                            <span class="text-muted small d-inline-flex align-items-center gap-1" title="{{ $update->published_at->format('d M Y, h:i A') }}">
                                <i class="bi bi-clock-history"></i>
                                {{ $update->published_at->diffForHumans() }}
                            </span>
                        </div>

                        <!-- Headline -->
                        <h5 class="fw-bold text-dark mb-3 lh-sm" style="font-size: 1.05rem;">
                            {{ $update->title }}
                        </h5>

                        <!-- Excerpt/Content -->
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.55;">
                            {{ Str::limit($update->content, 160) }}
                        </p>

                        <!-- Source Badge & Link -->
                        <div class="pt-3 border-top mt-auto d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-secondary border small px-2.5 py-1.5" title="News Source">
                                <i class="bi bi-newspaper text-danger me-1"></i>
                                <strong>{{ $update->source_name ?: 'Daily News' }}</strong>
                            </span>

                            @if(!empty($update->source_url))
                                <a href="{{ $update->source_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-1 fw-semibold d-inline-flex align-items-center gap-1" style="font-size: 0.78rem;">
                                    <span>{{ app()->getLocale() === 'en' ? 'Full Story' : 'முழு செய்தி' }}</span>
                                    <i class="bi bi-arrow-up-right small"></i>
                                </a>
                            @else
                                <span class="badge bg-success-subtle text-success border border-success-subtle small px-2 py-1">
                                    <i class="bi bi-check2-circle me-1"></i> Verified
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="py-5">
                    <i class="bi bi-newspaper display-4 text-muted mb-3 d-block"></i>
                    <h5 class="fw-bold text-dark">{{ app()->getLocale() === 'en' ? 'No News Found' : 'செய்திகள் எதுவும் கிடைக்கவில்லை' }}</h5>
                    <p class="text-muted small">{{ app()->getLocale() === 'en' ? 'Try refreshing the live feed or clearing filters.' : 'நேரடி ஃபீடைப் புதுப்பிக்கவும் அல்லது தேடல் சொல்லை மாற்றவும்.' }}</p>
                    <a href="{{ route('updates', ['refresh' => 1]) }}" class="btn btn-primary rounded-pill px-4 py-2 mt-2">
                        <i class="bi bi-arrow-repeat me-1"></i> {{ app()->getLocale() === 'en' ? 'Fetch Latest News Now' : 'இப்போதே செய்திகளைப் புதுப்பி' }}
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-5 d-flex justify-content-center">
        {{ $updates->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
