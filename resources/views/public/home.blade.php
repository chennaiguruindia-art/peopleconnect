@extends('layouts.app')

@section('title', 'Public Grievance Management Platform - குரலற்ற மக்களின் குரல்')

@section('content')

<!-- 1. HERO SECTION -->
<section class="hero-section py-4 py-lg-5 bg-white position-relative overflow-hidden">
    <div class="container">
        <div class="row align-items-center g-4 g-lg-5">
            <!-- Left Column: Big Catchy Title & CTAs -->
            <div class="col-lg-6">
                <h1 class="hero-people-heading mb-3">
                    <span class="d-block text-navy">உங்கள் குரல்.</span>
                    <span class="d-block text-navy">உங்கள் பகுதி.</span>
                    <span class="d-block text-orange">உங்கள் இணைப்பு.</span>
                </h1>
                
                <div class="hero-quote-bar border-start border-4 border-warning ps-3 my-3 my-md-4">
                    <p class="hero-desc-text text-secondary mb-0 fw-medium">
                        உங்கள் பகுதியில் உள்ள பொதுப் பிரச்சனைகளைப் பதிவு செய்து, அதன் நடவடிக்கை நிலையை பாதுகாப்பாகக் கண்காணியுங்கள்.
                    </p>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-2 gap-sm-3 mt-4">
                    <a href="{{ route('complaints.create') }}" class="btn btn-hero-orange rounded-pill px-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                        <i class="bi bi-pencil-fill"></i>
                        <span>புகாரைப் பதிவு செய்யுங்கள்</span>
                    </a>
                    <a href="{{ route('complaints.track') }}" class="btn btn-hero-outline rounded-pill px-4 py-2.5 fw-bold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-search"></i>
                        <span>புகார் நிலையை அறியுங்கள்</span>
                    </a>
                </div>
            </div>

            <!-- Right Column: User's Banner Image (banner1.png) -->
            <div class="col-lg-6 text-center">
                <div class="hero-banner-frame position-relative d-inline-block">
                    <img src="{{ asset('assets/images/banner/banner1.png') }}?v={{ time() }}" alt="Public Grievance Management Platform" class="img-fluid rounded-4 shadow-sm hero-banner-image">
                </div>
            </div>
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
