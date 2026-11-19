@extends('layouts.app')

@section('title', __('messages.form_title'))

@push('styles')
<style>
    /* Civic Modern Theme Styles */
    :root {
        --civic-navy: #0B1F3A;
        --civic-dark-navy: #071527;
        --civic-orange: #EA580C;
        --civic-saffron: #FF7A00;
        --civic-green: #16A34A;
        --civic-blue: #2563EB;
        --civic-purple: #7C3AED;
        --civic-border: #E2E8F0;
        --civic-card-bg: #FFFFFF;
        --civic-light-bg: #F8FAFC;
    }

    .civic-form-container {
        max-width: 960px;
        margin: 0 auto;
    }

    /* Top Tricolor Accent Line */
    .civic-tricolor-bar {
        height: 4px;
        display: flex;
        border-radius: 4px 4px 0 0;
        overflow: hidden;
    }
    .civic-tricolor-bar span:nth-child(1) { flex: 1; background-color: var(--civic-saffron); }
    .civic-tricolor-bar span:nth-child(2) { flex: 1; background-color: #FFFFFF; }
    .civic-tricolor-bar span:nth-child(3) { flex: 1; background-color: var(--civic-green); }

    /* Hero Banner Card */
    .civic-hero-card {
        background: linear-gradient(135deg, #FFFBEB 0%, #F8FAFC 50%, #EFF6FF 100%);
        border: 1.5px solid #FDE68A;
        border-radius: 20px;
        padding: 28px 24px;
        box-shadow: 0 10px 25px -5px rgba(234, 88, 12, 0.06);
        position: relative;
        overflow: hidden;
    }
    .civic-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #FFFFFF;
        color: #B45309;
        font-weight: 700;
        font-size: 0.82rem;
        padding: 5px 14px;
        border-radius: 30px;
        border: 1px solid #FDE68A;
        box-shadow: 0 2px 6px rgba(217, 119, 6, 0.1);
    }
    .civic-hero-title {
        color: var(--civic-navy);
        font-size: 1.85rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        margin-top: 10px;
        margin-bottom: 6px;
    }
    .civic-hero-subtitle {
        color: #475569;
        font-size: 0.95rem;
        max-width: 680px;
        margin: 0 auto;
        line-height: 1.5;
    }

    /* Trust Badges Strip */
    .trust-badges-strip {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-top: 16px;
    }
    .trust-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(226, 232, 240, 0.9);
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        color: #334155;
        backdrop-filter: blur(4px);
    }

    /* Step Progress Indicator */
    .form-step-stepper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 20px;
        padding-top: 18px;
        border-top: 1px dashed #CBD5E1;
    }
    .step-pill {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.82rem;
        font-weight: 700;
        color: #64748B;
        text-decoration: none;
        padding: 4px 10px;
        border-radius: 20px;
        background: #FFFFFF;
        border: 1px solid #E2E8F0;
        transition: all 0.2s ease;
    }
    .step-pill.active {
        color: var(--civic-orange);
        border-color: var(--civic-orange);
        background: #FFF7ED;
    }
    .step-pill-num {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #E2E8F0;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 800;
    }
    .step-pill.active .step-pill-num {
        background: var(--civic-orange);
        color: #FFFFFF;
    }
    .step-arrow {
        color: #94A3B8;
        font-size: 0.85rem;
    }

    /* Form Section Cards */
    .civic-card {
        background: #FFFFFF;
        border: 1.5px solid var(--civic-border);
        border-radius: 18px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        margin-bottom: 24px;
        overflow: hidden;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .civic-card:hover {
        border-color: #CBD5E1;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.07);
    }
    .civic-card-header {
        padding: 16px 22px;
        background: #FAFAFC;
        border-bottom: 1.5px solid #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .civic-card-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .civic-icon-box {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }
    .civic-card-title {
        margin: 0;
        font-size: 1.08rem;
        font-weight: 800;
        color: var(--civic-navy);
    }
    .civic-card-subtitle {
        margin: 0;
        font-size: 0.78rem;
        color: #64748B;
    }
    .civic-step-badge {
        font-size: 0.75rem;
        font-weight: 700;
        color: #475569;
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        padding: 4px 10px;
        border-radius: 12px;
    }
    .civic-card-body {
        padding: 24px 22px;
    }

    /* Form Inputs & Labels */
    .civic-label {
        font-size: 0.88rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 7px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .required-star {
        color: #DC2626;
        font-weight: bold;
    }
    .form-control, .form-select {
        border: 1.5px solid #CBD5E1;
        border-radius: 11px;
        padding: 10px 14px;
        font-size: 0.92rem;
        color: #0F172A;
        background-color: #FFFFFF;
        transition: all 0.2s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        border-color: var(--civic-orange);
        box-shadow: 0 0 0 3.5px rgba(234, 88, 12, 0.15);
        background-color: #FFFFFF;
    }
    .input-group-text {
        border: 1.5px solid #CBD5E1;
        background-color: #F8FAFC;
        color: #475569;
        border-radius: 11px 0 0 11px;
        font-size: 0.9rem;
    }
    .input-group .form-control {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    /* Interactive Priority Selector Chips */
    .priority-selector-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }
    .priority-chip-card {
        border: 1.5px solid #CBD5E1;
        border-radius: 12px;
        padding: 10px 12px;
        background: #FFFFFF;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
        user-select: none;
    }
    .priority-chip-card:hover {
        border-color: #94A3B8;
        transform: translateY(-1px);
    }
    .priority-chip-card.active-low {
        border-color: #16A34A;
        background: #F0FDF4;
        box-shadow: 0 4px 10px rgba(22, 163, 74, 0.12);
    }
    .priority-chip-card.active-medium {
        border-color: #2563EB;
        background: #EFF6FF;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.12);
    }
    .priority-chip-card.active-high {
        border-color: #D97706;
        background: #FFFBEB;
        box-shadow: 0 4px 10px rgba(217, 119, 6, 0.12);
    }
    .priority-chip-card.active-urgent {
        border-color: #DC2626;
        background: #FEF2F2;
        box-shadow: 0 4px 10px rgba(220, 38, 38, 0.12);
    }
    .priority-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 4px;
    }

    /* Modern File Upload Drop-Zone */
    .civic-upload-dropzone {
        border: 2px dashed #CBD5E1;
        border-radius: 14px;
        padding: 24px 16px;
        text-align: center;
        background: #F8FAFC;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }
    .civic-upload-dropzone:hover {
        border-color: var(--civic-orange);
        background: #FFF7ED;
    }
    .civic-upload-dropzone.has-file {
        border-color: #16A34A;
        background: #F0FDF4;
        border-style: solid;
    }
    .civic-upload-icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #EFF6FF;
        color: var(--civic-blue);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 8px;
        transition: transform 0.2s;
    }
    .civic-upload-dropzone:hover .civic-upload-icon-circle {
        transform: scale(1.08);
        background: #FFF7ED;
        color: var(--civic-orange);
    }
    .file-preview-badge {
        display: none;
        align-items: center;
        gap: 8px;
        background: #DCFCE7;
        color: #15803D;
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 700;
        margin-top: 10px;
        border: 1px solid #86EFAC;
    }

    /* Privacy Consent Box */
    .consent-card-box {
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        padding: 16px 18px;
    }
    .form-check-input:checked {
        background-color: var(--civic-orange);
        border-color: var(--civic-orange);
    }

    /* Action Buttons */
    .btn-civic-submit {
        background: linear-gradient(135deg, #FF7A00 0%, #EA580C 100%);
        color: #FFFFFF;
        border: none;
        border-radius: 30px;
        padding: 14px 34px;
        font-size: 1.05rem;
        font-weight: 800;
        letter-spacing: 0.3px;
        box-shadow: 0 6px 20px rgba(234, 88, 12, 0.35);
        transition: all 0.25s ease;
    }
    .btn-civic-submit:hover {
        background: linear-gradient(135deg, #EA580C 0%, #C2410C 100%);
        color: #FFFFFF;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(234, 88, 12, 0.45);
    }
    .btn-civic-reset {
        border: 1.5px solid #CBD5E1;
        background: #FFFFFF;
        color: #475569;
        border-radius: 30px;
        padding: 14px 26px;
        font-size: 0.95rem;
        font-weight: 700;
        transition: all 0.2s ease;
    }
    .btn-civic-reset:hover {
        background: #F1F5F9;
        color: #0F172A;
    }

    /* Select2 Bootstrap 5 Overrides */
    .select2-container--bootstrap-5 .select2-selection {
        border: 1.5px solid #CBD5E1 !important;
        border-radius: 11px !important;
        padding: 8px 12px !important;
        min-height: 44px !important;
    }
    .select2-container--bootstrap-5.select2-container--focus .select2-selection {
        border-color: var(--civic-orange) !important;
        box-shadow: 0 0 0 3.5px rgba(234, 88, 12, 0.15) !important;
    }

    @media (max-width: 767.98px) {
        .priority-selector-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .civic-hero-title {
            font-size: 1.5rem;
        }
        .form-step-stepper {
            overflow-x: auto;
            justify-content: flex-start;
            padding-bottom: 6px;
        }
        .civic-card-header {
            padding: 14px 16px;
        }
        .civic-card-body {
            padding: 18px 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4 py-md-5">
    <div class="civic-form-container">

        <!-- 1. BREADCRUMB NAVIGATION -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="bi bi-house-door me-1"></i>{{ __('messages.nav_home') }}</a></li>
                <li class="breadcrumb-item active text-primary fw-bold" aria-current="page">{{ __('messages.nav_submit_complaint') }}</li>
            </ol>
        </nav>

        <!-- 2. MODERN CIVIC HERO BANNER -->
        <div class="civic-hero-card text-center mb-4">
            <div class="civic-hero-badge">
                <i class="bi bi-shield-check text-warning"></i>
                <span>{{ __('messages.official_badge') ?? 'அதிகாரப்பூர்வ மக்கள் குறைதீர்ப்பு படிவம் • Official Civic Portal' }}</span>
            </div>

            <h1 class="civic-hero-title">{{ __('messages.form_title') }}</h1>
            <p class="civic-hero-subtitle">{{ __('messages.form_subtitle') }}</p>

            <!-- Trust / Security Micro-Badges -->
            <div class="trust-badges-strip">
                <span class="trust-chip"><i class="bi bi-lock-fill text-success"></i> 256-Bit SSL Encrypted</span>
                <span class="trust-chip"><i class="bi bi-chat-dots-fill text-primary"></i> SMS & Online Tracking</span>
                <span class="trust-chip"><i class="bi bi-geo-alt-fill text-danger"></i> 38 மாவட்ட நேரடி ஒருங்கிணைப்பு</span>
                <span class="trust-chip"><i class="bi bi-telephone-fill text-warning"></i> உதவி எண்: 9384995222</span>
            </div>

            <!-- 4-Step Visual Stepper -->
            <div class="form-step-stepper">
                <a href="#sec-citizen" class="step-pill active">
                    <span class="step-pill-num">1</span>
                    <span>மனுதாரர்</span>
                </a>
                <span class="step-arrow"><i class="bi bi-chevron-right"></i></span>

                <a href="#sec-location" class="step-pill">
                    <span class="step-pill-num">2</span>
                    <span>இருப்பிடம்</span>
                </a>
                <span class="step-arrow"><i class="bi bi-chevron-right"></i></span>

                <a href="#sec-complaint" class="step-pill">
                    <span class="step-pill-num">3</span>
                    <span>புகார் விவரம்</span>
                </a>
                <span class="step-arrow"><i class="bi bi-chevron-right"></i></span>

                <a href="#sec-evidence" class="step-pill">
                    <span class="step-pill-num">4</span>
                    <span>ஆதாரம் & உறுதிமொழி</span>
                </a>
            </div>
        </div>

        <!-- Alert Container for AJAX Responses -->
        <div id="formAlertContainer"></div>

        <!-- Success Confirmation Card (Shown after AJAX submission) -->
        <div id="complaintSuccessCard" class="card border-0 shadow-lg rounded-4 p-4 p-md-5 text-center d-none mb-4">
            <div class="mb-3">
                <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center shadow" style="width: 76px; height: 76px; font-size: 38px;">
                    <i class="bi bi-check-lg"></i>
                </div>
            </div>
            <h3 class="fw-bold text-success mb-2">மனு வெற்றிகரமாக பதிவு செய்யப்பட்டது!</h3>
            <p class="text-muted mb-3">உங்கள் பொதுக் கோரிக்கை முறைப்படி தரவுத்தளத்தில் (Database) பதிவு செய்யப்பட்டுள்ளது.</p>
            
            <div class="bg-light border rounded-3 p-3 my-3 mx-auto" style="max-width: 480px;">
                <div class="small text-muted mb-1">{{ __('messages.lbl_complaint_id') }}</div>
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <span class="fs-2 fw-bold text-primary font-monospace" id="generatedComplaintId">VNK-XXXXXXXX-XXXX</span>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="copyComplaintId()" title="Copy Complaint ID">
                        <i class="bi bi-clipboard"></i>
                    </button>
                </div>
                <div class="small text-secondary mt-1">இந்த எண்ணைக் குறித்துக் கொண்டு SMS அல்லது ஆன்லைனில் நிலையை அறியலாம்.</div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 gap-sm-3 mt-4">
                <a href="#" id="trackLinkBtn" class="btn btn-civic-submit btn-lg">
                    <i class="bi bi-search me-1"></i> புகார் நிலையை உடனடியாகக் கண்காணிக்க
                </a>
                <a href="{{ route('complaints.create') }}" class="btn btn-outline-secondary btn-lg rounded-pill px-4">
                    <i class="bi bi-plus-circle me-1"></i> மற்றொரு மனு பதிவு செய்ய
                </a>
            </div>
        </div>

        <!-- 3. COMPLAINT REGISTRATION FORM -->
        <div id="complaintFormCard">
            <form id="complaintForm" enctype="multipart/form-data" novalidate>
                @csrf
                <!-- Hidden Live GPS Location Fields (Admin Confidential) -->
                <input type="hidden" name="live_latitude" id="liveLatitude">
                <input type="hidden" name="live_longitude" id="liveLongitude">
                <input type="hidden" name="live_address" id="liveAddress">

                <!-- SECTION 1: CITIZEN DETAILS -->
                <div class="civic-card" id="sec-citizen">
                    <div class="civic-card-header">
                        <div class="civic-card-header-left">
                            <div class="civic-icon-box" style="background: #EFF6FF; color: #2563EB;">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>
                            <div>
                                <h3 class="civic-card-title">{{ __('messages.sec_citizen_info') }}</h3>
                                <p class="civic-card-subtitle">அதிகாரப்பூர்வ தொடர்பு மற்றும் நேரடி கள ஆய்விற்கான விவரங்கள்</p>
                            </div>
                        </div>
                        <span class="civic-step-badge">படி 1 / 4</span>
                    </div>

                    <div class="civic-card-body">
                        <div class="row g-3">
                            <!-- Full Name -->
                            <div class="col-md-6">
                                <label for="citizenName" class="civic-label">
                                    <i class="bi bi-person-fill text-primary me-1"></i>
                                    <span>{{ __('messages.lbl_name') }}</span>
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person text-secondary"></i></span>
                                    <input type="text" name="citizen_name" id="citizenName" class="form-control" placeholder="உங்கள் முழுப் பெயர் உள்ளிடவும்" required>
                                </div>
                            </div>

                            <!-- Mobile Number -->
                            <div class="col-md-6">
                                <label for="citizenMobile" class="civic-label">
                                    <i class="bi bi-phone-fill text-success me-1"></i>
                                    <span>{{ __('messages.lbl_mobile') }}</span>
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text fw-bold text-success">+91</span>
                                    <input type="tel" name="citizen_mobile" id="citizenMobile" class="form-control" placeholder="10-digit mobile number" pattern="[6-9][0-9]{9}" maxlength="10" required>
                                </div>
                                <div class="small text-muted mt-1" style="font-size: 0.76rem;">SMS மூலம் நிலவர அறிவிப்புகள் மற்றும் கள ஆய்விற்கு பயன்படுத்தப்படும்.</div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="citizenEmail" class="civic-label">
                                    <i class="bi bi-envelope-fill text-secondary me-1"></i>
                                    <span>{{ __('messages.lbl_email') }}</span>
                                    <span class="text-muted fw-normal small">(விருப்பப்பட்டால்)</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope text-secondary"></i></span>
                                    <input type="email" name="citizen_email" id="citizenEmail" class="form-control" placeholder="e.g. name@example.com">
                                </div>
                            </div>

                            <!-- Street Address -->
                            <div class="col-md-6">
                                <label for="citizenAddress" class="civic-label">
                                    <i class="bi bi-house-door-fill text-secondary me-1"></i>
                                    <span>{{ __('messages.lbl_address') }}</span>
                                    <span class="required-star">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-geo-alt text-secondary"></i></span>
                                    <input type="text" name="citizen_address" id="citizenAddress" class="form-control" placeholder="கதவு எண், தெருப் பெயர், குடியிருப்பு பகுதி" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: LOCATION OF GRIEVANCE (DEPENDENT CASCADING DROPDOWNS) -->
                <div class="civic-card" id="sec-location">
                    <div class="civic-card-header">
                        <div class="civic-card-header-left">
                            <div class="civic-icon-box" style="background: #FFF7ED; color: #EA580C;">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h3 class="civic-card-title">{{ __('messages.sec_location_info') }}</h3>
                                <p class="civic-card-subtitle">தமிழ்நாட்டின் அனைத்து 38 மாவட்டங்கள் மற்றும் கோட்டங்கள்</p>
                            </div>
                        </div>
                        <span class="civic-step-badge">படி 2 / 4</span>
                    </div>

                    <div class="civic-card-body">
                        <div class="row g-3">
                            <!-- District -->
                            <div class="col-md-6">
                                <label for="districtSelect" class="civic-label">
                                    <i class="bi bi-building text-primary me-1"></i>
                                    <span>{{ __('messages.lbl_district') }}</span>
                                    <span class="required-star">*</span>
                                </label>
                                <select name="district_id" id="districtSelect" class="form-select" required>
                                    <option value="">-- {{ __('messages.select_district') }} --</option>
                                    @foreach($districts as $d)
                                        <option value="{{ $d->id }}" {{ $districts->count() === 1 ? 'selected' : '' }}>{{ $d->name }} ({{ $d->name_en }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Revenue Division -->
                            <div class="col-md-6">
                                <label for="divisionSelect" class="civic-label">
                                    <i class="bi bi-bank text-info me-1"></i>
                                    <span>{{ __('messages.lbl_division') }}</span>
                                    <span class="required-star">*</span>
                                </label>
                                <select name="revenue_division_id" id="divisionSelect" class="form-select" required disabled>
                                    <option value="">-- {{ __('messages.select_district_first') }} --</option>
                                </select>
                            </div>

                            <!-- Taluk -->
                            <div class="col-md-6">
                                <label for="talukSelect" class="civic-label">
                                    <i class="bi bi-signpost-2 text-warning me-1"></i>
                                    <span>{{ __('messages.lbl_taluk') }}</span>
                                    <span class="required-star">*</span>
                                </label>
                                <select name="taluk_id" id="talukSelect" class="form-select" required disabled>
                                    <option value="">-- {{ __('messages.select_division_first') }} --</option>
                                </select>
                            </div>

                            <!-- Village / Town -->
                            <div class="col-md-6">
                                <label for="villageSelect" class="civic-label">
                                    <i class="bi bi-pin-map-fill text-danger me-1"></i>
                                    <span>{{ __('messages.lbl_village') }}</span>
                                    <span class="text-muted fw-normal small">(Village / Town)</span>
                                </label>
                                
                                <!-- Select Dropdown Mode (Default) -->
                                <div class="input-group" id="villageSelectGroup">
                                    <select name="revenue_village_id" id="villageSelect" class="form-select" disabled>
                                        <option value="">-- {{ __('messages.select_taluk_first') }} --</option>
                                    </select>
                                    <button type="button" class="btn btn-outline-primary px-3 text-nowrap fw-bold btn-sm d-flex align-items-center gap-1" id="btnSwitchToManual" title="பட்டியலில் இல்லாத ஊரை தட்டச்சு செய்ய">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>தட்டச்சு செய்ய</span>
                                    </button>
                                </div>

                                <!-- Direct Manual Text Mode (Active when toggled or 'other' chosen) -->
                                <div class="input-group d-none" id="villageManualGroup">
                                    <span class="input-group-text bg-light text-primary"><i class="bi bi-geo-alt-fill"></i></span>
                                    <input type="text" name="custom_village_name" id="customVillageInput" class="form-control" placeholder="கிராமம் / நகர் / காலனி பெயர் உள்ளிடவும் (e.g. அண்ணா நகர்)">
                                    <button type="button" class="btn btn-outline-secondary px-3 text-nowrap fw-bold btn-sm d-flex align-items-center gap-1" id="btnSwitchToSelect" title="மீண்டும் கிராமப் பட்டியலுக்கு மாற">
                                        <i class="bi bi-list-ul"></i>
                                        <span>பட்டியல்</span>
                                    </button>
                                </div>
                                <div class="small text-muted mt-1" style="font-size: 0.74rem;">
                                    பட்டியலிலும் தேர்ந்தெடுக்கலாம் அல்லது 'தட்டச்சு செய்ய' பட்டனை அழுத்தி நேரடியாகவும் உள்ளிடலாம்.
                                </div>
                            </div>

                            <!-- Ward Number -->
                            <div class="col-md-6">
                                <label for="wardNumber" class="civic-label">
                                    <i class="bi bi-hash text-secondary me-1"></i>
                                    <span>{{ __('messages.lbl_ward') }}</span>
                                    <span class="text-muted fw-normal small">(பொருந்தினால்)</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tag text-secondary"></i></span>
                                    <input type="text" name="ward_number" id="wardNumber" class="form-control" placeholder="e.g. Ward 12 (நகராட்சி / பேரூராட்சி)">
                                </div>
                            </div>

                            <!-- Landmark -->
                            <div class="col-md-6">
                                <label for="landmark" class="civic-label">
                                    <i class="bi bi-compass text-secondary me-1"></i>
                                    <span>{{ __('messages.lbl_landmark') }}</span>
                                    <span class="text-muted fw-normal small">(அடையாளக் குறி)</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-flag text-secondary"></i></span>
                                    <input type="text" name="landmark" id="landmark" class="form-control" placeholder="e.g. Near Bus Stand, Opposite High School, Water Tank">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: GRIEVANCE SPECIFICS -->
                <div class="civic-card" id="sec-complaint">
                    <div class="civic-card-header">
                        <div class="civic-card-header-left">
                            <div class="civic-icon-box" style="background: #F5F3FF; color: #7C3AED;">
                                <i class="bi bi-card-text"></i>
                            </div>
                            <div>
                                <h3 class="civic-card-title">{{ __('messages.sec_complaint_info') }}</h3>
                                <p class="civic-card-subtitle">துறை வகைப்பாடு மற்றும் கோரிக்கையின் விரிவான விளக்கம்</p>
                            </div>
                        </div>
                        <span class="civic-step-badge">படி 3 / 4</span>
                    </div>

                    <div class="civic-card-body">
                        <div class="row g-3">
                            <!-- Category -->
                            <div class="col-md-12">
                                <label for="categorySelect" class="civic-label">
                                    <i class="bi bi-grid-fill text-primary me-1"></i>
                                    <span>{{ __('messages.lbl_category') }}</span>
                                    <span class="required-star">*</span>
                                </label>
                                <select name="category_id" id="categorySelect" class="form-select" required>
                                    <option value="">-- {{ __('messages.select_category') }} --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">
                                            {{ $cat->name }} ({{ $cat->department_name }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Interactive Priority Selector -->
                            <div class="col-12">
                                <label class="civic-label">
                                    <i class="bi bi-speedometer2 text-warning me-1"></i>
                                    <span>{{ __('messages.lbl_priority') }}</span>
                                </label>

                                <!-- Hidden input synced with priority cards -->
                                <select name="priority" id="prioritySelect" class="d-none">
                                    <option value="low">{{ __('messages.priority_low') }}</option>
                                    <option value="medium" selected>{{ __('messages.priority_medium') }}</option>
                                    <option value="high">{{ __('messages.priority_high') }}</option>
                                    <option value="urgent">{{ __('messages.priority_urgent') }}</option>
                                </select>

                                <!-- 4 Interactive Priority Chips -->
                                <div class="priority-selector-grid">
                                    <div class="priority-chip-card" data-priority="low">
                                        <span class="priority-dot" style="background: #16A34A;"></span>
                                        <span class="fw-bold" style="color: #16A34A; font-size: 0.88rem;">{{ __('messages.priority_low') }}</span>
                                        <div class="small text-muted" style="font-size: 0.72rem;">சாதாரண கோரிக்கை</div>
                                    </div>
                                    <div class="priority-chip-card active-medium" data-priority="medium">
                                        <span class="priority-dot" style="background: #2563EB;"></span>
                                        <span class="fw-bold" style="color: #2563EB; font-size: 0.88rem;">{{ __('messages.priority_medium') }}</span>
                                        <div class="small text-muted" style="font-size: 0.72rem;">இயல்பானது (Default)</div>
                                    </div>
                                    <div class="priority-chip-card" data-priority="high">
                                        <span class="priority-dot" style="background: #D97706;"></span>
                                        <span class="fw-bold" style="color: #D97706; font-size: 0.88rem;">{{ __('messages.priority_high') }}</span>
                                        <div class="small text-muted" style="font-size: 0.72rem;">விரைவு தேவை</div>
                                    </div>
                                    <div class="priority-chip-card" data-priority="urgent">
                                        <span class="priority-dot" style="background: #DC2626;"></span>
                                        <span class="fw-bold" style="color: #DC2626; font-size: 0.88rem;">{{ __('messages.priority_urgent') }}</span>
                                        <div class="small text-muted" style="font-size: 0.72rem;">அவசரம் / விபத்து அபாயம்</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Subject -->
                            <div class="col-12">
                                <label for="complaintSubject" class="civic-label">
                                    <i class="bi bi-chat-left-quote-fill text-primary me-1"></i>
                                    <span>{{ __('messages.lbl_subject') }}</span>
                                    <span class="required-star">*</span>
                                </label>
                                <input type="text" name="subject" id="complaintSubject" class="form-control" placeholder="எ.கா. மெயின் ரோட்டில் குடிநீர் குழாய் பழுது / கழிவுநீர் அடைப்பு" minlength="5" maxlength="255" required>
                                <div class="small text-muted mt-1" style="font-size: 0.76rem;">பிரச்சனையின் ஒரு வரி சுருக்கத் தலைப்பு.</div>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="complaintDesc" class="civic-label">
                                    <i class="bi bi-pencil-square text-primary me-1"></i>
                                    <span>{{ __('messages.lbl_description') }}</span>
                                    <span class="required-star">*</span>
                                </label>
                                <textarea name="description" id="complaintDesc" class="form-control" rows="5" placeholder="பிரச்சனை எப்போது தொடங்கியது, எத்தனை குடும்பங்கள் பாதிக்கப்பட்டுள்ளன, இதுவரை எடுக்கப்பட்ட முயற்சிகள் மற்றும் அதிகாரிகளிடம் கோரப்படும் தீர்வு ஆகியவற்றை விரிவாக உள்ளிடவும்." minlength="20" required></textarea>
                                <div class="small text-muted mt-1" style="font-size: 0.76rem;">குறைந்தது 20 எழுத்துக்கள் விளக்கம் தேவை (Minimum 20 characters required).</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 4: PHOTOS & EVIDENCE UPLOAD (MODERN DROP-ZONES) -->
                <div class="civic-card" id="sec-evidence">
                    <div class="civic-card-header">
                        <div class="civic-card-header-left">
                            <div class="civic-icon-box" style="background: #F0FDF4; color: #16A34A;">
                                <i class="bi bi-camera-fill"></i>
                            </div>
                            <div>
                                <h3 class="civic-card-title">{{ __('messages.sec_attachments') }}</h3>
                                <p class="civic-card-subtitle">களப் புகைப்படம் மற்றும் முந்தைய மனு ஆவணங்கள் (விரைவான ஆய்விற்கு)</p>
                            </div>
                        </div>
                        <span class="civic-step-badge">படி 4 / 4</span>
                    </div>

                    <div class="civic-card-body">
                        <div class="row g-3">
                            <!-- Photo Evidence Dropzone -->
                            <div class="col-md-6">
                                <label class="civic-label">
                                    <i class="bi bi-image text-success me-1"></i>
                                    <span>{{ __('messages.lbl_photo') }}</span>
                                    <span class="text-muted fw-normal small">(களப் புகைப்படம்)</span>
                                </label>
                                
                                <input type="file" name="photo" id="photoFile" class="d-none" accept="image/jpeg,image/png,image/jpg,image/webp">
                                
                                <div class="civic-upload-dropzone" id="photoDropzone" onclick="$('#photoFile').click()">
                                    <div class="civic-upload-icon-circle">
                                        <i class="bi bi-cloud-arrow-up-fill"></i>
                                    </div>
                                    <div class="fw-bold text-dark" style="font-size: 0.92rem;">புகைப்படம் இணைக்க இங்கே கிளிக் செய்யவும்</div>
                                    <div class="small text-muted mt-1">Camera or Gallery (JPG, PNG, WebP - Max 5MB)</div>
                                    
                                    <div class="file-preview-badge" id="photoPreviewBadge">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span id="photoPreviewName">File selected</span>
                                        <span class="btn-close btn-close-sm ms-auto" onclick="clearPhoto(event)"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Document Evidence Dropzone -->
                            <div class="col-md-6">
                                <label class="civic-label">
                                    <i class="bi bi-file-earmark-text text-secondary me-1"></i>
                                    <span>{{ __('messages.lbl_document') }}</span>
                                    <span class="text-muted fw-normal small">(முந்தைய மனு / ரசீது)</span>
                                </label>
                                
                                <input type="file" name="document" id="docFile" class="d-none" accept=".pdf,image/jpeg,image/png,image/jpg">
                                
                                <div class="civic-upload-dropzone" id="docDropzone" onclick="$('#docFile').click()">
                                    <div class="civic-upload-icon-circle">
                                        <i class="bi bi-file-earmark-pdf-fill"></i>
                                    </div>
                                    <div class="fw-bold text-dark" style="font-size: 0.92rem;">ஆவணம் இணைக்க இங்கே கிளிக் செய்யவும்</div>
                                    <div class="small text-muted mt-1">Previous Petition, Receipts or Endorsements (PDF/JPG)</div>

                                    <div class="file-preview-badge" id="docPreviewBadge">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span id="docPreviewName">Document selected</span>
                                        <span class="btn-close btn-close-sm ms-auto" onclick="clearDoc(event)"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 5: CONSENT & SUBMISSION -->
                <div class="civic-card">
                    <div class="civic-card-header">
                        <div class="civic-card-header-left">
                            <div class="civic-icon-box" style="background: #F8FAFC; color: #475569;">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <h3 class="civic-card-title">{{ __('messages.sec_verification') }}</h3>
                                <p class="civic-card-subtitle">உண்மைத்தன்மை உறுதிமொழி மற்றும் சமர்ப்பிப்பு</p>
                            </div>
                        </div>
                    </div>

                    <div class="civic-card-body">
                        <!-- Consent Checkbox -->
                        <div class="consent-card-box mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="privacy_consent" id="privacyConsent" value="1" required>
                                <label class="form-check-label small text-dark fw-semibold" for="privacyConsent" style="line-height: 1.5; cursor: pointer;">
                                    {{ __('messages.lbl_consent') }}
                                </label>
                            </div>
                        </div>

                        <!-- Buttons Row -->
                        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
                            <div class="d-flex flex-wrap gap-2 w-100 w-sm-auto">
                                <button type="submit" class="btn btn-civic-submit w-100 w-sm-auto" id="btnSubmitComplaint">
                                    <i class="bi bi-send-fill me-2"></i> {{ __('messages.btn_submit_complaint') }}
                                </button>
                                <button type="reset" class="btn btn-civic-reset w-100 w-sm-auto" onclick="resetCustomForm()">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> {{ __('messages.btn_reset') }}
                                </button>
                            </div>

                            <div class="small text-muted d-flex align-items-center gap-1 text-center text-sm-end">
                                <i class="bi bi-lock-fill text-success"></i>
                                <span>தகவல்கள் அனைத்தும் முழுமையாகப் பாதுகாக்கப்படும்</span>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // 1. Priority Chip Selector Sync with #prioritySelect
    $(document).ready(function() {
        $('.priority-chip-card').on('click', function() {
            var selectedPriority = $(this).data('priority');
            
            // Remove active classes
            $('.priority-chip-card').removeClass('active-low active-medium active-high active-urgent');
            
            // Add specific active class
            $(this).addClass('active-' + selectedPriority);
            
            // Sync with select element
            $('#prioritySelect').val(selectedPriority).trigger('change');
        });

        // 2. File Upload Dropzone Live Previews
        $('#photoFile').on('change', function() {
            if (this.files && this.files[0]) {
                var file = this.files[0];
                var sizeMb = (file.size / (1024 * 1024)).toFixed(2);
                $('#photoPreviewName').text(file.name + ' (' + sizeMb + ' MB)');
                $('#photoPreviewBadge').css('display', 'inline-flex');
                $('#photoDropzone').addClass('has-file');
            }
        });

        $('#docFile').on('change', function() {
            if (this.files && this.files[0]) {
                var file = this.files[0];
                var sizeMb = (file.size / (1024 * 1024)).toFixed(2);
                $('#docPreviewName').text(file.name + ' (' + sizeMb + ' MB)');
                $('#docPreviewBadge').css('display', 'inline-flex');
                $('#docDropzone').addClass('has-file');
            }
        });

        // Smooth Scroll for Step Steppers
        $('.step-pill').on('click', function(e) {
            e.preventDefault();
            var target = $(this).attr('href');
            if ($(target).length) {
                $('html, body').animate({
                    scrollTop: $(target).offset().top - 80
                }, 400);
            }
        });
    });

    // Clear file selection
    function clearPhoto(e) {
        e.stopPropagation();
        $('#photoFile').val('');
        $('#photoPreviewBadge').hide();
        $('#photoDropzone').removeClass('has-file');
    }

    function clearDoc(e) {
        e.stopPropagation();
        $('#docFile').val('');
        $('#docPreviewBadge').hide();
        $('#docDropzone').removeClass('has-file');
    }

    // Reset Custom Elements
    function resetCustomForm() {
        clearPhoto(new Event('click'));
        clearDoc(new Event('click'));
        $('.priority-chip-card').removeClass('active-low active-medium active-high active-urgent');
        $('[data-priority="medium"]').addClass('active-medium');
        $('#prioritySelect').val('medium');
        if ($('#villageSelect').data('select2')) {
            $('#villageSelect').val('').trigger('change');
        }
    }

    // Copy Complaint Reference ID
    function copyComplaintId() {
        var id = $('#generatedComplaintId').text().trim();
        if (navigator.clipboard) {
            navigator.clipboard.writeText(id).then(function() {
                alert('மனு எண் நகலெடுக்கப்பட்டது (Complaint ID copied): ' + id);
            });
        }
    }
</script>
@endpush
