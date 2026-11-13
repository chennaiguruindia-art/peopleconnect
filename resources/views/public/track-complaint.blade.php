@extends('layouts.app')

@section('title', __('messages.track_title'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('messages.nav_track_complaint') }}</li>
                </ol>
            </nav>

            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark mb-1">{{ __('messages.track_title') }}</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">{{ __('messages.track_subtitle') }}</p>
            </div>

            <!-- Tracking Input Card -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <div id="trackAlertContainer"></div>

                    <form id="trackingForm">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-5">
                                <label for="trackComplaintId" class="form-label">{{ __('messages.lbl_complaint_id') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-ticket-detailed"></i></span>
                                    <input type="text" id="trackComplaintId" class="form-control" placeholder="e.g. VNK-20261101-0012" value="{{ $complaintId ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="trackMobile" class="form-label">{{ __('messages.lbl_registered_mobile') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">+91</span>
                                    <input type="tel" id="trackMobile" class="form-control" placeholder="10-digit mobile" pattern="[6-9][0-9]{9}" maxlength="10" value="{{ $mobile ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary-civic w-100 py-2" id="btnTrackSubmit">
                                    <i class="bi bi-search me-1"></i> {{ __('messages.btn_track') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tracking Result Card (Dynamically updated via AJAX) -->
            <div id="trackingResultCard" class="card border-0 shadow-lg rounded-4 overflow-hidden d-none">
                <div class="card-header bg-dark text-white p-4 border-0 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        <span class="badge bg-secondary mb-1">Grievance Record</span>
                        <h4 class="fw-bold mb-0 text-white font-monospace" id="resComplaintId">-</h4>
                    </div>
                    <div id="resStatusBadge">
                        <!-- Dynamic Status Badge -->
                    </div>
                </div>

                <div class="card-body p-4 bg-white">
                    <div class="row g-4 mb-4">
                        <div class="col-md-8">
                            <h5 class="fw-bold text-dark mb-2" id="resSubject">-</h5>
                            <div class="text-muted small mb-2">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i> <span id="resLocation">-</span>
                            </div>
                            <div class="d-flex flex-wrap gap-2">
                                <span class="badge bg-light text-dark border"><i class="bi bi-tag me-1"></i><span id="resCategory">-</span></span>
                                <span class="badge bg-light text-secondary border"><i class="bi bi-building me-1"></i><span id="resDepartment">-</span></span>
                            </div>
                        </div>

                        <div class="col-md-4 text-md-end border-start-md">
                            <div class="small text-muted mb-1">{{ __('messages.submitted_on') }}</div>
                            <div class="fw-bold text-dark" id="resDate">-</div>
                        </div>
                    </div>

                    <!-- Assigned Staff & Referral Details -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6" id="assignedRow" style="display: none;">
                            <div class="p-3 bg-light border rounded-3">
                                <div class="small text-muted mb-1"><i class="bi bi-person-check-fill text-primary me-1"></i> {{ __('messages.assigned_officer') }}</div>
                                <div class="fw-bold text-dark small" id="resAssignedTo">-</div>
                            </div>
                        </div>

                        <div class="col-md-6" id="referralRow" style="display: none;">
                            <div class="p-3 bg-light border rounded-3">
                                <div class="small text-muted mb-1"><i class="bi bi-arrow-right-circle-fill text-info me-1"></i> {{ __('messages.department_referred') }}</div>
                                <div class="fw-bold text-dark small" id="resReferralStatus">-</div>
                            </div>
                        </div>
                    </div>

                    <!-- Resolution Remarks Box -->
                    <div id="resolutionBox" class="alert alert-success border-success mb-4" style="display: none;">
                        <h6 class="fw-bold mb-1"><i class="bi bi-check-circle-fill me-1"></i> {{ __('messages.resolution_details') }}</h6>
                        <p class="mb-0 small" id="resRemarks">-</p>
                    </div>

                    <!-- Timeline Section -->
                    <h5 class="fw-bold text-dark border-bottom pb-2 mb-3">
                        <i class="bi bi-clock-history text-primary me-1"></i> {{ __('messages.timeline_title') }}
                    </h5>
                    <div class="tracking-timeline" id="timelineContainer">
                        <!-- Dynamic Timeline Steps -->
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
