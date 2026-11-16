@extends('layouts.app')

@section('title', 'Public Grievance Management Platform - குரலற்ற மக்களின் குரல்')

@section('content')

<!-- 1. HERO SECTION -->
<!-- A. DESKTOP PANORAMIC CURVED HERO (d-none d-lg-block) -->
<section class="hero-curved-banner position-relative overflow-hidden w-100 border-bottom d-none d-lg-block">
    <!-- Background Image on Right (Using existing banner1.png with proper positioning) -->
    <div class="banner-photo-bg" style="background-image: url('{{ asset('assets/images/banner/banner.jpg') }}');"></div>

    <!-- Curved SVG Panel on Left (Desktop & Tablet) -->
    <svg class="banner-curve-svg" viewBox="0 0 1000 560" preserveAspectRatio="none">
        <path d="M 0,0 L 440,0 C 495,30 475,300 565,560 L 0,560 Z" fill="#ffffff" />
        <path d="M 440,0 C 495,30 475,300 565,560" fill="none" stroke="#ea580c" stroke-width="7" stroke-linecap="round" />
    </svg>

    <!-- Desktop Banner Text Content -->
    <div class="container-fluid px-3 px-md-4 px-xl-5 position-relative z-2 h-100">
        <div class="row align-items-center h-100">
            <div class="col-lg-5 col-xl-5 py-4 py-lg-5 ps-2 ps-md-4 ps-lg-5">
                <div class="hero-text-wrapper" style="max-width: 440px;">
                    <h1 class="hero-people-heading mb-2 mb-md-3 notranslate" translate="no">
                        @if(app()->getLocale() === 'en')
                            <span class="d-block text-navy">Your Voice.</span>
                            <span class="d-block text-navy">Your Community.</span>
                            <span class="d-block text-orange">Your Connection.</span>
                        @else
                            <span class="d-block text-navy">உங்கள் குரல்.</span>
                            <span class="d-block text-navy">உங்கள் பகுதி.</span>
                            <span class="d-block text-orange">உங்கள் இணைப்பு.</span>
                        @endif
                    </h1>
                    
                    <div class="hero-quote-bar border-start border-4 border-warning ps-3 my-3 my-md-4 notranslate" translate="no">
                        <p class="hero-desc-text text-secondary mb-0 fw-medium">
                            @if(app()->getLocale() === 'en')
                                Register public issues in your area and securely track administrative action in real-time.
                            @else
                                உங்கள் பகுதியில் உள்ள பொதுப் பிரச்சனைகளைப் பதிவு செய்து, அதன் நடவடிக்கை நிலையை பாதுகாப்பாகக் கண்காணியுங்கள்.
                            @endif
                        </p>
                    </div>

                    <div class="d-flex flex-wrap align-items-center gap-2 gap-sm-3 mt-4 notranslate" translate="no">
                        <a href="{{ route('complaints.create') }}" class="btn btn-hero-orange rounded-pill px-3.5 px-md-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center gap-2 text-nowrap">
                            <i class="bi bi-pencil-fill"></i>
                            <span>{{ app()->getLocale() === 'en' ? 'Submit Grievance' : 'புகாரைப் பதிவு செய்யுங்கள்' }}</span>
                        </a>
                        <a href="{{ route('complaints.track') }}" class="btn btn-hero-outline rounded-pill px-3.5 px-md-4 py-2.5 fw-bold d-inline-flex align-items-center gap-2 text-nowrap">
                            <i class="bi bi-search"></i>
                            <span>{{ app()->getLocale() === 'en' ? 'Track Grievance' : 'புகார் நிலையை அறியுங்கள்' }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- B. MOBILE DEDICATED HERO (d-lg-none) — Vibrant People Photo + Curved Wave + Bold Content -->
<section class="mobile-hero-section d-lg-none bg-white border-bottom pb-4">
    <!-- 1. Mobile People Photo with Curved Accent Wave Bottom -->
    <div class="mobile-hero-photo-wrapper position-relative overflow-hidden">
        <img src="{{ asset('assets/images/banner/banner.png') }}" 
             alt="Public Grievance Platform - People" 
             class="img-fluid w-100 mobile-hero-photo">
        
        <!-- Curved Wave at the bottom of the photo -->
        <svg class="mobile-photo-curve position-absolute bottom-0 start-0 w-100" viewBox="0 0 500 36" preserveAspectRatio="none" style="height: 26px; z-index: 2;">
            <path d="M 0,36 Q 250,0 500,36 L 500,36 L 0,36 Z" fill="#ffffff" />
            <path d="M 0,34 Q 250,-2 500,34" fill="none" stroke="#ea580c" stroke-width="4" />
        </svg>
    </div>

    <!-- 2. Mobile Hero Content Below Photo -->
    <div class="container px-3 pt-2">
        <h1 class="hero-people-heading-mobile mb-2 notranslate" translate="no">
            @if(app()->getLocale() === 'en')
                <span class="d-block text-navy">Your Voice.</span>
                <span class="d-block text-navy">Your Community.</span>
                <span class="d-block text-orange">Your Connection.</span>
            @else
                <span class="d-block text-navy">உங்கள் குரல்.</span>
                <span class="d-block text-navy">உங்கள் பகுதி.</span>
                <span class="d-block text-orange">உங்கள் இணைப்பு.</span>
            @endif
        </h1>

        <div class="hero-quote-bar-mobile border-start border-4 border-warning ps-3 my-3 notranslate" translate="no">
            <p class="text-secondary mb-0 fw-medium" style="font-size: 0.92rem; line-height: 1.55;">
                @if(app()->getLocale() === 'en')
                    Register public issues in your area and securely track administrative action in real-time.
                @else
                    உங்கள் பகுதியில் உள்ள பொதுப் பிரச்சனைகளைப் பதிவு செய்து, அதன் நடவடிக்கை நிலையை பாதுகாப்பாகக் கண்காணியுங்கள்.
                @endif
            </p>
        </div>

        <!-- Touch-Friendly Full-Width Action Buttons -->
        <div class="d-flex flex-column gap-2 mt-3 notranslate" translate="no">
            <a href="{{ route('complaints.create') }}" class="btn btn-hero-orange rounded-pill py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-pencil-fill"></i>
                <span>{{ app()->getLocale() === 'en' ? 'Submit Grievance' : 'புகாரைப் பதிவு செய்யுங்கள்' }}</span>
            </a>
            <a href="{{ route('complaints.track') }}" class="btn btn-hero-outline rounded-pill py-2.5 fw-bold d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-search"></i>
                <span>{{ app()->getLocale() === 'en' ? 'Track Grievance' : 'புகார் நிலையை அறியுங்கள்' }}</span>
            </a>
        </div>
    </div>
</section>

<!-- 2. REAL-TIME DISTRICT GRIEVANCE METRICS (Image 4 Mockup - Exact Static Values) -->
<section class="py-5 bg-light border-top border-bottom">
    <div class="container">
        <div class="text-center mb-4">
            <div class="text-primary fw-bold text-uppercase small tracking-wide mb-1" style="letter-spacing: 1px;">
                LIVE TRANSPARENCY / நேரடி புள்ளிவிவரங்கள்
            </div>
            <h2 class="fw-extrabold text-navy mb-0 fs-2 fs-md-1">
                Real-Time District Grievance Metrics
            </h2>
        </div>

        <div class="row g-3 justify-content-center">
            <!-- 1. மொத்த கோரிக்கைகள் -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-center p-3 p-md-4 bg-white rounded-4 border shadow-xs h-100" style="border-top: 4px solid #ea580c !important;">
                    <div class="stat-number fw-extrabold" style="font-size: 2.15rem; color: #ea580c; line-height: 1.1;">
                        1,520+
                    </div>
                    <div class="stat-label small fw-semibold text-secondary mt-2" style="font-size: 0.85rem; line-height: 1.35;">
                        மொத்த<br>கோரிக்கைகள்
                    </div>
                </div>
            </div>

            <!-- 2. தீர்வு காணப்பட்டவை -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-center p-3 p-md-4 bg-white rounded-4 border shadow-xs h-100" style="border-top: 4px solid #16a34a !important;">
                    <div class="stat-number fw-extrabold text-success" style="font-size: 2.15rem; line-height: 1.1;">
                        1,385+
                    </div>
                    <div class="stat-label small fw-semibold text-secondary mt-2" style="font-size: 0.85rem; line-height: 1.35;">
                        தீர்வு<br>காணப்பட்டவை
                    </div>
                </div>
            </div>

            <!-- 3. நடவடிக்கையில் உள்ளவை -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-center p-3 p-md-4 bg-white rounded-4 border shadow-xs h-100" style="border-top: 4px solid #2563eb !important;">
                    <div class="stat-number fw-extrabold text-primary" style="font-size: 2.15rem; line-height: 1.1;">
                        142
                    </div>
                    <div class="stat-label small fw-semibold text-secondary mt-2" style="font-size: 0.85rem; line-height: 1.35;">
                        நடவடிக்கையில்<br>உள்ளவை
                    </div>
                </div>
            </div>

            <!-- 4. துறைக்கு பரிந்துரைக்கப்பட்டவை -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-center p-3 p-md-4 bg-white rounded-4 border shadow-xs h-100" style="border-top: 4px solid #0891b2 !important;">
                    <div class="stat-number fw-extrabold" style="font-size: 2.15rem; color: #0891b2; line-height: 1.1;">
                        98
                    </div>
                    <div class="stat-label small fw-semibold text-secondary mt-2" style="font-size: 0.85rem; line-height: 1.35;">
                        துறைக்கு<br>பரிந்துரைக்கப்பட்டவை
                    </div>
                </div>
            </div>

            <!-- 5. வருவாய் வட்டங்கள் (தாலுகாக்கள்) -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-center p-3 p-md-4 bg-white rounded-4 border shadow-xs h-100" style="border-top: 4px solid #d97706 !important;">
                    <div class="stat-number fw-extrabold" style="font-size: 2.15rem; color: #d97706; line-height: 1.1;">
                        309
                    </div>
                    <div class="stat-label small fw-semibold text-secondary mt-2" style="font-size: 0.85rem; line-height: 1.35;">
                        வருவாய் வட்டங்கள்<br>(தாலுகாக்கள்)
                    </div>
                </div>
            </div>

            <!-- 6. வருவாய் கிராமங்கள் -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card text-center p-3 p-md-4 bg-white rounded-4 border shadow-xs h-100" style="border-top: 4px solid #7c3aed !important;">
                    <div class="stat-number fw-extrabold" style="font-size: 2.15rem; color: #7c3aed; line-height: 1.1;">
                        18,478
                    </div>
                    <div class="stat-label small fw-semibold text-secondary mt-2" style="font-size: 0.85rem; line-height: 1.35;">
                        வருவாய்<br>கிராமங்கள்
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. "எந்தப் பிரச்சினையைப் பதிவு செய்ய விரும்புகிறீர்கள்?" (CATEGORY GRID) -->
<section class="py-5 bg-white">
    <div class="container">
        <h3 class="fw-bold text-dark text-center mb-4 fs-3">எந்தப் பிரச்சினையைப் பதிவு செய்ய விரும்புகிறீர்கள்?</h3>

        <div class="row g-3 justify-content-center">
            <!-- 1. சாலை வசதி -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('complaints.create') }}" class="card text-center p-3 border-0 rounded-4 shadow-xs hover-lift text-decoration-none h-100" style="background-color: #f1f5f9;">
                    <div class="category-icon-round mx-auto mb-2 d-flex align-items-center justify-content-center text-dark" style="width: 50px; height: 50px; font-size: 26px;">
                        <i class="bi bi-signpost-2-fill"></i>
                    </div>
                    <div class="fw-bold text-dark small">சாலை வசதி</div>
                </a>
            </div>

            <!-- 2. குடிநீர் -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('complaints.create') }}" class="card text-center p-3 border-0 rounded-4 shadow-xs hover-lift text-decoration-none h-100" style="background-color: #eff6ff;">
                    <div class="category-icon-round mx-auto mb-2 d-flex align-items-center justify-content-center text-primary" style="width: 50px; height: 50px; font-size: 26px;">
                        <i class="bi bi-droplet-fill"></i>
                    </div>
                    <div class="fw-bold text-dark small">குடிநீர்</div>
                </a>
            </div>

            <!-- 3. மின்சாரம் -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('complaints.create') }}" class="card text-center p-3 border-0 rounded-4 shadow-xs hover-lift text-decoration-none h-100" style="background-color: #fefce8;">
                    <div class="category-icon-round mx-auto mb-2 d-flex align-items-center justify-content-center text-warning" style="width: 50px; height: 50px; font-size: 26px;">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <div class="fw-bold text-dark small">மின்சாரம்</div>
                </a>
            </div>

            <!-- 4. சுகாதாரம் -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('complaints.create') }}" class="card text-center p-3 border-0 rounded-4 shadow-xs hover-lift text-decoration-none h-100" style="background-color: #f0fdf4;">
                    <div class="category-icon-round mx-auto mb-2 d-flex align-items-center justify-content-center text-success" style="width: 50px; height: 50px; font-size: 26px;">
                        <i class="bi bi-trash3-fill"></i>
                    </div>
                    <div class="fw-bold text-dark small">சுகாதாரம்</div>
                </a>
            </div>

            <!-- 5. கல்வி -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('complaints.create') }}" class="card text-center p-3 border-0 rounded-4 shadow-xs hover-lift text-decoration-none h-100" style="background-color: #faf5ff;">
                    <div class="category-icon-round mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; font-size: 26px; color: #8b5cf6;">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div class="fw-bold text-dark small">கல்வி</div>
                </a>
            </div>

            <!-- 6. மருத்துவம் -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="{{ route('complaints.create') }}" class="card text-center p-3 border-0 rounded-4 shadow-xs hover-lift text-decoration-none h-100" style="background-color: #fff1f2;">
                    <div class="category-icon-round mx-auto mb-2 d-flex align-items-center justify-content-center text-danger" style="width: 50px; height: 50px; font-size: 26px;">
                        <i class="bi bi-hospital-fill"></i>
                    </div>
                    <div class="fw-bold text-dark small">மருத்துவம்</div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 4. "புகார் பதிவு முதல் நடவடிக்கை வரை — எளிய செயல்முறை" (PROCESS STEPS) -->
<section class="py-5 bg-light border-top border-bottom">
    <div class="container">
        <!-- Divider Heading -->
        <div class="text-center mb-5 position-relative">
            <h4 class="fw-bold text-dark mb-0 d-inline-block bg-light px-3 position-relative z-1" style="font-size: 1.15rem; letter-spacing: 0.3px;">
                — புகார் பதிவு முதல் நடவடிக்கை வரை — எளிய செயல்முறை —
            </h4>
            <div class="position-absolute top-50 start-0 end-0 border-top border-2 border-warning opacity-75 z-0" style="transform: translateY(-50%);"></div>
        </div>

        <div class="row g-4 justify-content-center align-items-center text-center">
            <!-- Step 1 -->
            <div class="col-6 col-md-3">
                <div class="step-card">
                    <div class="step-circle-icon mx-auto mb-3 text-white rounded-circle d-flex align-items-center justify-content-center shadow-xs" style="width: 60px; height: 60px; background: #ea580c; font-size: 24px;">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1 fs-6">1. புகார் பதிவு</h5>
                    <small class="text-muted d-block">உங்கள் பிரச்சினையை பதிவு செய்யுங்கள்</small>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="col-6 col-md-3">
                <div class="step-card">
                    <div class="step-circle-icon mx-auto mb-3 text-white rounded-circle d-flex align-items-center justify-content-center shadow-xs" style="width: 60px; height: 60px; background: #0284c7; font-size: 24px;">
                        <i class="bi bi-search"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1 fs-6">2. சரிபார்ப்பு</h5>
                    <small class="text-muted d-block">புகார் விவரங்கள் சரிபார்க்கப்படும்</small>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="col-6 col-md-3">
                <div class="step-card">
                    <div class="step-circle-icon mx-auto mb-3 text-white rounded-circle d-flex align-items-center justify-content-center shadow-xs" style="width: 60px; height: 60px; background: #16a34a; font-size: 24px;">
                        <i class="bi bi-bank2"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1 fs-6">3. அரசுத் துறைக்கு அனுப்புதல்</h5>
                    <small class="text-muted d-block">சம்பந்தப்பட்ட அரசு துறைக்கு புகார் அனுப்பப்படும்</small>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="col-6 col-md-3">
                <div class="step-card">
                    <div class="step-circle-icon mx-auto mb-3 text-white rounded-circle d-flex align-items-center justify-content-center shadow-xs" style="width: 60px; height: 60px; background: #7c3aed; font-size: 24px;">
                        <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1 fs-6">4. நடவடிக்கை கண்காணிப்பு</h5>
                    <small class="text-muted d-block">புகாரின் நடவடிக்கை நிலையை நீங்கள் அறியலாம்</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4.5. LATEST UPDATES & CIVIC NEWS (/updates) -->
<section class="py-5 bg-white border-top">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
            <div>
                <span class="text-primary fw-bold text-uppercase small" style="letter-spacing: 0.5px;">CIVIC NEWS & ALERTS / அறிவிப்புகள்</span>
                <h3 class="fw-bold text-navy mt-1 mb-0 fs-3">{{ __('messages.latest_news') }}</h3>
            </div>
            <a href="{{ route('updates') }}" class="btn btn-outline-secondary rounded-pill px-3.5 py-1.5 fw-semibold mt-2 mt-md-0 d-inline-flex align-items-center gap-1.5">
                <span>{{ __('messages.read_more') }}</span>
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @forelse($updates as $update)
                <div class="col-md-4">
                    <div class="card h-100 border rounded-4 shadow-xs hover-lift d-flex flex-column">
                        <div class="card-body p-4 flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1 rounded-pill">{{ $update->category }}</span>
                                <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ $update->published_at ? $update->published_at->format('d M Y') : date('d M Y') }}</small>
                            </div>
                            <h5 class="fw-bold text-dark mt-2 mb-2 lh-base fs-6">{{ $update->title }}</h5>
                            <p class="text-secondary small mb-0 lh-base">{{ Str::limit($update->content, 130) }}</p>
                        </div>
                        <div class="card-footer bg-transparent border-top-0 pt-0 pb-3 px-4 text-end">
                            <a href="{{ route('updates') }}" class="text-primary text-decoration-none small fw-semibold">
                                {{ __('messages.read_more') }} <i class="bi bi-arrow-right small"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-4">
                    <i class="bi bi-newspaper fs-1 text-secondary opacity-50 d-block mb-2"></i>
                    <span>செய்திகள் எதுவும் தற்போது பதிவேற்றப்படவில்லை.</span>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- 5. "உங்கள் புகாரின் நிலையை அறியுங்கள் | Track Your Complaint" (NAVY BAR) -->
<section class="py-4 bg-white">
    <div class="container">
        <div class="track-banner-dark p-3 p-md-4 rounded-4 shadow-sm" style="background-color: #0b1f3a;">
            <div class="row align-items-center g-3">
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-search text-warning fs-2 flex-shrink-0"></i>
                        <div>
                            <h4 class="fw-bold text-white mb-0 fs-5">உங்கள் புகாரின் நிலையை அறியுங்கள்</h4>
                            <small class="text-white-50">Track Your Complaint</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form action="{{ route('complaints.track') }}" method="GET" class="d-flex flex-column flex-sm-row gap-2">
                        <input type="text" name="complaint_id" class="form-control rounded-pill px-3 py-2 border-0" placeholder="Complaint ID-ஐ உள்ளிடுங்கள் (e.g. VNK-20261101-0012)" required>
                        <button type="submit" class="btn btn-warning rounded-pill px-4 py-2 fw-bold text-white text-nowrap d-inline-flex align-items-center justify-content-center gap-1 shadow-sm">
                            <span>நிலையைப் பார்க்கவும்</span>
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. SECURITY & TRUST BANNER -->
<section class="pb-5 bg-white">
    <div class="container">
        <div class="p-3 rounded-4 d-flex align-items-center justify-content-center gap-2 text-center" style="background-color: #f0f9ff; border: 1px solid #bae6fd; color: #0284c7;">
            <i class="bi bi-shield-lock-fill fs-4 flex-shrink-0"></i>
            <span class="fw-semibold small">உங்கள் தனிப்பட்ட தகவல்கள் உங்களுக்கும் அங்கீகரிக்கப்பட்ட நிர்வாகிகளுக்கும் மட்டுமே அணுகக்கூடியவை.</span>
        </div>
    </div>
</section>

@endsection
