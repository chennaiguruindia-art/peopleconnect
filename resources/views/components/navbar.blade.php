<nav class="navbar navbar-expand-lg navbar-people sticky-top bg-white py-2 shadow-sm border-bottom">
    <div class="container-fluid px-2 px-md-3 px-xl-4">
        <!-- Brand Identity: Logo + People Grievance Platform -->
        <a class="navbar-brand d-flex align-items-center py-0 text-decoration-none notranslate flex-shrink-0" translate="no" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo/logo.png') }}?v=2" alt="The People Connect Logo" class="brand-logo-nav" style="height: 48px; width: auto; object-fit: contain;">
            <div class="brand-divider-v mx-2 mx-sm-2.5"></div>
            <div class="brand-text-nav lh-sm ps-1 ps-sm-1.5">
                <div class="fw-extrabold text-navy brand-heading-title" style="letter-spacing: 0.2px;">PEOPLE GRIEVANCE PLATFORM</div>
                <div class="text-orange fw-bold text-uppercase brand-sub-voice notranslate" translate="no" style="font-size: 0.68rem; letter-spacing: 0.6px;">
                <span class="brand-tamil-sub text-orange fw-bold text-secondary fw-semibold ms-1 notranslate" translate="no"> குரலற்ற மக்களின் குரல்</span>
                </div>
            </div>
        </a>

        <!-- Mobile Right Unit: Lotus Logo + Hamburger Button -->
        <div class="d-flex align-items-center gap-2 ms-auto d-lg-none">
            <img src="{{ asset('assets/images/bjp/lotus.png') }}" alt="Lotus Symbol" class="rounded-circle shadow-xs" style="height: 38px; width: 38px; object-fit: contain;">
            <button class="navbar-toggler border-0 p-1 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#peopleNavbarNav" aria-controls="peopleNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-3 bg-light text-navy">
                    <i class="bi bi-list fs-2"></i>
                </span>
            </button>
        </div>

        <!-- Navbar Links & Actions -->
        <div class="collapse navbar-collapse" id="peopleNavbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-1 gap-xl-2 my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('home') ? 'active-pill' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door-fill nav-icon-pill me-2 d-lg-none"></i>
                        <span>{{ __('messages.nav_home') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('complaints.create') ? 'active-pill' : '' }}" href="{{ route('complaints.create') }}">
                        <i class="bi bi-pencil-square nav-icon-pill me-2 d-lg-none"></i>
                        <span>{{ __('messages.nav_submit_complaint') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('complaints.track') ? 'active-pill' : '' }}" href="{{ route('complaints.track') }}">
                        <i class="bi bi-search nav-icon-pill me-2 d-lg-none"></i>
                        <span>{{ __('messages.nav_track_complaint') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('about') ? 'active-pill' : '' }}" href="{{ route('about') }}">
                        <i class="bi bi-info-circle-fill nav-icon-pill me-2 d-lg-none"></i>
                        <span>{{ __('messages.nav_about') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('updates*') ? 'active-pill' : '' }}" href="{{ route('updates') }}">
                        <i class="bi bi-newspaper nav-icon-pill me-2 d-lg-none"></i>
                        <span>{{ __('messages.nav_updates') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('contact') ? 'active-pill' : '' }}" href="{{ route('contact') }}">
                        <i class="bi bi-telephone-fill nav-icon-pill me-2 d-lg-none"></i>
                        <span>{{ __('messages.nav_contact') }}</span>
                    </a>
                </li>

                <!-- Lotus Symbol (Replaces Citizen Login Button on Desktop) -->
                <li class="nav-item ms-lg-3 d-none d-lg-flex align-items-center">
                    <img src="{{ asset('assets/images/bjp/lotus.png') }}" alt="Lotus Symbol" class="rounded-circle shadow-xs" style="height: 44px; width: 44px; object-fit: contain;" title="Bharatiya Janata Party">
                </li>
            </ul>
        </div>
    </div>
</nav>
