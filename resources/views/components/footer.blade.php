<footer class="footer-civic">
    <div class="container">
        <div class="row g-4">
            <!-- Col 1: About Portal -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" class="rounded-2 bg-white p-1 shadow-sm" style="height: 52px; width: auto; object-fit: contain;">
                    <span class="fs-5 fw-bold text-white ms-1">{{ __('messages.site_name') }}</span>
                </div>
                <p class="text-secondary small">
                    {{ __('messages.tagline') }}
                </p>
                <div class="p-3 rounded bg-dark border border-secondary border-opacity-25 small mb-3 text-secondary">
                    <i class="bi bi-shield-check text-warning me-1"></i>
                    <strong>{{ __('messages.disclaimer_title') }}:</strong>
                    {{ __('messages.disclaimer_text') }}
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5>{{ __('messages.quick_links') }}</h5>
                <ul class="list-unstyled d-flex flex-column gap-2 small">
                    <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right text-primary me-1"></i> {{ __('messages.nav_home') }}</a></li>
                    <li><a href="{{ route('complaints.create') }}"><i class="bi bi-chevron-right text-primary me-1"></i> {{ __('messages.nav_submit_complaint') }}</a></li>
                    <li><a href="{{ route('complaints.track') }}"><i class="bi bi-chevron-right text-primary me-1"></i> {{ __('messages.nav_track_complaint') }}</a></li>
                    <li><a href="{{ route('district.info') }}"><i class="bi bi-chevron-right text-primary me-1"></i> {{ __('messages.nav_district_info') }}</a></li>
                    <li><a href="{{ route('updates') }}"><i class="bi bi-chevron-right text-primary me-1"></i> {{ __('messages.nav_updates') }}</a></li>
                </ul>
            </div>

            <!-- Col 3: Taluks Covered -->
            <div class="col-lg-3 col-md-6">
                <h5>10 {{ __('messages.stat_taluks') }}</h5>
                <div class="row g-1 small text-secondary">
                    <div class="col-6">
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-1">
                            <li>• விருதுநகர் (Virudhunagar)</li>
                            <li>• சிவகாசி (Sivakasi)</li>
                            <li>• ராஜபாளையம் (Rajapalayam)</li>
                            <li>• சாத்தூர் (Sattur)</li>
                            <li>• அருப்புக்கோட்டை (Aruppukkottai)</li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-1">
                            <li>• ஸ்ரீவில்லிபுத்தூர் (Srivilliputhur)</li>
                            <li>• வத்திராயிருப்பு (Watrap)</li>
                            <li>• காரியாபட்டி (Kariapatti)</li>
                            <li>• திருச்சுழி (Tiruchuli)</li>
                            <li>• வெம்பக்கோட்டை (Vembakottai)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Col 4: Contact & Helpdesk -->
            <div class="col-lg-3 col-md-6">
                <h5>{{ __('messages.contact_info') }}</h5>
                <ul class="list-unstyled small text-secondary d-flex flex-column gap-2">
                    <li class="d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill text-danger mt-1"></i>
                        <span>Civic Grievance Facilitation Center, Madurai Main Road, Virudhunagar - 626001</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-telephone-fill text-success"></i>
                        <a href="tel:+914562252500" class="text-secondary">+91 4562 252500</a>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                        <i class="bi bi-envelope-fill text-warning"></i>
                        <a href="mailto:kural@virudhunagar.org" class="text-secondary">kural@virudhunagar.org</a>
                    </li>
                    <li class="mt-2">
                        <a href="{{ route('admin.login') }}" class="btn btn-sm btn-outline-light w-100 text-center">
                            <i class="bi bi-lock me-1"></i> {{ __('messages.nav_admin_login') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                © {{ date('Y') }} {{ __('messages.site_name') }}. {{ __('messages.all_rights_reserved') }}
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('privacy') }}" class="text-secondary text-decoration-none">{{ __('messages.nav_privacy') }}</a>
                <span class="text-secondary">•</span>
                <a href="{{ route('terms') }}" class="text-secondary text-decoration-none">{{ __('messages.nav_terms') }}</a>
                <span class="text-secondary">•</span>
                <a href="{{ route('admin.login') }}" class="text-warning text-decoration-none">
                    <i class="bi bi-shield-lock-fill me-1"></i> {{ __('messages.nav_admin_login') }}
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- Global Loading Overlay -->
<div id="globalLoadingOverlay" class="loading-overlay">
    <div class="card bg-white p-4 text-center rounded-3 shadow-lg" style="max-width: 320px;">
        <div class="spinner-border spinner-civic mx-auto mb-3" role="status"></div>
        <h6 class="fw-bold text-dark mb-1" id="loadingMessage">{{ __('messages.loading') }}</h6>
        <p class="text-muted small mb-0">Please do not refresh the page</p>
    </div>
</div>
