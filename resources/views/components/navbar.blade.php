<nav class="navbar navbar-expand-lg navbar-civic sticky-top">
    <div class="container-fluid px-2 px-md-3 px-xl-4">
        <a class="navbar-brand d-lg-none d-flex align-items-center gap-2 py-0 text-white" href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" style="height: 32px; width: auto; object-fit: contain;">
            <span class="fw-bold fs-6 text-white">{{ __('messages.site_name') }}</span>
        </a>

        <button class="navbar-toggler text-white my-2 border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#civicNavbarNav" aria-controls="civicNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi bi-list fs-2 text-white"></i>
        </button>

        <div class="collapse navbar-collapse" id="civicNavbarNav">
            <ul class="navbar-nav w-100 d-flex flex-wrap align-items-center mb-0 py-1 gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house-door"></i>
                        <span>{{ __('messages.nav_home') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <i class="bi bi-info-circle"></i>
                        <span>{{ __('messages.nav_about') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('complaints.create') ? 'active' : '' }}" href="{{ route('complaints.create') }}">
                        <i class="bi bi-pencil-square"></i>
                        <span>{{ __('messages.nav_submit_complaint') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('complaints.track') ? 'active' : '' }}" href="{{ route('complaints.track') }}">
                        <i class="bi bi-search"></i>
                        <span>{{ __('messages.nav_track_complaint') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('updates') ? 'active' : '' }}" href="{{ route('updates') }}">
                        <i class="bi bi-newspaper"></i>
                        <span>{{ __('messages.nav_updates') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <i class="bi bi-envelope"></i>
                        <span>{{ __('messages.nav_contact') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
