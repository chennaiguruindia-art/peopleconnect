@extends('layouts.admin')

@section('title', 'Grievance: ' . $complaint->complaint_id)

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.complaints.index') }}" class="btn btn-sm btn-outline-secondary mb-2">
        <i class="bi bi-arrow-left me-1"></i> Back to Complaints List
    </a>
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <div class="d-flex align-items-center gap-2">
                <h3 class="fw-bold text-dark font-monospace mb-0">{{ $complaint->complaint_id }}</h3>
                <span class="badge {{ $complaint->status_badge_class }} py-2 px-3 fs-6">
                    {{ $complaint->status_label }}
                </span>
            </div>
            <div class="text-muted small mt-1">
                Registered on {{ $complaint->created_at->format('d M Y, h:i A') }} • Priority: <strong class="text-uppercase">{{ $complaint->priority }}</strong>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <!-- Modal trigger: Update Status -->
            <button type="button" class="btn btn-primary btn-sm px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#statusModal" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
                <i class="bi bi-arrow-repeat me-1"></i> Update Status
            </button>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Grievance Details & Citizen Contact -->
    <div class="col-lg-8">
        <!-- Subject & Description Card -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-file-text me-2"></i>Petition Details</h5>
                <span class="badge bg-light text-dark border">{{ $complaint->category->name }}</span>
            </div>
            <div class="admin-card-body">
                <h5 class="fw-bold text-dark mb-3">{{ $complaint->subject }}</h5>
                <div class="p-3 bg-light rounded-3 mb-4 text-dark" style="white-space: pre-line;">{{ $complaint->description }}</div>

                <div class="row g-3 small">
                    <div class="col-md-8">
                        <div class="text-muted">Target Civic Department:</div>
                        <div class="fw-bold text-dark">{{ $complaint->category->department_name }}</div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted">Target Resolution SLA:</div>
                        <div class="fw-bold text-primary">{{ $complaint->category->sla_days }} Working Days</div>
                    </div>
                </div>

                @if($complaint->resolution_remarks)
                    <div class="alert alert-success mt-4 mb-0">
                        <div class="fw-bold mb-1"><i class="bi bi-check2-circle me-1"></i> Resolution Remarks:</div>
                        <p class="mb-0 small">{{ $complaint->resolution_remarks }}</p>
                        @if($complaint->resolved_at)
                            <div class="text-muted small mt-1" style="font-size: 0.75rem;">Resolved on {{ $complaint->resolved_at->format('d M Y, h:i A') }}</div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Completion / Resolution Proof Card (If status is completed or proofs exist) -->
        @php
            $resolutionProofs = $complaint->attachments->where('attachment_type', 'evidence_resolution');
        @endphp
        @if($resolutionProofs->count() > 0 || $complaint->status === 'resolved')
            <div class="admin-card mb-4 border-success">
                <div class="admin-card-header bg-success text-white">
                    <h5 class="admin-card-title text-white mb-0">
                        <i class="bi bi-shield-check me-2"></i>Completed Status - Attached Proof
                    </h5>
                    <span class="badge bg-white text-success fw-bold">{{ $resolutionProofs->count() }} Proof File(s)</span>
                </div>
                <div class="admin-card-body">
                    @if($resolutionProofs->count() > 0)
                        <div class="row g-3">
                            @foreach($resolutionProofs as $proof)
                                <div class="col-md-6">
                                    <div class="border border-success rounded-3 p-3 bg-light d-flex align-items-center gap-3">
                                        <div class="rounded-3 bg-white p-2 fs-2 text-success shadow-sm">
                                            @if(str_contains($proof->file_type, 'pdf'))
                                                <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                                            @else
                                                <i class="bi bi-file-earmark-image-fill text-success"></i>
                                            @endif
                                        </div>
                                        <div class="overflow-hidden flex-grow-1">
                                            <div class="fw-bold text-truncate text-dark small">{{ $proof->file_name }}</div>
                                            <small class="text-success fw-semibold text-uppercase">Resolution Proof • {{ round($proof->file_size / 1024) }} KB</small>
                                        </div>
                                        <a href="{{ asset('storage/' . $proof->file_path) }}" target="_blank" class="btn btn-sm btn-success">
                                            <i class="bi bi-eye-fill me-1"></i> View Proof
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-warning mb-0 small">
                            <i class="bi bi-exclamation-triangle-fill me-1"></i> Complaint is marked as completed, but no proof file was recorded previously. Use "Update Status" to attach official proof.
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Evidence & Attachments Submitted by Citizen -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-images me-2"></i>Citizen Attached Photos & Documents</h5>
                <span class="badge bg-secondary">{{ $complaint->attachments->where('attachment_type', '!=', 'evidence_resolution')->count() }} Files</span>
            </div>
            <div class="admin-card-body">
                @php
                    $citizenAttachments = $complaint->attachments->where('attachment_type', '!=', 'evidence_resolution');
                @endphp
                @if($citizenAttachments->count() > 0)
                    <div class="row g-3">
                        @foreach($citizenAttachments as $att)
                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 d-flex align-items-center gap-3">
                                    <div class="rounded-3 bg-light p-2 fs-3 text-primary">
                                        <i class="bi bi-file-earmark-arrow-down"></i>
                                    </div>
                                    <div class="overflow-hidden flex-grow-1">
                                        <div class="fw-bold text-truncate small">{{ $att->file_name }}</div>
                                        <small class="text-muted text-uppercase">{{ $att->attachment_type }} • {{ round($att->file_size / 1024) }} KB</small>
                                    </div>
                                    <a href="{{ asset('storage/' . $att->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-muted small py-3 text-center">No photographs or petition documents attached by citizen.</div>
                @endif
            </div>
        </div>

        <!-- History Audit Log -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-clock-history me-2"></i>Status History & Audit Trail</h5>
            </div>
            <div class="admin-card-body">
                <div class="tracking-timeline">
                    @foreach($complaint->history as $h)
                        <div class="timeline-step">
                            <div class="timeline-marker {{ $h->new_status === 'resolved' ? 'resolved' : 'active' }}"></div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="badge bg-secondary small">{{ trans('messages.status_' . $h->new_status) }}</span>
                                    <span class="timeline-date small"><i class="bi bi-clock me-1"></i>{{ $h->created_at->format('d M Y, h:i A') }}</span>
                                </div>
                                <div class="timeline-title">{{ $h->action }}</div>
                                @if($h->user)
                                    <div class="text-muted small">Updated by: <strong>{{ $h->user->name }}</strong> ({{ $h->user->designation }})</div>
                                @endif
                                @if($h->remarks)
                                    <p class="text-secondary small mb-0 mt-1 bg-white p-2 rounded border">{{ $h->remarks }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Citizen Contact & Location -->
    <div class="col-lg-4">
        <!-- Citizen Contact Card -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-person me-2"></i>Citizen Information</h5>
            </div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <div class="text-muted small">Full Name:</div>
                    <div class="fw-bold text-dark fs-6">{{ $complaint->citizen_name }}</div>
                </div>
                <div class="mb-3">
                    <div class="text-muted small">Mobile Number:</div>
                    <div class="fw-bold text-dark">
                        <a href="tel:{{ $complaint->citizen_mobile }}" class="text-decoration-none">
                            <i class="bi bi-telephone me-1"></i> {{ $complaint->citizen_mobile }}
                        </a>
                    </div>
                </div>
                @if($complaint->citizen_email)
                    <div class="mb-3">
                        <div class="text-muted small">Email Address:</div>
                        <div class="text-dark small">{{ $complaint->citizen_email }}</div>
                    </div>
                @endif
                <div>
                    <div class="text-muted small">Street Address:</div>
                    <div class="text-dark small">{{ $complaint->citizen_address }}</div>
                </div>
            </div>
        </div>

        <!-- Location Jurisdiction Card -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h5 class="admin-card-title"><i class="bi bi-geo-alt me-2"></i>Administrative Location</h5>
            </div>
            <div class="admin-card-body small">
                <div class="mb-2">
                    <span class="text-muted">District:</span>
                    <strong class="float-end text-dark">{{ $complaint->district?->name_en ?? 'குரலற்ற மகளின் குரல்' }} ({{ $complaint->district?->name_ta ?? 'தமிழ்நாடு' }})</strong>
                </div>
                <div class="mb-2">
                    <span class="text-muted">Revenue Division:</span>
                    <strong class="float-end text-dark">{{ $complaint->revenueDivision->name }}</strong>
                </div>
                <div class="mb-2">
                    <span class="text-muted">Revenue Taluk:</span>
                    <strong class="float-end text-primary">{{ $complaint->taluk->name }}</strong>
                </div>
                <div class="mb-2">
                    <span class="text-muted">Village / Town:</span>
                    <strong class="float-end text-dark">{{ $complaint->village_name }}</strong>
                </div>
                @if($complaint->ward_number)
                    <div class="mb-2">
                        <span class="text-muted">Ward Number:</span>
                        <strong class="float-end text-dark">Ward {{ $complaint->ward_number }}</strong>
                    </div>
                @endif
                @if($complaint->landmark)
                    <div class="mt-2 pt-2 border-top">
                        <span class="text-muted">Landmark:</span>
                        <div class="text-dark fw-semibold mt-1">{{ $complaint->landmark }}</div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Live GPS & Captured Location Card (ADMIN CONFIDENTIAL ONLY) -->
        <div class="admin-card mb-4 border-danger border-opacity-25">
            <div class="admin-card-header bg-danger bg-opacity-10 d-flex justify-content-between align-items-center py-2 px-3">
                <h5 class="admin-card-title text-danger mb-0 fs-6">
                    <i class="bi bi-crosshair me-1"></i> Live GPS Location
                </h5>
                <span class="badge bg-danger text-white" style="font-size: 0.65rem; letter-spacing: 0.5px;">ADMIN ONLY</span>
            </div>
            <div class="admin-card-body small">
                @if($complaint->has_live_location)
                    <div class="mb-3">
                        <div class="text-muted mb-1">GPS Coordinates (Lat, Long):</div>
                        <div class="p-2 bg-light rounded border font-monospace text-dark d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $complaint->live_latitude }}, {{ $complaint->live_longitude }}</span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Captured</span>
                        </div>
                    </div>

                    @if($complaint->live_address)
                        <div class="mb-3">
                            <div class="text-muted mb-1">Live Fetched Address (Reverse Geocoded):</div>
                            <div class="p-2 bg-light rounded border text-dark" style="font-size: 0.82rem; line-height: 1.4;">
                                <i class="bi bi-pin-map-fill text-primary me-1"></i> {{ $complaint->live_address }}
                            </div>
                        </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ $complaint->google_maps_url }}" target="_blank" class="btn btn-sm btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-1 shadow-sm">
                            <i class="bi bi-map-fill"></i>
                            <span>View Exact Spot on Google Maps</span>
                            <i class="bi bi-box-arrow-up-right ms-1 small"></i>
                        </a>
                    </div>
                @else
                    <div class="text-center py-3 text-muted">
                        <i class="bi bi-geo-slash text-secondary fs-4 d-block mb-1"></i>
                        <div>Live GPS not captured</div>
                        <div class="text-muted" style="font-size: 0.72rem;">Citizen browser permission was disabled or device was offline.</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL: UPDATE STATUS ONLY ================= -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="updateStatusForm" data-id="{{ $complaint->id }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold" id="statusModalLabel">
                        <i class="bi bi-arrow-repeat me-2 text-primary"></i>Update Complaint Status
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Status Dropdown: Exactly 4 statuses -->
                    <div class="mb-3">
                        <label for="statusSelect" class="form-label small fw-bold">Select Status <span class="text-danger">*</span></label>
                        <select name="status" id="statusSelect" class="form-select form-select-lg" required>
                            <option value="submitted" {{ $complaint->status === 'submitted' ? 'selected' : '' }}>
                                Received your complaint (உங்கள் கோரிக்கை பெறப்பட்டது)
                            </option>
                            <option value="assigned" {{ $complaint->status === 'assigned' ? 'selected' : '' }}>
                                Assigned officer to your complaint (உங்கள் கோரிக்கைக்கு அதிகாரி நியமிக்கப்பட்டார்)
                            </option>
                            <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>
                                Processing (செயலாக்கத்தில் உள்ளது)
                            </option>
                            <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>
                                Completed (நிறைவுற்றது)
                            </option>
                        </select>
                    </div>

                    <!-- Remarks -->
                    <div class="mb-3">
                        <label for="statusRemarks" class="form-label small fw-bold">Action Taken / Remarks <span class="text-danger">*</span></label>
                        <textarea name="remarks" id="statusRemarks" class="form-control" rows="3" placeholder="Enter action taken, investigation outcome, or completion remarks..." required></textarea>
                    </div>

                    <!-- Proof Attachment Container (Mandatory if Completed) -->
                    <div class="mb-3 p-3 border rounded-3 bg-light transition-all" id="proofContainer">
                        <label for="resolutionPhoto" class="form-label small fw-bold d-flex justify-content-between align-items-center mb-1">
                            <span><i class="bi bi-paperclip me-1"></i> Attached Proof (Photo / Document)</span>
                            <span id="proofBadge" class="badge bg-secondary">Optional</span>
                        </label>
                        <input type="file" name="resolution_photo" id="resolutionPhoto" class="form-control" accept="image/*,.pdf">
                        <div class="form-text small mt-2" id="proofHelpText">
                            Attach inspection photo or verification proof document.
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm px-4" id="btnSubmitStatus" style="background-color: var(--admin-primary); border-color: var(--admin-primary);">
                        <i class="bi bi-check2-circle me-1"></i> Save Status Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
