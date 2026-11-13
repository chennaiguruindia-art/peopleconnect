@extends('layouts.app')

@section('title', __('messages.nav_terms') . ' - ' . __('messages.site_name'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.nav_terms') }}</li>
                </ol>
            </nav>

            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <h1 class="fw-bold text-dark mb-4">Terms & Civic Service Conditions</h1>
                <p class="text-muted">Effective Date: November 2026</p>

                <div class="border-bottom pb-3 mb-4">
                    <h5 class="fw-bold text-primary">1. Acceptable Use</h5>
                    <p class="text-secondary small">
                        This portal is dedicated to genuine civic and public infrastructure grievances (such as drinking water issues, drainage overflows, damaged roads, faulty streetlights, and sanitation). Filing abusive, fraudulent, or politically malicious complaints is strictly prohibited.
                    </p>
                </div>

                <div class="border-bottom pb-3 mb-4">
                    <h5 class="fw-bold text-primary">2. Truthfulness of Submissions</h5>
                    <p class="text-secondary small">
                        Petitioners must ensure all facts, landmark locations, and uploaded photos reflect real-world site conditions. Filing false claims to defame individuals or officers may lead to grievance dismissal and IP blacklisting.
                    </p>
                </div>

                <div>
                    <h5 class="fw-bold text-primary">3. Scope of Grievance Redressal</h5>
                    <p class="text-secondary small mb-0">
                        குரலற்ற மகளின் குரல் facilitates coordination with civic departments and local authorities. While best efforts are made to expedite resolution within target SLA days, execution timelines depend on administrative budget sanctions and technical feasibility.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
