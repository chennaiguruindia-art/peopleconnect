<footer class="footer-civic" style="background-color: #0b1f3a; color: #cbd5e1;">
    <!-- Main Footer Content (4 Columns) -->
    <div class="container py-5">
        <div class="row g-4 justify-content-between align-items-stretch">
            <!-- Col 1: Brand & Logo -->
            <div class="col-lg-4 col-md-6 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ asset('assets/images/logo/logo.png') }}?v=2" alt="The People Connect Logo" class="rounded-3 bg-white p-1 shadow-sm" style="height: 52px; width: auto; object-fit: contain;">
                        <div>
                            <div class="fw-extrabold text-white lh-1" style="font-size: 1.15rem; letter-spacing: 0.5px;">THE PEOPLE CONNECT</div>
                            <div class="text-warning fw-bold small text-uppercase" style="font-size: 0.72rem; letter-spacing: 1px;">VOICE OF THE VOICELESS</div>
                            <div class="text-white-50 small" style="font-size: 0.75rem;">குரலற்ற மக்களின் குரல்</div>
                        </div>
                    </div>
                    <p class="text-secondary small lh-base mb-0">
                        {{ __('messages.disclaimer_text') }}
                    </p>
                </div>
            </div>

            <!-- Col 2: Quick Links (விரைவு இணைப்புகள்) -->
            <div class="col-lg-2 col-md-3 col-6">
                <h5 class="fw-bold text-white mb-3" style="font-size: 0.98rem;">விரைவு இணைப்புகள்</h5>
                <ul class="list-unstyled d-flex flex-column gap-2 small mb-0">
                    <li><a href="{{ route('home') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_home') }}</a></li>
                    <li><a href="{{ route('complaints.create') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_submit_complaint') }}</a></li>
                    <li><a href="{{ route('complaints.track') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_track_complaint') }}</a></li>
                    <li><a href="{{ route('about') }}" class="text-secondary text-decoration-none hover-white"><i class="bi bi-chevron-right text-warning small me-1"></i> {{ __('messages.nav_about') }}</a></li>
                </ul>
            </div>

            <!-- Col 3: Help & Contact (உதவி & தொடர்புக்கு) -->
            <div class="col-lg-3 col-md-3 col-6">
                <h5 class="fw-bold text-white mb-3" style="font-size: 0.98rem;">உதவி & தொடர்புக்கு</h5>
                <ul class="list-unstyled d-flex flex-column gap-2 small mb-0">
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill text-warning"></i>
                        <a href="mailto:support@thepeopleconnect.in" class="text-secondary text-decoration-none hover-white">support@thepeopleconnect.in</a>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-warning"></i>
                        <a href="tel:+919384995222" class="text-secondary text-decoration-none hover-white fw-bold">+91 9384995222</a>
                    </li>
                    <li class="text-white-50 small mt-1">
                        (பணிநேரம்: காலை 10.00 - மாலை 6.00)
                    </li>
                    <li class="mt-2.5">
                        <a href="{{ route('admin.login') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1.5 text-white-50 hover-white small d-inline-flex align-items-center gap-1.5">
                            <i class="bi bi-shield-lock text-warning"></i>
                            <span>{{ __('messages.nav_admin_login') }}</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Col 4: Leadership Card (Hon'ble PM Narendra Modi) -->
            <div class="col-lg-3 col-md-12 col-12">
                <div class="p-3.5 p-sm-3 rounded-4 position-relative overflow-hidden shadow-lg h-100 d-flex flex-column justify-content-between" 
                     style="background: linear-gradient(145deg, rgba(234, 88, 12, 0.10) 0%, rgba(11, 31, 58, 0.75) 100%); 
                            border: 1px solid rgba(245, 158, 11, 0.35);
                            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.35);">
                    
                    <!-- Top Patriotic Tricolor Accent -->
                    <div class="position-absolute top-0 start-0 w-100" style="height: 3px; background: linear-gradient(90deg, #ea580c 0%, #ffffff 50%, #16a34a 100%);"></div>

                    <!-- Leadership Profile Header -->
                    <div>
                        <div class="d-inline-flex align-items-center gap-1.5 px-2.5 py-0.5 rounded-pill bg-warning text-dark fw-bold mb-2 shadow-sm" style="font-size: 0.68rem; letter-spacing: 0.3px;">
                            <i class="bi bi-star-fill text-dark" style="font-size: 0.60rem;"></i>
                            <span>Hon'ble Prime Minister</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="fw-extrabold text-white mb-0" style="font-size: 1.08rem; letter-spacing: 0.2px;">நரேந்திர மோடி</h6>
                                <div class="text-warning small fw-bold mt-0.5" style="font-size: 0.76rem;">பாரதப் பிரதமர்</div>
                                <div class="text-white-50 small" style="font-size: 0.70rem;">Prime Minister of India</div>
                            </div>
                            <div class="flex-shrink-0 text-end">
                                <img src="{{ asset('assets/images/bjp/modi.png') }}" alt="Shri Narendra Modi" class="img-fluid" style="max-height: 90px; width: auto; object-fit: contain; filter: drop-shadow(0 6px 14px rgba(0,0,0,0.55));">
                            </div>
                        </div>
                    </div>

                    <!-- Inspiring Mission Line -->
                    <div class="mt-2.5 pt-2 border-top border-white border-opacity-10">
                        <div class="text-white-50 small fst-italic lh-sm" style="font-size: 0.73rem;">
                            "மக்களின் நலனே நமது முதன்மை இலக்கு."
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Disclaimer & Policies Strip (Darker Blue) -->
    <div class="py-3 text-white-50 small border-top border-white border-opacity-10" style="background-color: #071527; font-size: 0.82rem;">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
            <div class="d-flex align-items-center gap-2 text-center text-md-start">
                <i class="bi bi-info-circle-fill text-warning"></i>
                <span>சுயாதீன மக்கள் குறைதீர்ப்பு உதவி தளம். அரசு இணையதளம் அல்ல.</span>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('privacy') }}" class="text-secondary text-decoration-none hover-white">Privacy Policy</a>
                <span class="text-white-50">•</span>
                <a href="{{ route('terms') }}" class="text-secondary text-decoration-none hover-white">Terms & Conditions</a>
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
