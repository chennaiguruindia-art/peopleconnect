<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'குரலற்ற மகளின் குரல்') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo/logo.png') }}?v=2">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Admin Theme CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}?v=1.2">
    @stack('styles')
</head>
<body class="admin-body">

    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="sidebar-header d-flex align-items-center justify-content-between">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-brand text-decoration-none">
                    <img src="{{ asset('assets/images/logo/logo.png') }}?v=2" alt="Logo" class="rounded-2 bg-white p-1 shadow-sm flex-shrink-0" style="height: 38px; width: auto; object-fit: contain;">
                    <div>
                        <div class="lh-1 fw-bold text-white" style="font-size: 0.95rem;">{{ config('app.name', 'People Connect') }}</div>
                        <small class="text-white-50" style="font-size: 0.72rem;">{{ __('messages.admin_portal') }}</small>
                    </div>
                </a>
                <button class="btn btn-sm btn-link text-white-50 d-lg-none p-1 text-decoration-none" type="button" onclick="closeAdminSidebar()" aria-label="Close menu">
                    <i class="bi bi-x-lg fs-5"></i>
                </button>
            </div>

            <ul class="sidebar-menu">
                <li class="menu-header">{{ __('messages.admin_menu_overview') }}</li>
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>{{ __('messages.admin_dashboard') }}</span>
                    </a>
                </li>

                <li class="menu-header">{{ __('messages.admin_menu_grievance_ops') }}</li>
                <li class="nav-item">
                    <a href="{{ route('admin.complaints.index') }}" class="nav-link {{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}">
                        <i class="bi bi-inbox-fill"></i>
                        <span>{{ __('messages.admin_menu_complaints') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart-line-fill"></i>
                        <span>{{ __('messages.admin_menu_reports') }}</span>
                    </a>
                </li>

                <li class="menu-header">{{ __('messages.admin_menu_master_data') }}</li>
                <li class="nav-item">
                    <a href="{{ route('admin.locations.index') }}" class="nav-link {{ request()->routeIs('admin.locations.*') ? 'active' : '' }}">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>{{ __('messages.admin_menu_locations') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>{{ __('messages.admin_menu_categories') }}</span>
                    </a>
                </li>

                <li class="menu-header">{{ __('messages.admin_menu_comm_settings') }}</li>
                <li class="nav-item">
                    <a href="{{ route('admin.updates.index') }}" class="nav-link {{ request()->routeIs('admin.updates.*') ? 'active' : '' }}">
                        <i class="bi bi-megaphone-fill"></i>
                        <span>{{ __('messages.admin_menu_updates') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="bi bi-gear-fill"></i>
                        <span>{{ __('messages.admin_menu_settings') }}</span>
                    </a>
                </li>

                <li class="menu-header">{{ __('messages.admin_menu_account') }}</li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('admin.logout') }}" id="sidebarLogoutForm">
                        @csrf
                        <a href="javascript:void(0)" onclick="document.getElementById('sidebarLogoutForm').submit()" class="nav-link text-danger">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>{{ __('messages.admin_menu_logout') }}</span>
                        </a>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Mobile Sidebar Backdrop Overlay -->
        <div class="admin-sidebar-backdrop d-lg-none" id="sidebarBackdrop" onclick="closeAdminSidebar()"></div>

        <!-- Main Content -->
        <div class="admin-main">
            <!-- Topbar -->
            <header class="admin-topbar">
                <div class="d-flex align-items-center gap-2 gap-sm-3">
                    <button class="btn btn-sm btn-outline-secondary d-lg-none px-2 py-1" type="button" onclick="openAdminSidebar()" aria-label="Toggle Navigation">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <span class="fw-bold text-secondary d-none d-md-inline" style="font-size: 0.95rem;">{{ __('messages.admin_topbar_title') }}</span>
                </div>

                <div class="d-flex align-items-center gap-2 gap-sm-3">
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-sm btn-outline-primary d-none d-sm-inline-flex align-items-center gap-1">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>{{ __('messages.admin_view_public') }}</span>
                    </a>

                    @include('components.language-switcher')

                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center gap-2 border" type="button" data-bs-toggle="dropdown">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; font-size: 13px;">
                                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                            </div>
                            <span class="fw-semibold small d-none d-sm-inline">{{ Auth::user()->name ?? 'Administrator' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li class="px-3 py-2 border-bottom">
                                <div class="fw-bold small">{{ Auth::user()->name }}</div>
                                <div class="text-muted small" style="font-size: 0.75rem;">{{ Auth::user()->designation ?? 'Portal Admin' }}</div>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger small py-2">
                                        <i class="bi bi-box-arrow-right me-2"></i> {{ __('messages.admin_menu_logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="admin-content">
                @include('components.alerts')
                @yield('content')
            </div>
        </div>
    </div>

    <!-- jQuery 3.7.1 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Chart.js 4.4+ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

    <!-- Admin JS Assets -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>

    <script>
        function openAdminSidebar() {
            var sidebar = document.getElementById('adminSidebar');
            var backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar) sidebar.classList.add('show');
            if (backdrop) backdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
        function closeAdminSidebar() {
            var sidebar = document.getElementById('adminSidebar');
            var backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar) sidebar.classList.remove('show');
            if (backdrop) backdrop.classList.remove('show');
            document.body.style.overflow = '';
        }
    </script>

    @stack('scripts')
</body>
</html>
