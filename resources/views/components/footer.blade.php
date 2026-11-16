<footer class="footer-civic" style="background-color: #0b1f3a; color: #cbd5e1;">
    <!-- 1. Header Bar of Footer: Platform Identity + PM Modi VIP Showcase -->
    <div class="py-3 py-md-4 border-bottom border-white border-opacity-10 notranslate" translate="no" style="background: linear-gradient(90deg, rgba(234, 88, 12, 0.08) 0%, rgba(11, 31, 58, 0.95) 50%, rgba(22, 163, 74, 0.08) 100%);">
        <div class="container">
            <div class="row align-items-center justify-content-between g-3">
                <!-- Left: Brand Identity -->
                <div class="col-md-7 col-12">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('assets/images/logo/logo.png') }}?v=2" alt="The People Connect Logo" class="rounded-3 bg-white p-1 shadow-sm flex-shrink-0" style="height: 48px; width: auto; object-fit: contain;">
                        <div>
                            <div class="fw-extrabold text-white lh-1" style="font-size: 1.12rem; letter-spacing: 0.5px;">THE PEOPLE CONNECT</div>
                            <div class="text-warning fw-bold small text-uppercase mt-1" style="font-size: 0.70rem; letter-spacing: 0.8px;">
                                VOICE OF THE VOICELESS <span class="text-white-50 ms-1 fw-normal">| குரலற்ற மக்களின் குரல்</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: PM Modi VIP Profile Capsule (Unbreakable d-inline-flex) -->
                <div class="col-md-5 col-12">
                    <div class="d-flex align-items-center justify-content-start justify-content-md-end">
                        <div class="d-inline-flex align-items-center gap-3 px-3 py-2 rounded-4 shadow-sm" 
                             style="background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.03) 100%); border: 1px solid rgba(245, 158, 11, 0.35);">
                            <div class="text-start text-md-end lh-sm">
                                <span class="badge bg-warning text-dark fw-bold px-2 py-0.5 rounded-pill mb-1" style="font-size: 0.62rem; letter-spacing: 0.3px;">Hon'ble Prime Minister</span>
                                <div class="fw-extrabold text-white" style="font-size: 0.98rem; letter-spacing: 0.2px;">நரேந்திர மோடி</div>
                                <div class="text-warning small fw-semibold" style="font-size: 0.72rem;">பாரதப் பிரதமர் | Prime Minister of India</div>
                            </div>
                            <div class="flex-shrink-0">
                                <img src="{{ asset('assets/images/bjp/modi.png') }}" alt="Shri Narendra Modi" class="img-fluid" style="height: 60px; width: auto; object-fit: contain; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.5));">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Main Footer Content (4 Balanced Columns) -->
    <div class="container py-4 py-md-5">
        <div class="row g-4 justify-content-between">
            <!-- Col 1: Platform Purpose -->
            <div class="col-lg-4 col-md-6 col-12">
                <h6 class="fw-bold text-white mb-2.5" style="font-size: 0.95rem;">எங்கள் நோக்கம்</h6>
                <p class="text-secondary small lh-base mb-0">
                    {{ __('messages.disclaimer_text') }}
                </p>
            </div>

            <!-- Col 2: Quick Links (விரைவு இணைப்புகள்) -->
            <div class="col-lg-2 col-md-3 col-6">
                <h6 class="fw-bold text-white mb-3" style="font-size: 0.95rem;">விரைவு இணைப்புகள்</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small mb-0">
                    <li><a href="{{ route('home') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_home') }}</a></li>
                    <li><a href="{{ route('complaints.create') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_submit_complaint') }}</a></li>
                    <li><a href="{{ route('complaints.track') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_track_complaint') }}</a></li>
                    <li><a href="{{ route('about') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_about') }}</a></li>
                </ul>
            </div>

            <!-- Col 3: Help & Contact (உதவி & தொடர்புக்கு) -->
            <div class="col-lg-3 col-md-3 col-6">
                <h6 class="fw-bold text-white mb-3" style="font-size: 0.95rem;">உதவி & தொடர்புக்கு</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small mb-0">
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill text-warning"></i>
                        <a href="mailto:support@thepeopleconnect.in" class="text-secondary text-decoration-none hover-white text-truncate">support@thepeopleconnect.in</a>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-warning"></i>
                        <a href="tel:+919384995222" class="text-secondary text-decoration-none hover-white fw-bold">+91 9384995222</a>
                    </li>
                    <li class="text-white-50 small mt-1">
                        (பணிநேரம்: காலை 10.00 - மாலை 6.00)
                    </li>
                </ul>
            </div>

            <!-- Col 4: Legal & Staff Access (சட்ட & கொள்கைகள்) -->
            <div class="col-lg-3 col-md-6 col-12">
                <h6 class="fw-bold text-white mb-3" style="font-size: 0.95rem;">சட்ட & கொள்கைகள்</h6>
                <ul class="list-unstyled d-flex flex-column gap-2 small mb-3">
                    <li><a href="{{ route('privacy') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> Terms & Conditions</a></li>
                </ul>
                <a href="{{ route('admin.login') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1.5 text-white-50 hover-white small d-inline-flex align-items-center gap-1.5">
                    <i class="bi bi-shield-lock text-warning"></i>
                    <span>{{ __('messages.nav_admin_login') }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 3. Bottom Disclaimer Strip (Darker Blue) -->
    <div class="py-2.5 text-center text-white-50 small border-top border-white border-opacity-10" style="background-color: #071527; font-size: 0.82rem;">
        <div class="container d-flex align-items-center justify-content-center gap-2">
            <i class="bi bi-info-circle-fill text-warning"></i>
            <span>சுயாதீன மக்கள் குறைதீர்ப்பு உதவி தளம். அரசு இணையதளம் அல்ல.</span>
        </div>
    </div>
</footer>

<!-- Global Loading Overlay -->
<div id="globalLoadingOverlay" class="loading-overlay">
    <div class="card bg-white p-4 text-center rounded-3 shadow-lg" style="max-width: 320px;">
        <div class="spinner-border text-warning mx-auto mb-3" role="status"></div>
        <h6 class="fw-bold text-dark mb-1" id="loadingMessage">{{ __('messages.loading') }}</h6>
        <p class="text-muted small mb-0">Please do not refresh the page</p>
    </div>
</div>
