@extends('layouts.app')

@section('title', __('messages.nav_contact') . ' - ' . __('messages.site_name'))

@section('content')
<div class="container py-4 py-md-5 px-3 px-sm-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.nav_contact') }}</li>
        </ol>
    </nav>

    <div class="text-center mb-4 mb-md-5">
        <h1 class="fw-bold text-dark fs-2 fs-md-1">{{ __('messages.contact_info') }}</h1>
        <p class="text-muted fs-6 fs-md-5 mx-auto" style="max-width: 650px;">
            Get in touch with the குரலற்ற மகளின் குரல் facilitation desk for technical assistance or grievance follow-ups.
        </p>
    </div>

    <div class="row g-3 g-md-4 justify-content-center mb-4 mb-md-5">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-3.5 p-sm-4 text-center">
                <div class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; font-size: 24px;">
                    <i class="bi bi-telephone"></i>
                </div>
                <h5 class="fw-bold mb-1">Helpline Desk</h5>
                <p class="text-muted small mb-2">Available Mon - Sat (9:00 AM - 6:00 PM)</p>
                <a href="tel:+919384995222" class="fw-bold text-primary fs-5 text-decoration-none text-break">+91 9384995222</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-3.5 p-sm-4 text-center">
                <div class="rounded-circle bg-success-subtle text-success d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; font-size: 24px;">
                    <i class="bi bi-envelope"></i>
                </div>
                <h5 class="fw-bold mb-1">Email Facilitation</h5>
                <p class="text-muted small mb-2">For written appeals and queries</p>
                <a href="mailto:kural@virudhunagar.org" class="fw-bold text-success fs-5 text-decoration-none text-break">kural@virudhunagar.org</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 p-3.5 p-sm-4 text-center">
                <div class="rounded-circle bg-warning-subtle text-warning d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 56px; height: 56px; font-size: 24px;">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <h5 class="fw-bold mb-1">Facilitation Center</h5>
                <p class="text-muted small mb-0">
                    Civic Grievance Facilitation Center, Madurai Main Road, Virudhunagar, குரலற்ற மகளின் குரல் - 626001
                </p>
            </div>
        </div>
    </div>

    <!-- Emergency District Helpline Directory -->
    <div class="card border-0 shadow-sm rounded-4 p-3 p-sm-4 p-md-5 bg-white">
        <h4 class="fw-bold text-dark fs-5 fs-md-4 mb-3 mb-md-4">Official District Emergency Directory / அவசர கால எண்கள்</h4>
        <div class="row g-2 g-sm-3">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="p-3 bg-light border rounded-3 h-100">
                    <div class="small text-muted">Police Control Room</div>
                    <div class="fs-6 fs-md-5 fw-bold text-danger text-break">100 / 04562-280100</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="p-3 bg-light border rounded-3 h-100">
                    <div class="small text-muted">Fire & Rescue Services</div>
                    <div class="fs-6 fs-md-5 fw-bold text-danger text-break">101 / 04562-243101</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="p-3 bg-light border rounded-3 h-100">
                    <div class="small text-muted">Ambulance Service</div>
                    <div class="fs-6 fs-md-5 fw-bold text-danger text-break">108 / 102</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="p-3 bg-light border rounded-3 h-100">
                    <div class="small text-muted">TANGEDCO Electricity Fuse</div>
                    <div class="fs-6 fs-md-5 fw-bold text-primary text-break">1912</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
