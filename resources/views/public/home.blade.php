@extends('layouts.app')

@section('title', __('messages.site_name'))

@section('content')

<!-- Hero Banner Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge bg-success-subtle text-success px-3 py-1.5 rounded-pill mb-3 fw-bold border border-success-subtle d-inline-flex align-items-center gap-1.5">
                    <i class="bi bi-geo-alt-fill text-success"></i>
                    {{ __('messages.district_name') }} • தமிழ்நாடு
                </span>
                <h1 class="hero-title">
                    {{ __('messages.hero_title') }}
                </h1>
                <p class="hero-subtitle">
                    {{ __('messages.hero_subtitle') }}
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('complaints.create') }}" class="btn btn-primary-civic btn-lg d-inline-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square"></i>
                        <span>{{ __('messages.btn_submit_now') }}</span>
                    </a>
                    <a href="{{ route('complaints.track') }}" class="btn btn-outline-civic btn-lg d-inline-flex align-items-center gap-2">
                        <i class="bi bi-search"></i>
                        <span>{{ __('messages.btn_track_now') }}</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-5">
                <!-- PM Modi Leadership Badge -->
                <div class="d-flex align-items-center gap-3 p-3 bg-white rounded-4 shadow-sm border mb-3">
                    <img src="{{ asset('assets/images/bjp/modi.png') }}" alt="PM Narendra Modi" style="height: 62px; width: auto; object-fit: contain; filter: drop-shadow(0 3px 6px rgba(0,0,0,0.12));">
                    <div class="lh-sm">
                        <div class="fw-bold text-dark small">நரேந்திர மோடி அவர்களின் வழிகாட்டுதலில்</div>
                        <small class="text-muted" style="font-size: 0.78rem;">தமிழ்நாட்டின் அனைத்து மாவட்ட மக்களின் தேவைகளுக்கான துரித தீர்வுத் தளம்</small>
                    </div>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-dark text-white p-3 border-0 d-flex align-items-center justify-content-between">
                        <span class="fw-bold"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>{{ __('messages.btn_track_now') }}</span>
                        <span class="badge bg-primary">Live Tracking</span>
                    </div>
                    <div class="card-body p-4 bg-white">
                        <form action="{{ route('complaints.track') }}" method="GET">
                            <div class="mb-3">
                                <label for="homeComplaintId" class="form-label small fw-bold">{{ __('messages.lbl_complaint_id') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-ticket-detailed"></i></span>
                                    <input type="text" name="complaint_id" id="homeComplaintId" class="form-control" placeholder="e.g. VNK-20261101-0012" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="homeMobile" class="form-label small fw-bold">{{ __('messages.lbl_registered_mobile') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-phone"></i></span>
                                    <input type="tel" name="mobile" id="homeMobile" class="form-control" placeholder="10-digit mobile number" pattern="[6-9][0-9]{9}" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary-civic w-100 fw-bold py-2">
                                <i class="bi bi-arrow-right-circle me-1"></i> {{ __('messages.btn_track') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Live Database Statistics Section -->
<section class="py-5 bg-white border-bottom">
    <div class="container">
        <div class="text-center mb-4">
            <span class="text-primary fw-bold text-uppercase small tracking-wide">Live Transparency / நேரடி புள்ளிவிவரங்கள்</span>
            <h2 class="fw-bold mt-1">Real-Time District Grievance Metrics</h2>
        </div>

        <div class="row g-3">
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card text-center">
                    <div class="stat-number">1,520+</div>
                    <div class="stat-label">{{ __('messages.stat_total') }}</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card text-center" style="border-top-color: #16a34a;">
                    <div class="stat-number text-success">1,385+</div>
                    <div class="stat-label">{{ __('messages.stat_resolved') }}</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card text-center" style="border-top-color: #2563eb;">
                    <div class="stat-number text-primary">142</div>
                    <div class="stat-label">{{ __('messages.stat_in_progress') }}</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card text-center" style="border-top-color: #0891b2;">
                    <div class="stat-number text-info">98</div>
                    <div class="stat-label">{{ __('messages.stat_referred') }}</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card text-center" style="border-top-color: #d97706;">
                    <div class="stat-number text-warning">309</div>
                    <div class="stat-label">{{ __('messages.stat_taluks') }}</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card text-center" style="border-top-color: #7c3aed;">
                    <div class="stat-number text-purple" style="color: #7c3aed;">18,478</div>
                    <div class="stat-label">{{ __('messages.stat_villages') }}</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Grievance Categories Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
            <div>
                <span class="text-primary fw-bold text-uppercase small">Civic Departments / துறைகள்</span>
                <h2 class="fw-bold mt-1">Grievance Service Categories</h2>
                <p class="text-muted mb-0">Select your issue category to register an actionable petition.</p>
            </div>
            <a href="{{ route('complaints.create') }}" class="btn btn-outline-civic mt-2 mt-md-0">
                Register Grievance <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($categories as $category)
                <div class="col-md-6 col-lg-4">
                    <div class="category-card">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="category-icon-box">
                                <i class="bi {{ $category->icon }}"></i>
                            </div>
                            <span class="badge bg-light text-secondary border small">SLA: {{ $category->sla_days }} Days</span>
                        </div>
                        <h4 class="category-title">{{ $category->name }}</h4>
                        <p class="category-desc">{{ $category->description }}</p>
                        <div class="category-dept">
                            <i class="bi bi-building me-1"></i> {{ $category->department_name }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Latest District Updates Section -->
<section class="py-5 bg-white border-top">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
            <div>
                <span class="text-primary fw-bold text-uppercase small">Civic News & Alerts / அறிவிப்புகள்</span>
                <h2 class="fw-bold mt-1">{{ __('messages.latest_news') }}</h2>
            </div>
            <a href="{{ route('updates') }}" class="btn btn-outline-secondary mt-2 mt-md-0">
                {{ __('messages.read_more') }} <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($updates as $update)
                <div class="col-md-4">
                    <div class="card h-100 border rounded-4 shadow-sm hover-shadow d-flex flex-column">
                        <div class="card-body p-4 flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1">{{ $update->category }}</span>
                                <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $update->published_at->format('d M Y') }}</small>
                            </div>
                            <h5 class="fw-bold text-dark mt-2 mb-2 lh-base">{{ $update->title }}</h5>
                            <p class="text-secondary small mb-0 lh-base">{{ Str::limit($update->content, 140) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 pt-0 pb-3 px-4 text-end">
                            <a href="{{ route('updates') }}" class="text-primary text-decoration-none small fw-semibold">
                                {{ __('messages.read_more') }} <i class="bi bi-arrow-right small"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">No recent updates published.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="py-5 bg-dark text-white text-center">
    <div class="container">
        <h3 class="fw-bold mb-2">Have an unresolved issue in your neighborhood?</h3>
        <p class="text-secondary mb-4 mx-auto" style="max-width: 650px;">
            Join hands with fellow citizens. Report water leaks, road potholes, streetlight outages, or garbage pileups directly for official coordination.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('complaints.create') }}" class="btn btn-primary-civic btn-lg">
                <i class="bi bi-plus-circle me-1"></i> {{ __('messages.btn_submit_now') }}
            </a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                <i class="bi bi-telephone me-1"></i> Contact Facilitation Cell
            </a>
        </div>
    </div>
</section>

@endsection
