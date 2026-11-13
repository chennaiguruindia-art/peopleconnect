@extends('layouts.admin')

@section('title', 'Manage Complaints')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h3 class="fw-bold text-dark mb-0">District Grievances Management</h3>
        <p class="text-muted small mb-0">Search, filter, monitor grievance progress, and record verified status updates.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.complaints.export') }}" class="btn btn-outline-success btn-sm">
            <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel / CSV
        </a>
    </div>
</div>

<!-- AJAX Filter Controls -->
<div class="admin-card mb-4">
    <div class="admin-card-body p-3">
        <div class="row g-2 align-items-center">
            <div class="col-md-3">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                    <input type="text" id="adminComplaintSearch" class="form-control" placeholder="Search Complaint ID, Name, Mobile...">
                </div>
            </div>

            <div class="col-md-2">
                <select id="adminDistrictFilter" class="form-select form-select-sm">
                    <option value="">-- All Districts (38) --</option>
                    @foreach($districts as $d)
                        <option value="{{ $d->id }}">{{ $d->name_en }} ({{ $d->name_ta }})</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <select id="adminStatusFilter" class="form-select form-select-sm">
                    <option value="">-- All Statuses --</option>
                    <option value="submitted">Submitted</option>
                    <option value="under_review">Under Review</option>
                    <option value="awaiting_information">Awaiting Info</option>
                    <option value="assigned">Assigned</option>
                    <option value="referred">Referred</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                    <option value="closed">Closed</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <div class="col-md-2">
                <select id="adminTalukFilter" class="form-select form-select-sm">
                    <option value="">-- All Taluks --</option>
                    @foreach($taluks as $t)
                        <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->name_en }})</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select id="adminCategoryFilter" class="form-select form-select-sm">
                    <option value="">-- All Categories --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Table Card (Refreshed via AJAX) -->
<div class="admin-card">
    <div id="complaintsTableContainer">
        @include('admin.complaints.partials.table', ['complaints' => $complaints])
    </div>
</div>
@endsection
