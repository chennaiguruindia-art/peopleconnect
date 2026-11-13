@extends('layouts.app')

@section('title', __('messages.nav_privacy') . ' - ' . __('messages.site_name'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.nav_privacy') }}</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <h1 class="fw-bold text-dark mb-4">Privacy Policy & Citizen Data Protection</h1>
                <p class="text-muted">Effective Date: November 2026</p>

                <div class="border-bottom pb-3 mb-4">
                    <h5 class="fw-bold text-primary">1. Independent Platform Declaration</h5>
                    <p class="text-secondary small">
                        குரலற்ற மகளின் குரல் is an independent civic portal. We do not claim official status as a government body. Data collected on this platform is solely processed to facilitate civic grievance resolution with respective district bodies and departments.
                    </p>
                </div>

                <div class="border-bottom pb-3 mb-4">
                    <h5 class="fw-bold text-primary">2. Information We Collect</h5>
                    <p class="text-secondary small">
                        When you submit a grievance, we collect your Full Name, Mobile Phone Number, Street Address, Grievance Location (Taluk, Village, Ward), and uploaded photographs/documents.
                    </p>
                </div>

                <div class="border-bottom pb-3 mb-4">
                    <h5 class="fw-bold text-primary">3. Mobile Number Protection & Masking</h5>
                    <p class="text-secondary small">
                        Citizen mobile numbers and street addresses are never publicly visible. On public tracking views and feeds, mobile numbers are masked (e.g. 98******01) and used exclusively for grievance tracking alerts and official coordinator communication.
                    </p>
                </div>

                <div>
                    <h5 class="fw-bold text-primary">4. Data Security & Storage</h5>
                    <p class="text-secondary small mb-0">
                        Uploaded petition files and images are stored in protected local volumes with strict MIME validation. Database records are encrypted and protected against unauthorized disclosure.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
