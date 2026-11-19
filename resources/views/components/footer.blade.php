<footer class="footer-civic" style="background-color: #0b1f3a; color: #cbd5e1;">
    <div class="container py-5">
        <div class="row g-4 justify-content-between">
            <!-- Col 1: Brand & Logo -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ asset('assets/images/logo/logo.png') }}?v=2" alt="The People Connect Logo" class="rounded-3 bg-white p-1 shadow-sm" style="height: 52px; width: auto; object-fit: contain;">
                    <div>
                        <div class="fw-extrabold text-white lh-1" style="font-size: 1.15rem; letter-spacing: 0.5px;">THE PEOPLE CONNECT</div>
                        <div class="text-warning fw-bold small text-uppercase" style="font-size: 0.72rem; letter-spacing: 1px;">VOICE OF THE VOICELESS</div>
                        <div class="text-white-50 small" style="font-size: 0.75rem;">குரலற்ற மக்களின் குரல்</div>
                    </div>
                </div>
                <p class="text-secondary small lh-base mb-3">
                    {{ __('messages.disclaimer_text') }}
                </p>
            </div>

            <!-- Col 2: Quick Links (விரைவு இணைப்புகள்) -->
            <div class="col-lg-2 col-md-6 col-6">
                <h5 class="fw-bold text-white mb-3" style="font-size: 0.98rem;">விரைவு இணைப்புகள்</h5>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="{{ route('home') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_home') }}</a></li>
                    <li><a href="{{ route('complaints.create') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_submit_complaint') }}</a></li>
                    <li><a href="{{ route('complaints.track') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_track_complaint') }}</a></li>
                    <li><a href="{{ route('about') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_about') }}</a></li>
                </ul>
            </div>

            <!-- Col 3: Help & Contact (உதவி & தொடர்புக்கு) -->
            <div class="col-lg-3 col-md-6">
                <h5 class="fw-bold text-white mb-3" style="font-size: 0.98rem;">உதவி & தொடர்புக்கு</h5>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill text-warning"></i>
                        <a href="mailto:thepeopleconnectofficial@gmail.com" class="text-secondary text-decoration-none hover-white">thepeopleconnectofficial@gmail.com</a>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-warning"></i>
                        <a href="tel:+919384995222" class="text-secondary text-decoration-none hover-white fw-bold">+91 9384995222</a>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-instagram text-warning"></i>
                        <a href="https://www.instagram.com/thepeopleconnectofficial" target="_blank" rel="noopener noreferrer" class="text-secondary text-decoration-none hover-white">@thepeopleconnectofficial</a>
                    </li>
                    <li class="text-white-50 small mt-1">
                        (பணிநேரம்: காலை 10.00 - மாலை 6.00)
                    </li>
                    <li class="mt-2">
                        <a href="{{ route('admin.login') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1 text-white-50 hover-white small">
                            <i class="bi bi-shield-lock me-1"></i> {{ __('messages.nav_admin_login') }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 4: Legal & Policies (சட்ட & கொள்கைகள்) -->
            <div class="col-lg-3 col-md-6 col-6">
                <h5 class="fw-bold text-white mb-3" style="font-size: 0.98rem;">சட்ட & கொள்கைகள்</h5>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="{{ route('privacy') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> Terms & Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Bottom Disclaimer Strip (Darker Blue) -->
    <div class="py-2.5 text-center text-white-50 small border-top border-white border-opacity-10" style="background-color: #071527; font-size: 0.82rem;">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center gap-2">
                <i class="bi bi-info-circle-fill text-warning"></i>
                <span class="text-white-50">அரசு இணையதளம் அல்ல (Not an Official Government Website)</span>
                <span class="text-secondary opacity-50 d-none d-sm-inline">•</span>
                <span class="text-white-50">நவீன விவசாயி ராஜேஷ் குருசாமியின் மக்கள் குறைதீர் வழிகாட்டல் சேவை தளம்</span>
            </div>
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
