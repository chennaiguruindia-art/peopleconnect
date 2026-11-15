<nav class="navbar navbar-expand-lg navbar-civic sticky-top py-1.5">
    <div class="container-fluid px-2 px-md-3 px-xl-4">
        <!-- Mobile Left Label: No Image (As requested), Clean Civic Menu Badge -->
        <a class="navbar-brand d-lg-none d-flex align-items-center gap-2 py-1 text-white text-decoration-none" href="{{ route('home') }}">
            <span class="mobile-nav-icon-badge"><i class="bi bi-grid-3x3-gap-fill text-warning"></i></span>
            <span class="fw-bold fs-6 text-white tracking-wide">{{ __('messages.site_name') }}</span>
        </a>

        <!-- Mobile Modern Hamburger Button -->
        <button class="navbar-toggler text-white my-1 border border-white border-opacity-25 rounded-pill px-3 py-1 shadow-none d-flex align-items-center gap-1.5" type="button" data-bs-toggle="collapse" data-bs-target="#civicNavbarNav" aria-controls="civicNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-4 text-white"></i>
            <span class="small fw-bold text-white d-none d-sm-inline">{{ app()->getLocale() === 'en' ? 'MENU' : 'பட்டி' }}</span>
        </button>

        <div class="collapse navbar-collapse" id="civicNavbarNav">
            <ul class="navbar-nav w-100 d-flex flex-wrap align-items-lg-center mb-0 py-2 py-lg-1 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <span class="nav-icon-wrapper"><i class="bi bi-house-door-fill"></i></span>
                        <span class="nav-label-text">{{ __('messages.nav_home') }}</span>
                        <i class="bi bi-chevron-right d-lg-none ms-auto text-white-50 small"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <span class="nav-icon-wrapper"><i class="bi bi-info-circle-fill"></i></span>
                        <span class="nav-label-text">{{ __('messages.nav_about') }}</span>
                        <i class="bi bi-chevron-right d-lg-none ms-auto text-white-50 small"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('complaints.create') ? 'active' : '' }}" href="{{ route('complaints.create') }}">
                        <span class="nav-icon-wrapper"><i class="bi bi-pencil-square"></i></span>
                        <span class="nav-label-text">{{ __('messages.nav_submit_complaint') }}</span>
                        <i class="bi bi-chevron-right d-lg-none ms-auto text-white-50 small"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('complaints.track') ? 'active' : '' }}" href="{{ route('complaints.track') }}">
                        <span class="nav-icon-wrapper"><i class="bi bi-search"></i></span>
                        <span class="nav-label-text">{{ __('messages.nav_track_complaint') }}</span>
                        <i class="bi bi-chevron-right d-lg-none ms-auto text-white-50 small"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('updates') ? 'active' : '' }}" href="{{ route('updates') }}">
                        <span class="nav-icon-wrapper"><i class="bi bi-newspaper"></i></span>
                        <span class="nav-label-text">{{ __('messages.nav_updates') }}</span>
                        <i class="bi bi-chevron-right d-lg-none ms-auto text-white-50 small"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <span class="nav-icon-wrapper"><i class="bi bi-envelope-fill"></i></span>
                        <span class="nav-label-text">{{ __('messages.nav_contact') }}</span>
                        <i class="bi bi-chevron-right d-lg-none ms-auto text-white-50 small"></i>
                    </a>
                </li>

                <!-- Mobile Quick Helpline Card inside Drawer -->
                <li class="nav-item d-lg-none w-100 pt-2 mt-2 border-top border-white border-opacity-15">
                    <a href="tel:+919384995222" class="btn btn-warning w-100 fw-bold rounded-pill py-2 d-flex align-items-center justify-content-center gap-2 text-dark shadow-sm">
                        <i class="bi bi-telephone-fill text-danger"></i>
                        <span>{{ app()->getLocale() === 'en' ? 'Helpline: +91 9384995222' : 'உதவி எண்: +91 9384995222' }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
