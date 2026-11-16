<nav class="navbar navbar-expand-lg navbar-people sticky-top bg-white py-2 shadow-sm border-bottom">
    <div class="container-fluid px-2 px-md-3 px-xl-4">
        <!-- Brand Identity: Logo + Public Grievance Management Platform -->
        <a class="navbar-brand d-flex align-items-center gap-2 gap-md-2.5 py-0 text-decoration-none notranslate flex-shrink-0" translate="no" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo/logo.png') }}?v=2" alt="Logo" class="brand-logo-nav" style="height: 46px; width: auto; object-fit: contain;">
            <div class="brand-text-nav lh-sm">
                <div class="fw-extrabold text-navy brand-heading-title" style="letter-spacing: 0.2px;">PUBLIC GRIEVANCE PLATFORM</div>
                <div class="text-orange fw-bold text-uppercase brand-sub-voice" style="font-size: 0.65rem; letter-spacing: 0.8px;">
                    VOICE OF THE VOICELESS <span class="text-secondary fw-normal d-none d-sm-inline ms-1">| குரலற்ற மக்களின் குரல்</span>
                </div>
            </div>
        </a>

        <!-- Mobile Toggler Button -->
        <button class="navbar-toggler border-0 p-1 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#peopleNavbarNav" aria-controls="peopleNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-3 bg-light text-navy">
                <i class="bi bi-list fs-3"></i>
            </span>
        </button>

        <!-- Navbar Links & Actions -->
        <div class="collapse navbar-collapse" id="peopleNavbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-1 gap-xl-2 my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('home') ? 'active-pill' : '' }}" href="{{ route('home') }}">
                        <span>{{ __('messages.nav_home') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('complaints.create') ? 'active-pill' : '' }}" href="{{ route('complaints.create') }}">
                        <span>{{ __('messages.nav_submit_complaint') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('complaints.track') ? 'active-pill' : '' }}" href="{{ route('complaints.track') }}">
                        <span>{{ __('messages.nav_track_complaint') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('about') ? 'active-pill' : '' }}" href="{{ route('about') }}">
                        <span>{{ __('messages.nav_about') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-pill-link text-nowrap {{ request()->routeIs('contact') ? 'active-pill' : '' }}" href="{{ route('contact') }}">
                        <span>{{ __('messages.nav_contact') }}</span>
                    </a>
                </li>

                <!-- Citizen Login Navy Pill Button -->
                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a href="{{ route('admin.login') }}" class="btn btn-navy-pill rounded-pill px-3.5 py-1.5 fw-bold d-inline-flex align-items-center justify-content-center gap-1.5 text-white shadow-xs text-nowrap">
                        <i class="bi bi-person-fill"></i>
                        <span>Citizen Login</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
