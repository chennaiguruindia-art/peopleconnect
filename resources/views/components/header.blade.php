<!-- Indian Tricolor Top Accent Line -->
<div class="top-tricolor-line" style="height: 3px; background: linear-gradient(90deg, #ff9933 0%, #ff9933 33.3%, #ffffff 33.3%, #ffffff 66.6%, #138808 66.6%, #138808 100%);"></div>

<!-- Top Utility & Civic Notice Bar (Dark Navy #08162b Theme) -->
<div class="top-utility-bar py-1">
    <div class="container-fluid px-2 px-md-3 px-xl-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
        <!-- Top Left: Megaphone Notice Badge + Disclaimer Text -->
        <div class="d-flex align-items-center gap-2 flex-grow-1 overflow-hidden py-0.5">
            <span class="badge-notice-orange flex-shrink-0">
                <i class="bi bi-megaphone-fill me-1"></i>{{ app()->getLocale() === 'en' ? 'NOTICE' : 'அறிவிப்பு / NOTICE' }}
            </span>
            <span class="top-bar-divider d-none d-md-inline">|</span>
            <span class="top-notice-text text-truncate" title="{{ __('messages.disclaimer_text') }}">
                {{ __('messages.disclaimer_text') }}
            </span>
        </div>

        <!-- Right: Helpline Pill + Language Switcher Pill -->
        <div class="d-flex align-items-center gap-2 ms-auto py-0.5 flex-shrink-0">
            <a href="tel:+919384995222" class="top-helpline-pill text-decoration-none">
                <span class="helpline-icon-circle"><i class="bi bi-telephone-fill"></i></span>
                <span class="helpline-text">{{ app()->getLocale() === 'en' ? 'Helpline: +91 9384995222' : 'உதவி எண்: +91 9384995222' }}</span>
            </a>
            <span class="top-bar-divider d-none d-sm-inline">|</span>
            @include('components.language-switcher')
        </div>
    </div>
</div>

<!-- Main Branding Header: Single Row, Modi Fixed on Far Right -->
<header class="brand-header position-relative overflow-hidden py-2">
    <div class="container-fluid px-2 px-md-3 px-xl-4">
        <div class="d-flex align-items-center justify-content-between flex-nowrap gap-2 gap-xl-4">
            <!-- Left: Our Logo + Brand Identity -->
            <a href="{{ route('home') }}" class="brand-identity-link d-flex align-items-center gap-2 text-decoration-none text-reset flex-shrink-0">
                <img src="{{ asset('assets/images/logo/logo.png') }}?v=2" alt="{{ __('messages.site_name') }}" class="brand-logo-img flex-shrink-0" style="height: 54px; width: auto; object-fit: contain;">
                <div class="brand-v-divider d-none d-sm-block"></div>
                <div class="brand-text-block ms-1">
                    <div class="brand-title lh-1">
                        @if(app()->getLocale() === 'en')
                            <span class="brand-title-navy">Tamil Nadu</span> <span class="brand-title-orange">Makkal Kural</span>
                        @else
                            <span class="brand-title-navy">தமிழ்நாடு</span> <span class="brand-title-orange">மக்கள் குரல்</span>
                        @endif
                    </div>
                    <div class="brand-sub-caps mt-1">
                        @if(app()->getLocale() === 'en')
                            — Voice of the People —
                        @else
                            — குரலற்ற மகளின் குரல்  —
                        @endif
                    </div>
                    <div class="brand-tagline-motto mt-1 d-flex align-items-center gap-2 flex-wrap">
                        <span class="badge bg-warning-subtle text-dark border border-warning py-0 px-1.5 rounded-pill fw-bold" style="font-size: 0.68rem;">
                            {{ app()->getLocale() === 'en' ? 'BJP Citizen Service Center' : 'பாஜக மக்கள் சேவை மையம்' }}
                        </span>
                        <span class="text-secondary small d-none d-md-inline" style="font-size: 0.74rem;">
                            <i class="bi bi-check-circle-fill text-success me-1"></i>{{ __('messages.tagline') }}
                        </span>
                    </div>
                </div>
            </a>

            <!-- Center: Civic Purpose Motto (Always in center, drops gracefully on small screens) -->
            <div class="header-civic-center d-none d-lg-flex flex-column align-items-center justify-content-center text-center px-2 flex-grow-1 flex-shrink-1">
                @if(app()->getLocale() === 'en')
                    <div class="civic-motto-headline">
                        Unified Public Grievance Redressal Portal
                    </div>
                    <div class="civic-motto-subline mt-0.5">
                        <span>All 38 Districts of Tamil Nadu</span>
                        <span class="mx-1.5 text-muted">|</span>
                        <span class="text-success fw-bold"><i class="bi bi-lightning-charge-fill me-0.5"></i>Fast-Track Civic Center</span>
                    </div>
                @else
                    <div class="civic-motto-headline">
                        ஒருங்கிணைந்த மக்களின் குறைகளைத் தீர்க்கும் தளம்
                    </div>
                    <div class="civic-motto-subline mt-0.5">
                        <span>தமிழ்நாட்டின் 38 மாவட்டங்கள்</span>
                        <span class="mx-1.5 text-muted">|</span>
                        <span class="text-success fw-bold"><i class="bi bi-lightning-charge-fill me-0.5"></i>விரைவு சேவை மையம்</span>
                    </div>
                @endif
            </div>

            <!-- Right: Hon'ble PM Narendra Modi (Always pinned to the right side) -->
            <div class="modi-header-unit d-flex align-items-center gap-2 flex-shrink-0 ms-auto">
                <img src="{{ asset('assets/images/bjp/modi.png') }}" alt="PM Narendra Modi" class="modi-portrait-img" style="height: 68px; width: auto; object-fit: contain; filter: drop-shadow(0 2px 5px rgba(0,0,0,0.15));">
                <div class="modi-card-box bg-white rounded-3 px-2.5 py-1 shadow-xs border border-warning-subtle text-center">
                    @if(app()->getLocale() === 'en')
                        <div class="fw-bold text-dark lh-sm" style="font-size: 0.92rem; white-space: nowrap;">Narendra Modi</div>
                        <div class="badge-modi-pill my-0.5">
                            Prime Minister of India
                        </div>
                        <small class="text-muted d-block" style="font-size: 0.68rem; white-space: nowrap;">Hon'ble Prime Minister</small>
                    @else
                        <div class="fw-bold text-dark lh-sm" style="font-size: 0.92rem; white-space: nowrap;">நரேந்திர மோடி</div>
                        <div class="badge-modi-pill my-0.5">
                            பாரதப் பிரதமர்
                        </div>
                        <small class="text-muted d-block" style="font-size: 0.68rem; white-space: nowrap;">மாண்புமிகு பாரதப் பிரதமர்</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
