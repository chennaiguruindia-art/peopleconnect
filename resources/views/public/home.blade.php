@extends('layouts.app')

@section('title', 'The People Connect - குரலற்ற மக்களின் குரல்')

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
                    <img src="{{ asset('assets/images/banner/banner1.png') }}?v={{ time() }}" alt="The People Connect - Citizen Grievance Portal" class="img-fluid rounded-4 shadow-sm hero-banner-img">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. QUICK COMPLAINT INTAKE CARD ("மக்கள் குறை பதிவு" / Register Your Complaint) -->
<section class="quick-intake-section py-3 py-md-4 bg-light">
    <div class="container">
        <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white intake-card">
            <!-- Header -->
            <div class="d-flex align-items-center gap-3 mb-4 pb-2 border-bottom">
                <div class="intake-icon-badge rounded-3 d-inline-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 46px; height: 46px; background: linear-gradient(135deg, #ff7722, #ea580c);">
                    <i class="bi bi-pencil-square fs-4"></i>
                </div>
                <div>
                    <h3 class="fw-bold text-dark mb-0 fs-5 fs-md-4">மக்கள் குறை பதிவு</h3>
                    <small class="text-muted fw-semibold">Register Your Complaint</small>
                </div>
            </div>

            <form action="{{ route('complaints.create') }}" method="GET" id="quickIntakeForm">
                <!-- Row 1: 3 Dropdown Fields -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label for="quickDistrict" class="form-label small fw-bold text-dark">
                            மாவட்டம் தேர்வு <span class="text-danger">*</span>
                        </label>
                        <select name="district_id" id="quickDistrict" class="form-select select-civic" required>
                            <option value="">மாவட்டத்தை தேர்வு செய்யவும்</option>
                            @foreach($districts as $d)
                                <option value="{{ $d->id }}" {{ $d->name_en === 'Virudhunagar' ? 'selected' : '' }}>
                                    {{ app()->getLocale() === 'ta' ? ($d->name_ta ?? $d->name_en) : $d->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="quickTaluk" class="form-label small fw-bold text-dark">
                            சட்டமன்றத் தொகுதி <span class="text-danger">*</span>
                        </label>
                        <select name="taluk_id" id="quickTaluk" class="form-select select-civic" required>
                            <option value="">தொகுதியை தேர்வு செய்யவும்</option>
                            @foreach($taluks as $t)
                                <option value="{{ $t->id }}">
                                    {{ app()->getLocale() === 'ta' ? ($t->name_ta ?? $t->name_en) : $t->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="quickCategory" class="form-label small fw-bold text-dark">
                            பிரச்சினை வகை <span class="text-danger">*</span>
                        </label>
                        <select name="category_id" id="quickCategory" class="form-select select-civic" required>
                            <option value="">பிரச்சினை வகையை தேர்வு செய்யவும்</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">
                                    {{ app()->getLocale() === 'ta' ? ($cat->name_ta ?? $cat->name_en) : $cat->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Row 2: Description & Photo Upload Box -->
                <div class="row g-3 mb-3 align-items-stretch">
                    <div class="col-lg-8">
                        <label for="quickDescription" class="form-label small fw-bold text-dark">
                            பிரச்சினையின் விவரம் <span class="text-danger">*</span>
                        </label>
                        <textarea name="description" id="quickDescription" class="form-control" rows="4" maxlength="1000" placeholder="உங்கள் பகுதியில் உள்ள பிரச்சினையை விரிவாக எழுதுங்கள்... (எ.கா., சாலை சேதம், குடிநீர் பற்றாக்குறை, தெரு விளக்கு செயலிழப்பு போன்றவை)" required></textarea>
                        <div class="d-flex justify-content-end text-muted small mt-1" style="font-size: 0.75rem;">
                            <span id="quickCharCount">0</span> / 1000
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <label class="form-label small fw-bold text-dark">ஆதாரப் படம் / வீடியோ</label>
                        <div class="upload-dashed-card text-center p-3 border border-2 border-dashed rounded-3 bg-light d-flex flex-column align-items-center justify-content-center h-75 cursor-pointer" onclick="document.getElementById('quickDescription').focus();">
                            <i class="bi bi-camera fs-2 text-secondary mb-1"></i>
                            <span class="small fw-bold text-dark">புகைப்படம் / வீடியோ பதிவேற்றம்</span>
                            <small class="text-muted" style="font-size: 0.72rem;">(JPG, PNG, MP4 - அதிகபட்சம் 10 MB)</small>
                        </div>
                    </div>
                </div>

                <!-- Bottom Row inside Card -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 pt-3 border-top mt-2">
                    <div class="d-flex align-items-center gap-2 text-muted small">
                        <i class="bi bi-shield-lock-fill text-warning fs-5"></i>
                        <span>உங்கள் புகார் விவரங்கள் தனிப்பட்ட முறையில் பாதுகாக்கப்படும்.</span>
                    </div>
                    <button type="submit" class="btn btn-hero-orange rounded-pill px-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                        <i class="bi bi-send-fill"></i>
                        <span>தொடர்ந்து புகார் பதிவு செய்யுங்கள்</span>
                    </button>
                </div>
            </form>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var textarea = document.getElementById('quickDescription');
        var counter = document.getElementById('quickCharCount');
        if (textarea && counter) {
            textarea.addEventListener('input', function() {
                counter.textContent = textarea.value.length;
            });
        }
    });
</script>
@endpush
